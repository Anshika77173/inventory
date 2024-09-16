const sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu_bar');
const closeBtn = document.querySelector('#close_btn');
const themeToggler = document.querySelector('.theme-toggler');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = "block";
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = "none";
});

themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

    // Update CSS variables
    if (document.body.classList.contains('dark-theme-variables')) {
        document.documentElement.style.setProperty('--clr-color-background', '#181a1e');
        document.documentElement.style.setProperty('--clr-white', '#202528');
        document.documentElement.style.setProperty('--clr-light', 'rgba(0, 0, 0, 0.4)');
        document.documentElement.style.setProperty('--clr-dark', '#edeffd');
        document.documentElement.style.setProperty('--clr-dark-variant', '#677483');
        document.documentElement.style.setProperty('--box-shadow', '0 2rem 3rem rgba(0, 0, 0, 0.4)');
    } else {
        document.documentElement.style.setProperty('--clr-color-background', '#f6f6f9');
        document.documentElement.style.setProperty('--clr-white', '#fff');
        document.documentElement.style.setProperty('--clr-light', 'rgba(132, 139, 200, 0.18)');
        document.documentElement.style.setProperty('--clr-dark', '#363949');
        document.documentElement.style.setProperty('--clr-dark-variant', '#677483');
        document.documentElement.style.setProperty('--box-shadow', '0 2rem 3rem rgba(132, 139, 200, 0.18)');
    }

    // Save theme state to localStorage
    if (document.body.classList.contains('dark-theme-variables')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.removeItem('theme');
    }

    // Propagate theme change to loaded content
    const iframes = document.querySelectorAll('iframe');
    iframes.forEach(iframe => {
        iframe.contentWindow.localStorage.setItem('theme', localStorage.getItem('theme'));
        iframe.contentWindow.dispatchEvent(new Event('storage'));
    });
});
