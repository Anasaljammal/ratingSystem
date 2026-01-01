// Modern Image Preview Handler
const inputPhoto = document.getElementById('file');
const previewImage = document.getElementById('image');
const inputPhoto2 = document.getElementById('file2');
const previewImage2 = document.getElementById('image2');
const fileInput = document.getElementById('file-input');
const imagePreview = document.getElementById('image-preview');

// Handle new register page image preview
if (fileInput && imagePreview) {
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                imagePreview.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    });
}

// Handle old register page image preview
if (inputPhoto && previewImage) {
    inputPhoto.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    });
}

// Handle second image input (if exists)
if (inputPhoto2 && previewImage2) {
    inputPhoto2.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImage2.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    });
}
