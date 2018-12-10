<?php

require_once 'connections.php';

use \Carbon\Carbon;


function guidv4()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

try {

    /*
     * added users from app
     */
    //$usersFromApp = $dbApp->query("select * from " . $schema . "intouch_user");
    $usersFromApp = $dbApp->query("select * from " . $schema . "intouch_user where id='b1e42470-e826-43a6-bff3-f977e966d946'");

    foreach ($usersFromApp as $user) {

        $userCredentionalsSQL = "SELECT * FROM " . $schema . "email_password_principal WHERE user_id=:user_id ";

        $userCredentionals = $dbApp->prepare($userCredentionalsSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $userCredentionals->execute(array(':user_id' => $user['id']));
        $userCredentionals = $userCredentionals->fetch(PDO::FETCH_ASSOC);
        //var_dump($userCredentionals);
        if (!$userCredentionals) {
            continue;

        }

        $existUserInSiteSQL = "SELECT * FROM users WHERE email=:email";

        $existUserInSite = $dbSite->prepare($existUserInSiteSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $existUserInSite->execute(array(':email' => $userCredentionals['email']));
        $existUserInSite = $existUserInSite->fetch(PDO::FETCH_ASSOC);

        $userRole = $dbApp->query("SELECT r.name FROM " . $schema . "role r "
            . "JOIN " . $schema . "user_2_role ur ON ur.role_id=r.id "
            . "JOIN " . $schema . "intouch_user iu ON ur.user_id=iu.id WHERE iu.id='" . $user['id'] . "'");

        $userRole = $userRole->fetch(PDO::FETCH_ASSOC);
        if ($userRole['name'] == 'ADMIN') {
            $role = 'admin';
        } else {
            $role = 'default';
        }

        //$userAvatar = $dbApp->query("select obj.* from " . $schema . "stored_object obj "
        //. "join " . $schema . "user_avatar ua on ua.stored_object_id=obj.id where ua.owner_id='" . $user['id'] . "'");
        //$userAvatar = $userAvatar->fetch(PDO::FETCH_ASSOC);

        //var_dump($userAvatar);



        $userAvatarSQL ="select obj.* from " . $schema . "stored_object obj "
            . "join " . $schema . "user_avatar ua on ua.stored_object_id=obj.id where ua.owner_id=:id";
        //'" . $user['id'] . "'
        $userAvatar = $dbApp->prepare($userAvatarSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $userAvatar->execute(array(':id' => $user['id']));
        $userAvatar= $userAvatar->fetch(PDO::FETCH_ASSOC);
        var_dump($userAvatar);


        var_dump($userAvatar);
        if ($userAvatar) {
            $linkToAvatar = 'https://s3-eu-west-1.amazonaws.com/assets.showapp.ru/original/' . $userAvatar['prefix'] . '/' . $userAvatar['stored_name'];
        } else {
            $linkToAvatar = null;
        }

        if ($existUserInSite) {



            if($user['update_date']){
                //$update_date = DateTime::createFromFormat('Y-m-d H:i:s',$user['update_date']);
                $update_date = new DateTime($user['update_date']);
                $update_date = $update_date->format('Y-m-d H:i:s');
                ///$update_date =
            }
            else{
                $update_date =null;
            }


            $row = [
                'id' => $existUserInSite['id'],
                'firstName' => $user['nick_name'],
                'email' => $userCredentionals['email'],
                'password' => $userCredentionals['password'],
                'photo' => $linkToAvatar,
                'userType' => $role,
                'updated_at' => $update_date
            ];

            $sql = "UPDATE users SET firstName=:firstName, email=:email, password=:password, photo=:photo, `type`=:userType, updated_at=:updated_at WHERE id=:id";
            $status = $dbSite->prepare($sql)->execute($row);
            echo '11';
            var_dump($status);
            //var_dump($status);
        } else {
            $row = [
                'firstName' => $user['nick_name'],
                'email' => $userCredentionals['email'],
                'password' => $userCredentionals['password'],
                'photo' => $linkToAvatar,
                'userType' => $role,
            ];
            $sql = "INSERT INTO users SET firstName=:firstName, email=:email, password=:password, photo=:photo, `type`=:userType ;";
            $status = $dbSite->prepare($sql)->execute($row);
            //var_dump($sql);
            //var_dump($status);
            /*if ($status) {
                $lastId = $dbSite->lastInsertId();
                dump($lastId);
            }*/
        }
    }


    /*
     * added events from app
     */

    $eventsFromApp = $dbApp->query("SELECT * FROM " . $schema . "event where end_date>='" . Carbon::now() . "'");

    foreach ($eventsFromApp as $event) {

        $dateStart = explode(" ", $event['start_date']);
        $dateEnd = explode(" ", $event['end_date']);

        $status = '';
        if ($event['status'] == 'ACTIVE') {
            $status = 'false';
        } else {
            $status = 'true';
        }


        $eventFromSiteSQL = "SELECT * from events where title=:title and dateStart=:dateStart and timeStart=:timeStart and address=:address";
        $eventFromSite = $dbSite->prepare($eventFromSiteSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $eventFromSite->execute(array(':title' => $event['title'], ':dateStart' => $dateStart[0], ':timeStart' => $dateStart[1], ':address' => $event['g_title']));
        $eventFromSite = $eventFromSite->fetch(PDO::FETCH_ASSOC);


        $eventImage = $dbApp->query("select obj.* from " . $schema . "stored_object obj "
            . "join " . $schema . "event_media med on med.object_id=obj.id "
            . "join " . $schema . "event ev on ev.cover_id=med.id where ev.id='" . $event['id'] . "'");
        $eventImage = $eventImage->fetch(PDO::FETCH_ASSOC);
        $imageLink = 'https://s3-eu-west-1.amazonaws.com/assets.showapp.ru/original/' . $eventImage['prefix'] . '/' . $eventImage['stored_name'];

        $eventOwnerEmail = $dbApp->query("Select email FROM " . $schema . "email_password_principal WHERE user_id='" . $event['user_id'] . "'");
        $eventOwnerEmail = $eventOwnerEmail->fetch(PDO::FETCH_ASSOC);

        if ($eventOwnerEmail) {
            //$userId = $dbSite->query("SELECT id FROM users WHERE email='" . $eventOwnerEmail['email'] . "'");
            //$userId = $userId->fetch(PDO::FETCH_ASSOC);

            $userIdSQL = "SELECT id FROM users WHERE email=:email ";

            $userId= $dbSite->prepare($userIdSQL, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $userId->execute(array(':email' => $eventOwnerEmail['email']));
            $userId = $userId->fetch(PDO::FETCH_ASSOC);
            //var_dump($userId);

        } else {
            $userId = null;
        }

        if ($eventFromSite) {

            if ($event['update_date'] > $eventFromSite['updated_at']) {
                $row = [
                    'id' => $eventFromSite['id'],
                    'userId' => $userId['id'],
                    'title' => $event['title'],
                    'description' => $event['description'],
                    'address' => $event['g_title'],
                    'dateStart' => $dateStart[0],
                    'timeStart' => $dateStart[1],
                    'dateEnd' => $dateEnd[0],
                    'timeEnd' => $dateEnd[1],
                    'eventImage' => $imageLink,
                    'ageRestrictions' => $event['censor_rate'] . '+',
                    'coverTitle' => $event['title'],
                    'coverImage' => $imageLink,
                    'is_delete' => $status,
                    'url' => $event['shop_link'],
                ];

                $sql = "UPDATE events SET userId=:userId, title=:title, description=:description, address=:address, "
                    . "dateStart=:dateStart, timeStart=:timeStart, dateEnd=:dateEnd, timeEnd=:timeEnd, "
                    . "eventImage=:eventImage, ageRestrictions=:ageRestrictions, coverTitle=:coverTitle, "
                    . "coverImage=:coverImage, is_delete=:is_delete, url=:url WHERE id=:id;";

                $status = $dbSite->prepare($sql)->execute($row);
                //var_dump($sql);
                //var_dump($status);
                //echo $row['description'];
                // echo $row['address'];

            }
        } else {
            $row = [
                //'synchronize_id' => guidv4(openssl_random_pseudo_bytes(16)), //Number of bound variables does not match number of tokens
                'userId' => $userId['id'],
                'title' => $event['title'],
                'description' => $event['description'],
                'address' => $event['g_title'],
                'dateStart' => $dateStart[0],
                'timeStart' => $dateStart[1],
                'dateEnd' => $dateEnd[0],
                'timeEnd' => $dateEnd[1],
                'eventImage' => $imageLink,
                'ageRestrictions' => $event['censor_rate'] . '+',
                'coverTitle' => $event['title'],
                'coverImage' => $imageLink,
                'is_delete' => $status,
                'url' => $event['shop_link'],
            ];
            $synchronize_id = ['synchronize_id' => guidv4(openssl_random_pseudo_bytes(16))];

            $sql = "INSERT INTO events SET userId=:userId, title=:title, description=:description, address=:address, "
                . "dateStart=:dateStart, timeStart=:timeStart, dateEnd=:dateEnd, timeEnd=:timeEnd, "
                . "eventImage=:eventImage, ageRestrictions=:ageRestrictions, coverTitle=:coverTitle, "
                . "coverImage=:coverImage, is_delete=:is_delete, url=:url;";
            $status = $dbSite->prepare($sql)->execute($row);
            if ($status) {
                $appEvent = [
                    'synchronize_id' => $synchronize_id['synchronize_id']
                ];

                $sql = "UPDATE " . $schema . "event SET synchronize_id=:synchronize_id WHERE id='" . $event['id'] . "'";

                $status = $dbApp->prepare($sql)->execute($appEvent);

            }

        }
    }

} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
} catch (\Exception $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}


