document.addEventListener("DOMContentLoaded", function() {
    // Get the input element
    var fileInput = document.getElementById('fileInput');

    // Add event listener for when a file is selected
    fileInput.addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            // Create an image element
            var imgElement = document.createElement('img');
            imgElement.src = reader.result;
            imgElement.style.width = '100%';
            imgElement.style.height = '100%';
            imgElement.style. objectFit = 'cover';

            // Clear previous image if any
            var uploadedImage = document.getElementById('uploadedImage');
            uploadedImage.innerHTML = '';

            // Append the new image to the .picture div
            uploadedImage.appendChild(imgElement);
        };

        // Read the selected file as a URL
        reader.readAsDataURL(file);
    });
});