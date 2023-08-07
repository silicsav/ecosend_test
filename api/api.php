<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once ('../connections/MysqliDb.php');

$db = new MysqliDb ('localhost', 'root', 'root', 'test_db');


if (isset($_POST)){
$name = isset($_POST['name']);
$desc = isset($_POST['description']);
$add = isset($_POST['address']);
$country = isset($_POST['country']);
$state = isset($_POST['state']);
$city = isset($_POST['city']);
$zip = isset($_POST['zip']);

$resp = new stdClass();

if($name =='' ||$desc =='' ||$add =='' ||$country =='' ||$state=='' ||$city==''){
    $resp->status = 201;
    $resp->message = 'all parameters are required';
    echo json_encode($resp);
    exit;

}

$data = [
    'name' => $name,
    'desc' => $desc,
    'add' => $add,
    'country' => $country,
    'state' => $state, 
    'city' => $city, 
    'zip' => $zip

];

// Now insert the data.
if($db->insert('products',$data)){
    $resp->status = 200;
    $resp->message = 'Thank you for your purchase, We shall deliver the products to the given address';
    echo json_encode($resp);
    exit;
    
}
}


// Validate the data.

