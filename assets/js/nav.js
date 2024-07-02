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
    ham.attributes['aria-expanded'].value = false;
    ham.classList.remove('open');
}

links.forEach(function(l){
    l.addEventListener('click', closeMenu);
});
