document.getElementById('searchButton').addEventListener('click', function() {
    let cityName = document.getElementById('cityName').value;

    fetch('np-function.php', {
        method: 'POST',
        body: new URLSearchParams({
            'cityName': cityName,
            'action' : 'get_department_np'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

document.getElementById('createShipmentButton').addEventListener('click', function() {
    let citySender = document.getElementById('citySender').value;
    let cityRecipient = document.getElementById('cityRecipient').value;
    let senderInfo = {
        'Name': document.getElementById('senderName').value,
        'Phone': document.getElementById('senderPhone').value,
        'Email': document.getElementById('senderEmail').value
    };
    let recipientInfo = {
        'Name': document.getElementById('recipientName').value,
        'Phone': document.getElementById('recipientPhone').value,
        'Email': document.getElementById('recipientEmail').value
    };
    let cargoDescription = document.getElementById('cargoDescription').value;
    let weight = document.getElementById('cargoWeight').value;
    let dimensions = document.getElementById('cargoDimensions').value;
    let insurance = document.getElementById('cargoInsurance').value;

    fetch('np-function.php', {
        method: 'POST',
        body: new URLSearchParams({
            'citySender': citySender,
            'cityRecipient': cityRecipient,
            'senderInfo': JSON.stringify(senderInfo),
            'recipientInfo': JSON.stringify(recipientInfo),
            'cargoDescription': cargoDescription,
            'weight': weight,
            'dimensions': dimensions,
            'insurance': insurance,
            'action': 'create_shipment_cod'
        })
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});