<template>
    <Head title="Mark" />
    <Nav
        createButtonAction="#markModal"
    />
    <div class="container text-center mt-20">
        <div class="row">
            <div class="col">
                <table
                    v-if="hasMarks"
                    class="table"
                >
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
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
                        <td>
                            <i v-if="mark.active" class="fa-solid fa-check"></i>
                            <i v-else class="fa-solid fa-xmark"></i>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(mark)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#markModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="col-12">No records. Pls create a first Mark</div>
            </div>
        </div>
    </div>
    <CreateMarkModal />
    <UpdateMarkModal
        v-if="chosenMark"
        :mark="chosenMark"
    />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateMarkModal from '@/Components/Admin/CreateMarkModal.vue';
import UpdateMarkModal from '@/Components/Admin/UpdateMarkModal.vue';
import { imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';

export default {
    /**
     * Name.
     */
    name: 'Mark',

    /**
     * Composition API
     */
    setup() {
        const chosenMark = ref(Object);
        return { imgStoragePath, chosenMark };
    },

    /**
     * Components.
     */
    components: {
        Head,
        Nav,
        CreateMarkModal,
        UpdateMarkModal
    },

    /**
     * Computed prop
     */
    computed: {
        /**
         * Check if models exist
         */
        hasMarks() {
            return this.marks.length;
        }
    },

    /**
     * Props.
     */
    props: {
        marks: {
            type: Object,
            default: {},
        }
    },

    /**
     * Methods.
     */
    methods: {
        chooseItem(mark) {
            this.chosenMark = mark;
        }
    }
}
</script>
