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