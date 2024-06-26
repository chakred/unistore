<template>
    <Head title="Model" />
    <Nav
        createButtonAction="#modelModal"
    />
    <div class="container text-center mt-20">
        <div class="row">
            <div class="col-12">
                <Searcher
                    :request="request.keyWord ?? ''"
                    action_route="model.index"
                />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table
                    v-if="hasModels"
                    class="table"
                >
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
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="model in models.data"
                        :key="model"
                    >
                        <th scope="row">{{ model.id }}</th>
                        <td><img
                            :src="`${imgStoragePath + model.img_path}`"
                            width="100"
                        ></td>
                        <td>{{ model.mark.name }}</td>
                        <td>{{ model.name }}</td>
                        <td>{{ model.year_start }} - {{ model.year_end }}</td>
                        <td>{{ model.engine }}</td>
                        <td>{{ model.engine_type }}</td>
                        <td>{{ model.transmission }}</td>
                        <td>{{ model.transmission_type }}</td>
                        <td><code>{{ model.slug }}</code></td>
                        <td>
                            <i v-if="model.active" class="fa-solid fa-check"></i>
                            <i v-else class="fa-solid fa-xmark"></i>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(model)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modelModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                            <br>
                            <button
                                @click="deleteItem(model)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDelete"
                            >
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="col-12">No records. Pls create a first Model</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Pagination :items="models"/>
            </div>
        </div>
    </div>
    <CreateModelModal
        :marks="marks"
    />
    <UpdateModelModal
        :marks="marks"
        :model="chosenModel"
    />
    <DeleteItemModal
        v-if="deleteItem"
        :item="chosenItemForDelete"
        :routeName="moduleName"
    />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateModelModal from '@/Components/Admin/CreateModelModal.vue';
import UpdateModelModal from '@/Components/Admin/UpdateModelModal.vue';
import DeleteItemModal from '@/Components/Admin/DeleteItemModal.vue';
import { imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';
import Searcher from '@/Components/Admin/Searcher.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    /**
     * Name.
     */
    name: 'Model',

    /**
     * Components.
     */
    components: {
        Pagination,
        Searcher,
        CreateModelModal,
        UpdateModelModal,
        DeleteItemModal,
        Head,
        Nav,
    },

    /**
     * Composition API.
     */
    setup() {
        const chosenModel = ref(Object);
        const chosenItemForDelete = ref(Object);
        const moduleName = 'model';

        return {
            imgStoragePath,
            chosenModel,
            chosenItemForDelete,
            moduleName
        };
    },

    /**
     * Computed prop
     */
    computed: {
        /**
         * Check if models exist
         */
        hasModels() {
            return this.models.data.length;
        }
    },

    /**
     * Props.
     */
    props: {
        models: {
            type: Object,
            default: {},
        },
        marks: {
            type: Object,
            default: {},
        },
        request: {
            type: Object,
            default: {},
        }
    },

    /**
     * Methods.
     */
    methods: {
        chooseItem(model) {
            this.chosenModel = model;
        },
        deleteItem(model) {
            this.chosenItemForDelete = model;
        }
    }
}
</script>
