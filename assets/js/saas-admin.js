// admin2/assets/js/saas-admin.js
// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Create mobile menu toggle
    const menuToggle = document.createElement('button');
    menuToggle.className = 'menu-toggle';
    menuToggle.innerHTML = '<i class="bi bi-list"></i>';
    document.body.appendChild(menuToggle);
    
    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);
    
    // Get sidebar
    const sidebar = document.querySelector('.sidebar-saas') || document.querySelector('.sidebar');
    
    // Toggle menu
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        menuToggle.innerHTML = sidebar.classList.contains('active') 
            ? '<i class="bi bi-x-lg"></i>' 
            : '<i class="bi bi-list"></i>';
    });
    
    // Close on overlay click
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        menuToggle.innerHTML = '<i class="bi bi-list"></i>';
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            menuToggle.innerHTML = '<i class="bi bi-list"></i>';
        }
    });
});