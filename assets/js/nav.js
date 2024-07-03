const ham = document.querySelector('.nav-toggle');
const menu = document.querySelector('.site-nav');
const links = menu.querySelectorAll('a');

function hamToggle(){
    this.classList.toggle('open');
    let expanded = (menu.attributes['aria-expanded'].value === 'true');
    menu.attributes['aria-expanded'].value = !expanded;
}
ham.addEventListener('click', hamToggle);

function closeMenu(){
    menu.attributes['aria-expanded'].value = false;
    menu.classList.remove('open');
}

links.forEach(function(l){
    l.addEventListener('click', closeMenu);
});


// remove aria-expanded on desktop
function viewDesktop() {
    menu.removeAttribute('aria-expanded');
    menu.classList.remove('open');
}

// add aria-expanded if needed
function viewMobile(){
    if(!menu.hasAttribute('aria-expanded')) {
        menu.setAttribute('aria-expanded', false)
    }
}

addEventListener("resize", (event) => {
    if (window.innerWidth < 782) {
        viewMobile()
        
    }else {
        viewDesktop()
    }
});


if (window.innerWidth >= 782) {
    viewDesktop();
}