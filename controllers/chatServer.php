<?php

include_once dirname(__FILE__) . "/../config.php";

$STREAM_API_KEY = "4tzvzaae6fh3";
$STREAM_API_SECRET = "zbbd7x5xgvz6v8tgxfjz78hh6dyv5t8zuvahat2m46etxnnkutvbvf5p2r7v8hx7";

// Initialize the SDK
$client = new \GetStream\StreamChat\Client(
    $STREAM_API_KEY,
    $STREAM_API_SECRET
);

// var_dump($client->getBaseUrl());

if (isset($_REQUEST["create-token"])) {
    die(json_encode([
        "status" => "success",
        "token"  => $client->createToken($_REQUEST["create-token"])
    ]));
    echo "Chat Client Token Created";
}
else {
    echo "Chat Client Not Token Created";
}