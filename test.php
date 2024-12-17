<?php

$apiKey = "b263e1660bf1f031f0b4b1b9fb391bf1";
$cityName = "Львів";

$data = [
    "apiKey" => $apiKey,
    "modelName" => "Address",
    "calledMethod" => "getWarehouses",
    "methodProperties" => [
        "CityName" => $cityName,
        "Limit" => 100,
        "Page" => 1
    ]
];

$ch = curl_init("https://api.novaposhta.ua/v2.0/json/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

echo '<pre>';
print_r($result);
echo '</pre>';
