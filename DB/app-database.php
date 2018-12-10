<?php

require_once 'connections.php';

use \Carbon\Carbon;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


function guidv4()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function uploadImage($file_path)
{
    $bucket = 'assets.showapp.ru';

    //$file_path = __DIR__ . '/../public/img/eventImage/php1OZf9W.jpg';
    $keyname = guidv4(openssl_random_pseudo_bytes(16));

    $s3 = new S3Client([
        'version' => 'latest',
        'region' => 'eu-west-1',
        'credentials' => [
            'key' => 'AKIAJIES77PZ3WMXURMA',
            'secret' => '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'
        ]
    ]);

    try {
        // Upload data.
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => 'original/photo/' . $keyname,
            'Body' => fopen($file_path, 'r'),
            'ACL' => 'public-read'
        ]);

        // Print the URL to the object.
        //echo '<a href="'. $result['ObjectURL'] . PHP_EOL .'">' . $result['ObjectURL'] . PHP_EOL . '</a>';
        return $keyname;
    } catch (S3Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}

function uploadAvatar($file_path)
{
    $bucket = 'assets.showapp.ru';

    //$file_path = __DIR__ . '/../public/img/eventImage/php1OZf9W.jpg';
    $keyname = guidv4(openssl_random_pseudo_bytes(16));

    $s3 = new S3Client([
        'version' => 'latest',
        'region' => 'eu-west-1',
        'credentials' => [
            'key' => 'AKIAJIES77PZ3WMXURMA',
            'secret' => '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'
        ]
    ]);

    try {
        // Upload data.
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => 'original/avatar/' . $keyname,
            'Body' => fopen($file_path, 'r'),
            'ACL' => 'public-read'
        ]);

        // Print the URL to the object.
        //echo '<a href="'. $result['ObjectURL'] . PHP_EOL .'">' . $result['ObjectURL'] . PHP_EOL . '</a>';
        return $keyname;
    } catch (S3Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
//$img = uploadImage();
//dump($img);

try {

    /*
     * add user from site to app
     */

    //$userFromSite = $dbSite->query("SELECT * FROM users where email IS NOT NULL and password IS NOT NULL and firstName IS NOT NULL and `type`='default'");
    $userFromSite = $dbSite->query("SELECT * FROM users where email = 'Lasos2005@gmail.com'");

    foreach ($userFromSite as $user) {
        var_dump($user['type']);
        //$credentialsFromApp = $dbApp->query("select * from " . $schema . "email_password_principal where email='" . $user['email'] . "'");
        //$credentialsFromApp = $credentialsFromApp->fetch(PDO::FETCH_ASSOC);
        //$user['email']
        $credentialsFromAppSQL = "select * from " . $schema . "email_password_principal where email=:email";
        $credentialsFromApp = $dbApp->prepare($credentialsFromAppSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $credentialsFromApp->execute(array(':email' => $user['email']));
        $credentialsFromApp = $credentialsFromApp->fetch(PDO::FETCH_ASSOC);

        //var_dump($credentialsFromApp);
        //$userCheckToEmail = $dbApp->query("select * from " . $schema . "intouch_user where nick_name='" . $user['firstName'] . "'");
        //$userCheckToEmail = $userCheckToEmail->fetch(PDO::FETCH_ASSOC);
        //'" . $user['firstName'] .
        $userCheckToEmailSQL = "select * from " . $schema . "intouch_user where nick_name=:nick_name";
        $userCheckToEmail = $dbApp->prepare($userCheckToEmailSQL,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $userCheckToEmail->execute(array(':nick_name' => $user['firstName']));
        $userCheckToEmail = $userCheckToEmail->fetch(PDO::FETCH_ASSOC);
        //var_dump($credentialsFromApp);



        $userCheckToNameSQL = "select * from " . $schema . "intouch_user where nick_name=:nick_name";
        //'" . $user['firstName'] . "'
        $userCheckToName = $dbApp->prepare($userCheckToNameSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $userCheckToName->execute(array(':nick_name' => $user['firstName']));
        $userCheckToName = $userCheckToName->fetch(PDO::FETCH_ASSOC);
        //var_dump($userCheckToName);
        var_dump($userCheckToName);
        if ($credentialsFromApp || $userCheckToName) {
            $row = [
                'id' => $userCheckToName['id'],
                'nick_name' => $user['firstName'],
            ];
            //var_dump($userCheckToName['id']);
            /*
             * TODO : Bad idea
             */
            /*
            $passwordFromSite = $user['password'];

            $checkPass = explode("$", $passwordFromSite);
            if($checkPass[1] == '2y'){
                $changePass = explode("$2y", $passwordFromSite);
                $password = '$2a' . $changePass[1];
            }else{
                $password = $passwordFromSite;
            }
            */
            $row1 = [
                'id' => $userCheckToName['id'],
                //'password' => $password,
                'password' => $user['password'],
                //'email' => $credentialsFromApp['email'],
            ];
            //$sql = "UPDATE" . $schema . "intouch_user (id, nick_name, create_date, update_date, accaunt_status, is_deleted, geonameid, pis_actual_id, pis_updated_id, pis_updated_at, magic_key) VALUES (:id, :nick_name, :create_date, :update_date, :accaunt_status, :is_deleted, :geonameid, :pis_actual_id, :pis_updated_id, :pis_updated_at, :magic_key);";
            $sql = "UPDATE " . $schema . "intouch_user SET nick_name=:nick_name where id=:id";
            //password=:password, email=:email
            $status = $dbApp->prepare($sql)->execute($row);
            //var_dump($status);
            $sql = "UPDATE " . $schema . "email_password_principal SET password=:password where user_id=:id";
            $status = $dbApp->prepare($sql)->execute($row1);

            if($user['type']=='admin'){
                $roleRole = 2;
            }
            elseif ($user['type']=='default'){
                $roleRole = 1;
            }
            elseif ($user['type']=='moderator'){
                $roleRole = 3;
            }

            $role = [
                'user_id' =>$userCheckToName['id'],
                'role_id' =>$roleRole
            ];

            $sql = "UPDATE " . $schema . "user_2_role SET role_id=:role_id where user_id=:user_id";
            $status = $dbApp->prepare($sql)->execute($role);
            echo 'adasdsadasda';
            var_dump($status);










            if ($user['photo']) {
                $userAvatar = $user['photo'];

                if (strpos($userAvatar, 'https://') !== false) {
                    $tempFilePath = __DIR__ . '/../storage/app/tmp/' . str_random(32) . '.jpg';
                    $fileContents = file_get_contents($userAvatar);
                    $saveFile = file_put_contents($tempFilePath, $fileContents);
                    $file_path = $tempFilePath;
                } else {
                    $file_path = __DIR__ . '/../public/' . stristr($userAvatar, 'img');
                }

                $storedName = uploadAvatar($file_path);

                $storedObject = [
                    //'id' => guidv4(openssl_random_pseudo_bytes(16)),
                    'prefix' => 'avatar',
                    //'status' => 'ACTIVE',
                    'owner_id' => $userCheckToName['id'],
                    'stored_name' => $storedName,
                ];

                $sql = "UPDATE " . $schema . "stored_object SET stored_name=:stored_name where owner_id=:owner_id and prefix=:prefix";

                $status = $dbApp->prepare($sql)->execute($storedObject);
                var_dump($status);

            }



        } else {



            $row = [
                'id' => guidv4(),
                'nick_name' => $user['firstName'],
                'create_date' => Carbon::now(),
                'update_date' => Carbon::now(),
                'accaunt_status' => 'OK',
                'is_deleted' => 'false',
                'geonameid' => rand(),
                'pis_actual_id' => 0,
                'pis_updated_id' => 0,
                'pis_updated_at' => date('Y-m-d h:i:s a', time()),
                'magic_key' => guidv4()
            ];


            //$sql = "INSERT INTO " . $schema . "intouch_user (nick_name, password=:password, update_date, accaunt_status, is_deleted, geonameid, pis_actual_id, pis_updated_id, pis_updated_at, magic_key) VALUES (:nick_name, :create_date, :update_date, :accaunt_status, :is_deleted, :geonameid, :pis_actual_id, :pis_updated_id, :pis_updated_at, :magic_key);";
            $sql = "INSERT INTO " . $schema . "intouch_user (id, nick_name, create_date, update_date, accaunt_status, is_deleted, geonameid, pis_actual_id, pis_updated_id, pis_updated_at, magic_key) VALUES (:id, :nick_name, :create_date, :update_date, :accaunt_status, :is_deleted, :geonameid, :pis_actual_id, :pis_updated_id, :pis_updated_at, :magic_key);";

            $status = $dbApp->prepare($sql)->execute($row);

            var_dump($status);

            $userRole = [
                'user_id' => $row['id'],
                'role_id' => 1
            ];
            $sql = "INSERT INTO " . $schema . "user_2_role (user_id, role_id) VALUES (:user_id, :role_id);";
            $status = $dbApp->prepare($sql)->execute($userRole);
            //var_dump($status);


            $lastId = $dbApp->query("SELECT * FROM " . $schema . "email_password_principal ORDER BY id DESC LIMIT 1");
            $lastId = $lastId->fetch(PDO::FETCH_ASSOC);
            $id = $lastId['id'];
            $id++;

            /*
             * TODO : Bad idea
             */
            /*
            $passwordFromSite = $user['password'];
            $checkPass = explode("$", $passwordFromSite);
            if($checkPass[1] == '2y'){
                $changePass = explode("$2y", $passwordFromSite);
                $password = '$2a' . $changePass[1];
            }else{
                $password = $passwordFromSite;
            }
            */

            $userCredent = [
                'id' => $id,
                'email' => $user['email'],
                //'password' => $password,
                'password' => $user['password'],
                'user_id' => $row['id'],
                'register_date' => date('Y-m-d h:i:s a', time())
            ];
            $sql = "INSERT INTO " . $schema . "email_password_principal (id, email, password, user_id, register_date) VALUES (:id, :email, :password, :user_id, :register_date);";
            $status = $dbApp->prepare($sql)->execute($userCredent);

            if ($user['photo']) {
                $userAvatar = $user['photo'];

                if (strpos($userAvatar, 'https://') !== false) {
                    $tempFilePath = __DIR__ . '/../storage/app/tmp/' . str_random(32) . '.jpg';
                    $fileContents = file_get_contents($userAvatar);
                    $saveFile = file_put_contents($tempFilePath, $fileContents);
                    $file_path = $tempFilePath;
                } else {
                    $file_path = __DIR__ . '/../public/' . stristr($userAvatar, 'img');
                }

                $storedName = uploadAvatar($file_path);

                $storedObject = [
                    'id' => guidv4(openssl_random_pseudo_bytes(16)),
                    'prefix' => 'avatar',
                    'status' => 'ACTIVE',
                    'owner_id' => $userRole['user_id'],
                    'stored_name' => $storedName,
                    'optlock' => 1
                ];

                $sql = "INSERT INTO " . $schema . "stored_object (id, prefix, status, owner_id, stored_name, optlock) "
                    . "VALUES (:id, :prefix, :status, :owner_id, :stored_name, :optlock);";

                $status = $dbApp->prepare($sql)->execute($storedObject);

                $user_avatar =[
                    'id' => guidv4(openssl_random_pseudo_bytes(16)),
                    'created_at' => Carbon::now(),
                    'status' => 'ACTIVE',
                    'owner_id' => $userRole['user_id'],
                    'stored_object_id' => $storedObject['id']
                ];

                $sql = "INSERT INTO " . $schema . "user_avatar (id, created_at, status, owner_id, stored_object_id) "
                    . "VALUES (:id, :created_at, :status, :owner_id, :stored_object_id);";

                $status = $dbApp->prepare($sql)->execute($user_avatar);

                $userChangeAvatar =[
                    'id' => $userRole['user_id'],
                    'avatar_id' => $user_avatar['id']
                ];

                $sql = "UPDATE " . $schema . "intouch_user set avatar_id=:avatar_id where id=:id ";
                $status = $dbApp->prepare($sql)->execute($userChangeAvatar);

            }
        }
    }

    /*
    * add user from site to app
    */


    $eventsFromSite = $dbSite->query("SELECT * FROM events WHERE dateStart >= '" . Carbon::now() . "'");

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


} catch (PDOException $e) {
    dump("Error!: " . $e->getMessage() . "<br/>");
    die();
} catch (\Exception $e) {
    dump("Error!: " . $e->getMessage() . "<br/>");
    die();
}


