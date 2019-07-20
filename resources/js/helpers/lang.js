export default function (message) {
    const lang = document.documentElement.lang;

    try {
        return require(`../../lang/${lang}.json`)[message];
    } catch {
        return message;
    }
}
