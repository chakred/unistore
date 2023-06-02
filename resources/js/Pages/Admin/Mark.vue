<template>
    <Head title="Mark" />
    <Nav 
        createButtonAction="#markModal"
    />
    <div class="container text-center mt-20">
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="mark in marks">
                        <th scope="row">{{ mark.id }}</th>
                        <td><img
                            :src="`/upload${mark.img_path}`"
                            width="100"
                        ></td>
                        <td>{{ mark.name }}</td>
                        <td>{{ mark.slug }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <CreateMarkModal />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateMarkModal from '@/Components/Admin/CreateMarkModal.vue';

export default {
    /**
     * Name.
     */
    name: 'Mark',

    /**
     * Components.
     */
    components: {
        Head,
        Nav,
        CreateMarkModal
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
