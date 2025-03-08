document.addEventListener('DOMContentLoaded', function() {
    function navbarColorOnResize() {
        const element = document.querySelector('your-selector');
        if (element) {
            element.classList.add('your-class');
        }
    }

    // Add event listener for resize
    window.addEventListener('resize', navbarColorOnResize);
    // Initial call
    navbarColorOnResize();
});