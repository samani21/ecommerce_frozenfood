function toggleDropdown() {
    var dropdown = document.getElementById('notification-dropdown');
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
    }
}

function clearNotifications() {
    var dropdownContent = document.querySelector('.dropdown-content');
    dropdownContent.innerHTML = '<a href="#">No new notifications</a>';
    var badge = document.querySelector('.badge');
    badge.style.display = 'none';
}

window.onclick = function(event) {
    if (!event.target.matches('.notification-button')) {
        var dropdown = document.getElementById('notification-dropdown');
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    }
}
