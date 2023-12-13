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
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories">
                        <th scope="row">{{ category.id }}</th>
                        <td>
                            <img
                                v-if="category.img_path"
                                :src="`${imgStoragePath + category.img_path}`"
                                width="100"
                        >
                            <img
                                v-else
                                src="http://dummyimage.com/100x100/ffffff/545454&text=No+image"
                                width="100"
                            />
                        </td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.desc }}</td>
                        <td>{{ category.slug }}</td>
                        <td>{{ parentCategory(category) }}</td>
                        <td>{{ childCategory(category) }}</td>
                        <td>
                            <i v-if="category.active" class="fa-solid fa-check"></i>
                            <i v-else class="fa-solid fa-xmark"></i>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(category)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#categoryModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                        </td>
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
    <UpdateCategoryModal
        :categories="categories"
        :category="chosenCategory"
    />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateCategoryModal from '@/Components/Admin/CreateCategoryModal.vue';
import UpdateCategoryModal from '@/Components/Admin/UpdateCategoryModal.vue';
import { imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';

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
        UpdateCategoryModal,
        Head,
        Nav
    },

    /**
     * Composition API
     */
    setup() {
        const chosenCategory = ref(Object);
        return {
            imgStoragePath,
            chosenCategory
        };
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
         * Get parent category name
         * @param {*} category
         */
        parentCategory(category) {
            return category.parent ? `${category.parent.name} (ID:${category.parent.id})` : '-';
        },

        /**
         * Get child category
         * @param category
         * @returns {string|*}
         */
        childCategory(category) {
            return category.parent_id ?? '-';
        },

        /**
         * Choose category
         * @param category
         */
        chooseItem(category) {
            this.chosenCategory = category;
        }
    },

}
</script>
