const nav = document.getElementById('navbar')
const navOpenIcon = document.getElementById('navbar-icon-open');
const navCloseIcon = document.getElementById('navbar-icon-close');

navOpenIcon.addEventListener('click', () => {
    nav.classList.remove('-navbar-responsive-closed');
    navOpenIcon.classList.add('-navbar-hidden');
    navCloseIcon.classList.remove('-navbar-hidden');
});

navCloseIcon.addEventListener('click', () => {
    nav.classList.add('-navbar-responsive-closed');
    navCloseIcon.classList.add('-navbar-hidden');
    navOpenIcon.classList.remove('-navbar-hidden');
});
