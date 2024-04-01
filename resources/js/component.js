document.addEventListener('DOMContentLoaded', function () {
    const typeElement = document.getElementById('type');
    if (typeElement) {
        typeElement.addEventListener('change', function () {
            const type = this.value;
            const imageUpload = document.getElementById('image-upload');
            const imageForm = document.getElementById('image-form');

            if (type === 'image') {
                imageUpload.classList.remove('hidden');
                imageForm.classList.remove('hidden');
            } else {
                imageUpload.classList.add('hidden');
                imageForm.classList.add('hidden');
            }
        });
    }
});
