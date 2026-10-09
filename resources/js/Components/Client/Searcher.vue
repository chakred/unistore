<template>
    <div class="search-for-goods">
        <div class="search-for-goods__heading">
            <span class="search-for-goods__icon"><i class="fas fa-search"></i></span>
            <div>
                <h2 class="search-for-goods__title">{{ $t('search.title') }}</h2>
            </div>
        </div>
        <form
            @submit.prevent="form.get(route('home.search'))"
            enctype="multipart/form-data"
            role="search"
            class="search-for-goods__fields"
        >
            <div class="search-for-goods__field">
                <div class="search-for-goods__input-wrap">
                    <input
                        v-model="form.keyWord"
                        type="text"
                        class="form-control search-for-goods__input"
                        id="floatingSearch"
                        :aria-label="$t('search.placeholder')"
                        :placeholder="$t('search.placeholder')"
                    >
                    <button
                        v-if="form.keyWord"
                        type="button"
                        class="search-for-goods__clear"
                        :aria-label="$t('search.clear')"
                        @click="clearSearch"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="search-for-goods__submit">
                <i class="fas fa-search"></i> {{ $t('search.submit') }}
            </button>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'Searcher',

    /**
     * Props.
     */
    props: {
        keyword: {
            type: String,
            default: '',
        },
    },

    /**
     * Composition API.
     */
    setup(props) {
        const form = useForm({
            keyWord: props.keyword,
        })

        return { form };
    },

    /**
     * Methods.
     */
    methods: {
        clearSearch() {
            this.form.keyWord = '';

            if (this.route().current('home.search')) {
                this.form.get(this.route('home.search'));
            }
        },
    },
}
</script>

<style scoped>
.search-for-goods {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    border-radius: 8px;
    background: linear-gradient(135deg, #212529 0%, #343a40 100%);
    box-shadow: 0 10px 24px rgba(0, 0, 0, .18);
}

.search-for-goods__heading {
    display: flex;
    align-items: center;
    gap: .9rem;
    margin-bottom: 1.25rem;
}

.search-for-goods__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 50%;
    background: rgba(255, 255, 255, .12);
    color: #fff;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.search-for-goods__title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0;
}

.search-for-goods__fields {
    display: grid;
    grid-template-columns: 1fr;
    gap: .75rem;
    align-items: end;
}

@media (min-width: 768px) {
    .search-for-goods__fields {
        grid-template-columns: 1fr auto;
    }
}

.search-for-goods__input-wrap {
    position: relative;
}

.search-for-goods__input {
    border: none;
    border-radius: 6px;
    padding-top: .55rem;
    padding-bottom: .55rem;
    padding-right: 2.25rem;
}

.search-for-goods__clear {
    position: absolute;
    top: 50%;
    right: .6rem;
    transform: translateY(-50%);
    background: none;
    border: none;
    padding: .25rem;
    line-height: 1;
    color: #6c757d;
}

.search-for-goods__clear:hover {
    color: #212529;
}

.search-for-goods__submit {
    border: none;
    border-radius: 6px;
    padding: .55rem 1.5rem;
    font-weight: 700;
    color: #212529;
    background: #ffc107;
    transition: background-color .15s ease, transform .15s ease;
    white-space: nowrap;
}

.search-for-goods__submit:hover {
    background: #ffca2c;
    transform: translateY(-1px);
}
</style>
