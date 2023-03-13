<template>
    <Head title="Model" />
    <Nav />
    <div class="container text-center mt-20">
        <div class="row">
            <div class="col-10">
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
                        <td>{{ category.description }}</td>
                        <td>{{ category.slug }}</td>
                        <td>{{ category.parent_id }}</td>
                        <td>{{ category.parent_id }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#categoryModal">Create</button>
            </div>
        </div>
    </div>
    <CreateCategoryModal />
</template>

<script>
import { Head, useForm } from '@inertiajs/vue3';
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
        Nav,
        useForm
    },

    /**
     * Composition API.
     */
    setup() {
        const form = useForm({
            name: '',
            picture: null,
        })

        return { form };
    },

    /**
     * Props.
     */
    props: {
        models: {
            type: Object,
            default: {},
        }
    }
}
</script>
