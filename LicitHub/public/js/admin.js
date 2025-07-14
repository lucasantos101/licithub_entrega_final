document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            if (sidebar) {
                sidebar.classList.toggle('show');
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (window.innerWidth < 992 && sidebar && !sidebar.contains(e.target) && e.target !== toggleBtn) {
            sidebar.classList.remove('show');
        }
    });

    const currentUrl = window.location.href;
    const menuItems = document.querySelectorAll('.menu-item a');

    menuItems.forEach(item => {
        if (item.href === currentUrl) {
            item.parentElement.classList.add('active');
        }
    });
});
