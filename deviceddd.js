function loadDevices() {
    fetch('deviceddd.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const select = document.getElementById('deviceSelect');
        select.innerHTML = ''; // Clear previous options
        data.devices.forEach(device => {
            let option = document.createElement('option');
            option.value = device.id;
            option.text = device.name;
            select.add(option);
        });
    })
    .catch(error => console.error('Error loading devices:', error));
}

function insertValue() {
    const select = document.getElementById("deviceSelect");
    const txtVal = document.getElementById("val").value;
    fetch('deviceddd.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: txtVal, action: 'add' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error); // Display the error message in a popup
        } else {
            let newOption = document.createElement("option");
            newOption.value = data.id;
            newOption.text = data.name;
            select.add(newOption);
            document.getElementById('val').value = ''; 
            if (data.message) {
                alert(data.message); // Show the restore message
            }
        }
    })
    .catch(error => console.error('Error adding device:', error));
}

function removeSelectedValue() {
    const select = document.getElementById("deviceSelect");
    const selectedOption = select.options[select.selectedIndex];
    if (selectedOption.value) {
        fetch('deviceddd.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: selectedOption.value, action: 'delete' })
        })
        .then(response => response.json())
        .then(data => {
            select.remove(select.selectedIndex);
            loadDevices();
        })
        .catch(error => console.error('Error removing device:', error));
    }
}

// Call the loadDevices function when the content is fully loaded
document.addEventListener('DOMContentLoaded', (event) => {
    loadDevices();
});
