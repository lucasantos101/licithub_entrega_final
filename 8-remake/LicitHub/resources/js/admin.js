document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');
    
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('show');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth < 992 && !sidebar.contains(e.target) && e.target !== toggleBtn) {
            sidebar.classList.remove('show');
        }
    });
    
    // Active menu item based on current URL
    const currentUrl = window.location.href;
    const menuItems = document.querySelectorAll('.menu-item a');
    
    menuItems.forEach(item => {
        if (item.href === currentUrl) {
            item.parentElement.classList.add('active');
        }
    });
});