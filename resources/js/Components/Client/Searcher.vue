<template>
    <div class="search-for-goods">
        <form
            @submit.prevent="form.get(route('home.search'))"
            enctype="multipart/form-data"
            role="search"
        >
            <div class="form-floating mb-3 search-for-goods__field">
                <input
                    v-model="form.keyWord"
                    type="text"
                    class="form-control"
                    id="floatingSearch"
                    placeholder="Search"
                >
                <label for="floatingSearch">
                    <i class="fas fa-search"></i> search...
                </label>
                <button
                    v-if="form.keyWord"
                    type="button"
                    class="search-for-goods__clear"
                    aria-label="Очистить поиск"
                    @click="clearSearch"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
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
.search-for-goods__field {
    position: relative;
}

.search-for-goods__field .form-control {
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
</style>
