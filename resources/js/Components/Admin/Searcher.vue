<template>
    <div class="search-for-goods">
        <form
            @submit.prevent="form.get(route(action_route))"
            enctype="multipart/form-data"
            role="search"
            id="admin-searcher"
        >
            <div class="form-floating mb-3">
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
}
</script>
