<?php
require_once 'cloudinary/autoload.php';
require_once 'cloudinary/src/Cloudinary.php';
require_once 'cloudinary/src/Uploader.php';
require_once 'cloudinary/src/Api.php';

function uploadFile($linkfile){
    \Cloudinary::config(array( 
        "cloud_name" => "dyhy5jhmp", 
        "api_key" => "884398671429262",
        "api_secret" => "81gbFwoCD2gR0WUAM1LY28uJQaA",
        "secure" => true
    ));
    $response_without_parameters = \Cloudinary\Uploader::upload($linkfile);
    $file_name = $response_without_parameters['public_id'];
    $file_link = $response_without_parameters['url'];
    return $file_link;
}

?>


