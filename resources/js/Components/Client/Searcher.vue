<template>
    <div class="search-for-goods">
        <form
            @submit.prevent="form.get(route('home.search'))"
            enctype="multipart/form-data"
            role="search"
        >
            <div class="form-floating mb-3">
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
     * Composition API.
     */
    setup() {
        const form = useForm({
            keyWord: ''
        })

        return { form };
    },
}
</script>
