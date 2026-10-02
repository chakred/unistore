<template>
    <div class="language-switcher">
        <button
            v-for="item in locales"
            :key="item.code"
            type="button"
            class="language-switcher__btn"
            :class="{ 'language-switcher__btn--active': currentLocale === item.code }"
            @click="setLocale(item.code)"
        >
            {{ item.label }}
        </button>
    </div>
</template>

<script>
import { useI18n } from 'vue-i18n';
import { SUPPORTED_LOCALES, setStoredLocale } from '@/i18n';

const LABELS = {
    ru: 'RU',
    uk: 'UA',
};

export default {
    /**
     * Name.
     */
    name: 'LanguageSwitcher',

    /**
     * Composition API.
     */
    setup() {
        const { locale } = useI18n();

        const locales = SUPPORTED_LOCALES.map((code) => ({
            code,
            label: LABELS[code] ?? code.toUpperCase(),
        }));

        const setLocale = (code) => {
            locale.value = code;
            setStoredLocale(code);
        };

        return {
            locales,
            currentLocale: locale,
            setLocale,
        };
    },
}
</script>

<style scoped>
.language-switcher {
    display: flex;
    gap: .25rem;
    margin-left: .75rem;
}

.language-switcher__btn {
    background: none;
    border: 1px solid rgba(255, 255, 255, .35);
    color: rgba(255, 255, 255, .7);
    border-radius: 4px;
    font-size: .75rem;
    font-weight: 600;
    line-height: 1;
    padding: .3rem .5rem;
    cursor: pointer;
    transition: all .15s ease;
}

.language-switcher__btn--active {
    background: #fff;
    color: #212529;
    border-color: #fff;
}

.language-switcher__btn:not(.language-switcher__btn--active):hover {
    border-color: rgba(255, 255, 255, .7);
    color: #fff;
}
</style>
