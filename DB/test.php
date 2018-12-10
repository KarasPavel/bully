<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 01.12.18
 * Time: 14:37
 */
/*
     * add user from site to app
     */


$eventsFromSite = $dbSite->query("SELECT * FROM events WHERE dateStart >= '" . Carbon::now() . "'");
//var_dump($eventsFromSite);
//$eventsFromSite = $dbSite->query("SELECT * FROM events WHERE id=129241");
//128469
foreach ($eventsFromSite as $event) {

    gc_collect_cycles();
    //var_dump($event);
    if ($event['synchronize_id'] != null) {
        $eventsFromApp = $dbApp->query("SELECT * FROM " . $schema . "event where synchronize_id='" . $event['synchronize_id'] . "'");
        $eventsFromApp = $eventsFromApp->fetch(PDO::FETCH_ASSOC);


    } else {
        $eventsFromApp = false;
    }

    /*
     * get event data
     */
    $dateStart = $event['dateStart'] . ' ' . $event['timeStart'];
    $dateEnd = $event['dateEnd'] . ' ' . $event['timeEnd'];


    $ownerUserFromSite = $dbSite->query("SELECT email FROM users WHERE id='" . $event['userId'] . "'");
    $ownerUserFromSite = $ownerUserFromSite->fetch(PDO::FETCH_ASSOC);

    if ($ownerUserFromSite) {
        //$ownerUserFromApp = $dbApp->query("SELECT * FROM " . $schema . "email_password_principal WHERE email='" . $ownerUserFromSite['email'] . "'");
        //$ownerUserFromApp = $ownerUserFromApp->fetch(PDO::FETCH_ASSOC);

        $ownerUserFromAppSQL = "SELECT * FROM " . $schema . "email_password_principal WHERE email=:email";
        $ownerUserFromApp = $dbApp->prepare($ownerUserFromAppSQL,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $ownerUserFromApp->execute(array(':email' => $ownerUserFromSite['email'] ));
        $ownerUserFromApp = $ownerUserFromApp->fetch(PDO::FETCH_ASSOC);

        $userId = $ownerUserFromApp['user_id'];
        //var_dump($userId);
    } else {
        $userId = 'e24565c3-977b-4ece-9ce6-5051963ade2f';
    }

    $description = $event['description'];
    $description = html_entity_decode($description);
    $description = strip_tags($description);
    /**
     * TODO bad decision
     */
    //2048
    if (strlen($description) > 2048) {
        $description = mb_strimwidth($description, 0, 2048, "...");
    }


    $eventGeoLocation = $dbSite->query("SELECT * FROM cinemas WHERE kassir_id='" . $event['venue'] . "'");
    $eventGeoLocation = $eventGeoLocation->fetch(PDO::FETCH_ASSOC);


    if (!$eventGeoLocation) {
        $eventGeoLocation = $dbSite->query("SELECT c.* FROM cinemas c JOIN halls h ON h.cinema_id=c.id "
            . "JOIN event_hall eh ON eh.hall_id=h.id WHERE eh.event_id='" . $event['id'] . "'");
        $eventGeoLocation = $eventGeoLocation->fetch(PDO::FETCH_ASSOC);
    }

    if ($event['is_delete'] == 'false') {
        $eventStatus = 'ACTIVE';
    } else {
        $eventStatus = 'DELETED';
    }

    if (!$eventGeoLocation || ($eventGeoLocation['lat'] == 0.000000000000 && $eventGeoLocation['lng'] == 0.000000000000)) {
        continue;
    }

    /*
     * save event
     */

    if ($eventsFromApp) {
        if ($event['updated_at'] > $eventsFromApp['update_date']) {

            $updateEvent = [
                'description' => $description,
                'end_date' => $dateEnd,
                'g_latitude' => $eventGeoLocation['lat'],
                'g_longitude' => $eventGeoLocation['lng'],
                'g_title' => $event['address'],
                'start_date' => $dateStart,
                'status' => $eventStatus,
                'title' => $event['title'],
                'shop_link' => $event['url'],
                'update_date' => $event['updated_at']
            ];

            $sql = "UPDATE " . $schema . "event SET description=:description, end_date=:end_date, g_latitude=:g_latitude, "
                . "g_longitude=:g_longitude, g_title=:g_title, start_date=:start_date, status=:status, title=:title, shop_link=:shop_link, "
                . "update_date=:update_date WHERE id='" . $eventsFromApp['id'] . "'";

            $status = $dbApp->prepare($sql)->execute($updateEvent);
            //var_dump($status);
            if ($status) {
                $lastId = $dbSite->lastInsertId();
                dump($lastId);
                dump($updateEvent);
            }

        }
        continue;
    } else {

        if ($eventStatus == 'DELETED') {
            continue;
        }

        $synchronizeId = guidv4(openssl_random_pseudo_bytes(16));

        $eventImage = $event['eventImage'];

        if (strpos($eventImage, 'https://') !== false) {
            $tempFilePath = __DIR__ . '/../storage/app/tmp/' . str_random(32) . '.jpg';
            $fileContents = file_get_contents($eventImage);
            $saveFile = file_put_contents($tempFilePath, $fileContents);
            $file_path = $tempFilePath;
        } else {
            $file_path = __DIR__ . '/../public/' . stristr($eventImage, 'img');
        }

        $storedName = uploadImage($file_path);

        $storedObject = [
            'id' => guidv4(openssl_random_pseudo_bytes(16)),
            'prefix' => 'photo',
            'status' => 'ACTIVE',
            'owner_id' => $userId,
            'stored_name' => $storedName,
            'optlock' => 1
        ];

        $sql = "INSERT INTO " . $schema . "stored_object (id, prefix, status, owner_id, stored_name, optlock) "
            . "VALUES (:id, :prefix, :status, :owner_id, :stored_name, :optlock);";

        $status = $dbApp->prepare($sql)->execute($storedObject);

        if ($status) {
            $lastId = $dbSite->lastInsertId();
            dump($lastId);
        } else {
            dump($dbApp->errorInfo());
            dump($status);
        }


        $eventMedia = [
            'dtype' => 'IMAGE',
            'id' => guidv4(openssl_random_pseudo_bytes(16)),
            'created_at' => Carbon::now(),
            'status' => 'ACTIVE',
            'object_id' => $storedObject['id']
        ];

        $sql = "INSERT INTO " . $schema . "event_media (dtype, id, created_at, status, object_id) "
            . "VALUES (:dtype, :id, :created_at, :status, :object_id);";

        $status = $dbApp->prepare($sql)->execute($eventMedia);
        /*if ($status) {
            $lastId = $dbSite->lastInsertId();
            dump($lastId);
        } else {
            dump($dbApp->errorInfo());
            dump($status);
        }*/


        $baseEvent = [
            'id' => guidv4(openssl_random_pseudo_bytes(16)),
            'type' => 'EVENT'
        ];
        $sql = "INSERT INTO " . $schema . "base_event (id, type) "
            . "VALUES (:id, :type);";

        $status = $dbApp->prepare($sql)->execute($baseEvent);
        /*if ($status) {
            $lastId = $dbSite->lastInsertId();
            dump($lastId);
        } else {
            dump($dbApp->errorInfo());
            dump($status);
        }*/

        $newEvent = [
            'id' => $baseEvent['id'],
            'censor_rate' => 0,
            'create_date' => $event['created_at'],
            'description' => $description,
            'end_date' => $dateEnd,
            'g_latitude' => $eventGeoLocation['lat'],
            'g_longitude' => $eventGeoLocation['lng'],
            'g_title' => $event['address'],
            'private_event' => 'false',
            'event_size' => 'MIDDLE',
            'start_date' => $dateStart,
            'status' => $eventStatus,
            'title' => $event['title'],
            'user_id' => $userId,
            'shop_link' => $event['url'],
            'cover_id' => $eventMedia['id'],
            'update_date' => $event['updated_at'],
            'synchronize_id' => $synchronizeId
        ];

        $sql = "INSERT INTO " . $schema . "event (id, censor_rate, create_date, description, end_date, g_latitude, g_longitude, g_title, private_event, size, start_date, status, title, user_id, shop_link, cover_id, update_date, synchronize_id) "
            . "VALUES (:id, :censor_rate, :create_date, :description, :end_date, :g_latitude, :g_longitude, :g_title, :private_event, :event_size, :start_date, :status, :title, :user_id, :shop_link, :cover_id, :update_date, :synchronize_id);";

        $status = $dbApp->prepare($sql)->execute($newEvent);

        if ($status) {

            $siteEvent = [
                'synchronize_id' => $synchronizeId
            ];
            $sql = "UPDATE events SET synchronize_id=:synchronize_id WHERE id='" . $event['id'] . "'";
            $status = $dbSite->prepare($sql)->execute($siteEvent);

        }

        $row = [
            'id' => $newEvent['id']
        ];
        $sql = "INSERT INTO " . $schema . "simple_event (id) "
            . "VALUES (:id);";

        $status = $dbApp->prepare($sql)->execute($row);

        /*dump($newEvent);
        dump($eventMedia);
        dump($storedObject);*/
    }

}