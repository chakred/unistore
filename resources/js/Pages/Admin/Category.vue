<template>
    <Head title="Model" />
    <Nav 
        createButtonAction="#categoryModal"
    />
    <div class="container text-center mt-10">
        <div class="row">
            <div class="col-12">
                <table class="table">
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
                            :src="/upload/+ category.img_path"
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
     * Methods
     */
    methods: {
        parentCategory(category) {
            return category.parent_id ? category.name : '-';
        }
    },

    /**
     * Props.
     */
    props: {
        categories: {
            type: Object,
            default: {},
        }
    }
}
</script>
