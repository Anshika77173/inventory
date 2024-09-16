function fetchEmployeeDetails() {
    const assetId = document.getElementById('asset_id').value;
    if (assetId) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', './transaction.php?asset_id=' + assetId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);

                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById('employees_name').value = data.employees_name || '';
                    document.getElementById('location').value = data.location || '';
                    document.getElementById('date').value = data.date || '';
                }
            } else {
                alert('Error fetching employee details');
            }
        };
        xhr.send();
    }
}

// Add an event listener to the asset_id input field
document.getElementById('asset_id').addEventListener('change', fetchEmployeeDetails);
