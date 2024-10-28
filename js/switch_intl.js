window.addEventListener('DOMContentLoaded', (event) => {
    const links = document.getElementsByClassName('intl');
    const locale = window.navigator.language;
    if (locale.startsWith('ja')) {
        for(let i = 0; i < links.length; i++) {
            links[i].setAttribute('href', links[i].getAttribute('href').replace('/en/', '/ja/'));
        }
    }
});
