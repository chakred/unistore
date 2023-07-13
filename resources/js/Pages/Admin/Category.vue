<template>
    <Head title="Model" />
    <Nav
        createButtonAction="#categoryModal"
    />
    <div class="container text-center mt-10">
        <div class="row">
            <div class="col-12">
                <table
                    v-if="hasCategories"
                    class="table"
                >
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Parent category</th>
                        <th scope="col">Child category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories">
                        <th scope="row">{{ category.id }}</th>
                        <td><img
                            :src="`${imgStoragePath + category.img_path}`"
                            width="100"
                        ></td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.desc }}</td>
                        <td>{{ category.slug }}</td>
                        <td>{{ parentCategory(category) }}</td>
                        <td>{{ category.parent_id }}</td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="col-12">No records. Pls create a first category</div>
            </div>
        </div>
    </div>
    <CreateCategoryModal
        :categories="categories"
    />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateCategoryModal from '@/Components/Admin/CreateCategoryModal.vue';
import { imgStoragePath } from '@/Mixins/General';

export default {
    /**
     * Name.
     */
    name: 'Category',

    /**
     * Components.
     */
    components: {
        CreateCategoryModal,
        Head,
        Nav
    },

    /**
     * Composition API
     */
    setup() {
        return { imgStoragePath };
    },

    /**
     * Props.
     */
    props: {
        categories: {
            type: Object,
            default: {},
        }
    },

    /**
     * Computed hook
     */
    computed: {
        /**
         * Check if categories exist
         */
        hasCategories() {
            return this.categories.length;
        }
    },

    /**
     * Methods
     */
     methods: {
        /**
         * Get category name
         * @param {*} category
         */
        parentCategory(category) {
            return category.parent_id ? category.name : '-';
        }
    },
}
</script>
