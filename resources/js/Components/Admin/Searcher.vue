<template>
    <div class="search-for-goods">
        <form
            @submit.prevent="form.get(route(action_route))"
            enctype="multipart/form-data"
            role="search"
            id="admin-searcher"
        >
            <div class="form-floating mb-3 search-for-goods__field">
                <input
                    v-model="form.keyWord"
                    :class="form.keyWord ? 'active' : ''"
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
                    aria-label="Clear"
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
     * Components.
     */
    components: {
        useForm
    },

    /**
     * Props.
     */
    props: {
        request: {
            type: String,
            default: '',
        },
        action_route: {
            type: String,
            default: '',
        }
    },

    /**
     * Composition API.
     */
    setup(props) {
        const form = useForm({
            keyWord: props.request
        })

        return { form };
    },

    /**
     * Methods.
     */
    methods: {
        clearSearch() {
            this.form.keyWord = '';
            this.form.get(this.route(this.action_route));
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
