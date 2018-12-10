<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 09.06.18
 * Time: 10:35
 */
return [
    'client_id' => env ('PAYPAL_SANDBOX_CLIENT_ID', ''),
    'secret' => env ('PAYPAL_SANDBOX_SECRET', ''),
    'settings' => array (
        'mode' => env ('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut'=> 30,
        'log.LogEnabled'=> true,
        'log.FileName'=> storage_path ().'/logs/paypal.log',
        'log.LogLevel'=>'ERROR'
    ),
];