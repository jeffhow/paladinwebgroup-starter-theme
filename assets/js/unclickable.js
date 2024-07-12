document.querySelectorAll('li.unclickable > a').forEach( a => {
    a?.removeAttribute('href')
    a?.removeAttribute('itemprop')
});