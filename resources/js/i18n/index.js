import { createI18n } from 'vue-i18n';
import { slavicPluralRule } from './pluralRules';
import ru from './locales/ru';
import uk from './locales/uk';

export const SUPPORTED_LOCALES = ['ru', 'uk'];
const STORAGE_KEY = 'locale';
const DEFAULT_LOCALE = 'uk';

export function getStoredLocale() {
    const stored = window.localStorage.getItem(STORAGE_KEY);

    return SUPPORTED_LOCALES.includes(stored) ? stored : DEFAULT_LOCALE;
}

export function setStoredLocale(locale) {
    window.localStorage.setItem(STORAGE_KEY, locale);
    document.documentElement.setAttribute('lang', locale);
}

export const i18n = createI18n({
    legacy: false,
    globalInjection: true,
    locale: getStoredLocale(),
    fallbackLocale: DEFAULT_LOCALE,
    messages: { ru, uk },
    pluralRules: {
        ru: slavicPluralRule,
        uk: slavicPluralRule,
    },
});

document.documentElement.setAttribute('lang', getStoredLocale());
