<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php


//$result = getInfoByCityName('Львів');
//echo '<pre>';
//print_r($result);
//echo '</pre>';
?>

<input type="text" id="cityName" placeholder="Enter city name">
<button id="searchButton">Search</button>



<form id="shipmentForm" action="">
    <h3>Sender Information</h3>
    <label for="senderName">Name:</label>
    <input type="text" id="senderName" required><br>

    <label for="senderPhone">Phone:</label>
    <input type="text" id="senderPhone" required><br>

    <label for="senderEmail">Email:</label>
    <input type="email" id="senderEmail" required><br>

    <h3>Recipient Information</h3>
    <label for="recipientName">Name:</label>
    <input type="text" id="recipientName" required><br>

    <label for="recipientPhone">Phone:</label>
    <input type="text" id="recipientPhone" required><br>

    <label for="recipientEmail">Email:</label>
    <input type="email" id="recipientEmail" required><br>

    <h3>Shipment Details</h3>
    <label for="citySender">City (Sender):</label>
    <input type="text" id="citySender" required><br>

    <label for="cityRecipient">City (Recipient):</label>
    <input type="text" id="cityRecipient" required><br>

    <label for="cargoDescription">Cargo Description:</label>
    <textarea id="cargoDescription" required></textarea><br>

    <label for="cargoWeight">Cargo Weight (kg):</label>
    <input type="number" id="cargoWeight" required><br>

    <label for="cargoDimensions">Cargo Dimensions (LxWxH):</label>
    <input type="text" id="cargoDimensions" placeholder="e.g., 30x20x15" required><br>

    <label for="cargoInsurance">Insurance Value:</label>
    <input type="number" id="cargoInsurance" placeholder="e.g., 5000" required><br>

    <button type="button" id="createShipmentButton">Create Shipment</button>
</form>
<script src="js/main.js"></script>
</body>
</html>