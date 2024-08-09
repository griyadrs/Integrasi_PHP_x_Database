<?php

require "CategoryProduct.php";

header('Content-Type: application/json');

function send_Json_Response(array $response) {
    echo json_encode($response);
}

try {
    $category = new Category();
    $category->insert();

    send_Json_Response(['message' 
        => 'success']);
} catch (Exception $e) {
    send_Json_Response(['message' 
        => $e->getMessage()]);
}