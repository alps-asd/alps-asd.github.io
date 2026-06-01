window.addEventListener('DOMContentLoaded', () => {
    const navigatorLanguages = window.navigator.languages;
    const locales = (navigatorLanguages && navigatorLanguages.length)
        ? navigatorLanguages
        : [window.navigator.language || window.navigator.userLanguage || 'en'];
    const prefersJapanese = locales.some((locale) => locale.toLowerCase().startsWith('ja'));

    if (!prefersJapanese) {
        return;
    }

    const links = Array.from(document.getElementsByClassName('intl'));
    for (const link of links) {
        const href = link.getAttribute('href');
        if (href && href.includes('/en/')) {
            link.setAttribute('href', href.replace('/en/', '/ja/'));
        }
    }
});
