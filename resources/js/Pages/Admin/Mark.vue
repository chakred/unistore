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
                        <th scope="col">Active</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr 
                        v-for="mark in marks"
                        :key="mark"
                    >
                        <th scope="row">{{ mark.id }}</th>
                        <td><img
                            :src="`${imgStoragePath + mark.img_path}`"
                            width="100"
                        ></td>
                        <td>{{ mark.name }}</td>
                        <td>{{ mark.slug }}</td>
                        <td>{{ mark.active }}</td>
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
import { imgStoragePath } from '@/Mixins/General';

export default {
    /**
     * Name.
     */
    name: 'Mark',

    /**
     * Composition API
     */
    setup() {
        return { imgStoragePath };
    },

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
