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
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="mark in marks">
                        <th scope="row">{{ mark.id }}</th>
                        <td><img
                            :src="/upload/+ mark.img_path"
                            width="100"
                        ></td>
                        <td>{{ mark.name }}</td>
                        <td>{{ mark.slug }}</td>
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
        marks: {
            type: Object,
            default: {},
        }
    }
}
</script>
