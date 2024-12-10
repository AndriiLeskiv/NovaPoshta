<?php
function getWarehousesByCity($cityName = '') {
    $apiKey = 'b263e1660bf1f031f0b4b1b9fb391bf1';
    $url = 'https://api.novaposhta.ua/v2.0/json/';

    // Крок 1: Отримуємо CityRef для міста
    $cityData = [
        'apiKey' => $apiKey,
        'modelName' => 'Address',
        'calledMethod' => 'getCities',
        'methodProperties' => [
            'FindByString' => $cityName
        ]
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($cityData),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    if (!$response['success'] || empty($response['data'])) {
        return [
            'success' => false,
            'error' => 'City not found'
        ];
    }

    // Крок 2: Отримуємо CityRef
    $cityRef = $response['data'][0]['Ref'];

    // Крок 3: Отримуємо відділення для цього міста в одному запиті
    $result = file_get_contents($url, false, stream_context_create([
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode([
                'apiKey' => $apiKey,
                'modelName' => 'Address',
                'calledMethod' => 'getWarehouses',
                'methodProperties' => ['CityRef' => $cityRef]
            ]),
        ],
    ]));

    return json_decode($result, true);
}

$warehouses = getWarehousesByCity();
header('Content-Type: application/json');
//echo json_encode($warehouses);

print_r($warehouses);


?>
