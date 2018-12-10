<?php
require_once 'conf.php';
require_once __DIR__ . '/../vendor/autoload.php';

try{
    $dbSite = new PDO('mysql:host=' . $siteHost . ';port=' . $sitePort . ';dbname=' . $siteDbName . ';charset=utf8', $siteUser, $sitePasswrd, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $dbApp = new PDO('pgsql:host=' . $appHost . ';port=' . $appPort . ';dbname=' . $appDbName, $appUser, $appPasswrd, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $dbApp->exec('SET search_path TO prod_schema');
}catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}catch (\Exception $e) {
    echo "Error!: " . $e->getMessage() . "<br/>" ;
    die();
}
