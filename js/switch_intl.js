window.addEventListener('DOMContentLoaded', (event) => {
    const links = Array.from(document.getElementsByClassName('intl'));
    const locale = (window.navigator.language || window.navigator.userLanguage || 'en').toLowerCase();
    if (locale.startsWith('ja')) {
        for(let i = 0; i < links.length; i++) {
            links[i].setAttribute('href', links[i].getAttribute('href').replace('/en/', '/ja/'));
        }
    }
});
