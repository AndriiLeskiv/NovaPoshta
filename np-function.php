<?php
$APIKey = 'b263e1660bf1f031f0b4b1b9fb391bf1';

if(isset($_POST['action']) && $_POST['action'] == 'get_department_np' ){
    global $APIKey;

    $cityName = $_POST['cityName'];

    $data = [
        "apiKey" => $APIKey,
        "modelName" => "Address",
        "calledMethod" => "getWarehouses",
        "methodProperties" => [
            "CityName" => $cityName,
            "Limit" => 700,
            "Page" => 1
        ]
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.novaposhta.ua/v2.0/json/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);

    if (!empty($result['success']) && !empty($result['data'])) {
        echo json_encode($result['data']);
    } elseif (!empty($result['errors'])) {
        echo json_encode(['error' => implode(", ", $result['errors'])]);
    } else {
        echo json_encode(['error' => 'Could not retrieve data for city: ' . $cityName]);
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'create_shipment_cod' ) {
    global $APIKey;

    $citySender = $_POST['citySender'];
    $cityRecipient = $_POST['cityRecipient'];
    $senderInfo = json_decode($_POST['senderInfo'], true);
    $recipientInfo = json_decode($_POST['recipientInfo'], true);
    $cargoDescription = $_POST['cargoDescription'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $insurance = $_POST['insurance'];

    if (!$citySender || !$cityRecipient || !$senderInfo || !$recipientInfo || !$cargoDescription || !$weight || !$dimensions || !$insurance) {
        echo json_encode(['error' => 'All fields are required.']);
        exit;
    }

    $data = [
        "apiKey" => $APIKey,
        "modelName" => "Order",
        "calledMethod" => "save",
        "methodProperties" => [
            "CitySender" => $citySender,
            "CityRecipient" => $cityRecipient,
            "SenderName" => $senderInfo['Name'],
            "SenderPhone" => $senderInfo['Phone'],
            "SenderEmail" => $senderInfo['Email'],
            "RecipientName" => $recipientInfo['Name'],
            "RecipientPhone" => $recipientInfo['Phone'],
            "RecipientEmail" => $recipientInfo['Email'],
            "CargoDescription" => $cargoDescription,
            "Weight" => $weight,
            "Dimensions" => $dimensions,
            "InsuranceValue" => $insurance,
            "PaymentMethod" => "CASH_ON_DELIVERY"
        ]
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.novaposhta.ua/v2.0/json/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);

    if (!empty($result['success']) && !empty($result['data'])) {
        echo json_encode(['success' => true, 'data' => $result['data']]);
    } elseif (!empty($result['errors'])) {
        echo json_encode(['error' => implode(", ", $result['errors'])]);
    } else {
        echo json_encode(['error' => 'Could not create shipment.']);
    }
}