<template>
    <div class="row">
        <div  class="col-lg-2 col-md-2 mb-2">
            <div>
                Sorting:
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dropdown">
                <form
                    @change.prevent="form.get(route('home.search'))"
                    enctype="multipart/form-data"
                    role="sorting"
                >
                    <select
                        v-model="form.sortBy"
                        class="form-select"
                        aria-label="Default select example"
                    >
                        <option selected>Popular</option>
                        <option
                            :value="1"
                        >
                            From low price
                        </option>
                        <option
                            :value="2"
                        >
                            From high price
                        </option>
                        <option
                            :value="3"
                        >
                            Popular
                        </option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import { useForm, useRemember } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'Sorting',

    /**
     * Components.
     */
    components: {
        useForm,
        useRemember
    },

    /**
     * Composition API.
     */
    setup() {
        const form = useForm({
            keyWord: '',
            sortBy: ''
        })

        return { form };
    },
}
</script>
