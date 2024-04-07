document.addEventListener('DOMContentLoaded', function () {
    // Your JavaScript code here
    // For example, add the event listeners and call hideTextarea function
    let typesDropdown = document.getElementById('types_id');
    if (typesDropdown) {
        typesDropdown.addEventListener('change', function () {
            hideTextarea();
        });
    }

    let advertisementDropdown = document.getElementById('advertisement');
    if (advertisementDropdown) {
        advertisementDropdown.addEventListener('change', function () {
            // Set the selected advertisement ID as the value of the hidden input field
            document.getElementById('advertisement_id').value = advertisementDropdown.value;

            // Log the selected advertisement value
            console.log(advertisementDropdown.value);
        });

        // Trigger change event when the page loads
        advertisementDropdown.dispatchEvent(new Event('change'));
    }

    hideTextarea(); // Call hideTextarea initially
});

function hideTextarea() {
    let typesDropdown = document.getElementById('types_id');
    let contentField = document.getElementById('content');

    if (typesDropdown && contentField) {
        let selectedOption = typesDropdown.value;
        if (selectedOption === '1') {
            contentField.style.display = 'none';
        } else {
            contentField.style.display = 'block';
        }
    }
}
