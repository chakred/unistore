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
                        <th scope="col">Mark</th>
                        <th scope="col">Model</th>
                        <th scope="col">Year</th>
                        <th scope="col">Engine</th>
                        <th scope="col">Engine's type</th>
                        <th scope="col">Transition</th>
                        <th scope="col">Transition's type</th>
                        <th scope="col">Slug</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="model in models">
                        <th scope="row">{{ model.id }}</th>
                        <td><img
                            :src="/upload/+ model.img_path"
                            width="100"
                        ></td>
                        <td>{{ model.name }}</td>
                        <td>{{ model.name }}</td>
                        <td>{{ model.year_start }} - {{ model.year_end }}</td>
                        <td>{{ model.engine }}</td>
                        <td>{{ model.engine_type }}</td>
                        <td>{{ model.transmission }}</td>
                        <td>{{ model.transmission_type }}</td>
                        <td>{{ model.slug }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create</button>
            </div>
        </div>
    </div>
    <CreateModelModal />
</template>

<script>
import { Head, useForm } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateModelModal from '@/Components/Admin/CreateModelModal.vue';

export default {
    /**
     * Name.
     */
    name: 'Model',

    /**
     * Components.
     */
    components: {
        CreateModelModal,
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
