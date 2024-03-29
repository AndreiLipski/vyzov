window.addEventListener('DOMContentLoaded', () => {
    const menu = document.querySelector('.nav-menu'),
        menuItem = document.querySelectorAll('.nav-menu__list-item'),
        hamburger = document.querySelector('.hamburger'),
        header = document.querySelector('header'),
        body = document.querySelector('body');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('hamburger_active');
        menu.classList.toggle('nav-menu_active');
        body.classList.toggle('overflow');

    });

    menuItem.forEach(item => {
        item.addEventListener('click', () => {
            hamburger.classList.toggle('hamburger_active');
            menu.classList.toggle('nav-menu_active');
            body.classList.toggle('overflow');
        })
    })

    window.onscroll = function (e) {
        if (window.scrollY > 80) {
            header.classList.add('sticky')
        } else {
            header.classList.remove('sticky')
        }
    }


})