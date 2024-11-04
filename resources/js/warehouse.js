document.getElementById('profileImage').onchange = function (event) {
    let reader = new FileReader();
    reader.onload = function () {
        let output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block'; // Make sure the preview is visible
    };
    reader.readAsDataURL(event.target.files[0]);
};
// Improved script to hide the success alert after 2 seconds if it exists
document.addEventListener("DOMContentLoaded", function() {
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
    }
});
document.querySelectorAll('.toggle-status').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const userId = this.dataset.userId;
        const isStatus = this.checked;
        fetch(userStatusUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                user_id: userId,
                status: isStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        });
    });
});