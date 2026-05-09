var path = window.location.pathname;
var page = path.split("/").pop();
var navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(function(link) {
    link.classList.remove('active');
    var href = link.getAttribute('href');
    if (href && href.split('/').pop() === page) {
        link.classList.add('active');
    }
});