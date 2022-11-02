const navItems = document.querySelector('.nav-items');
const hamburger = document.querySelector('.hamburger');
const closeHamburger = document.querySelector('.close-hamburger');

const openNav = () =>{
    navItems.style.display = 'flex';
    hamburger.style.display = 'none';
    closeHamburger.style.display = 'inline-block';
}

const closeNav = () =>{
    navItems.style.display = 'none';
    hamburger.style.display = 'inline-block';
    closeHamburger.style.display = 'none';
}

hamburger.addEventListener('click',openNav);
closeHamburger.addEventListener('click',closeNav);

const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show-sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide-sidebar-btn');

const showSidebar = () =>{
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
}

const hideSidebar = () =>{
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}

showSidebarBtn.addEventListener('click',showSidebar);
hideSidebarBtn.addEventListener('click',hideSidebar);