<template>
    <Head title="Model" />
    <Nav
        createButtonAction="#goodModal"
    />
    <div class="container text-center mt-10">
        <div class="row">
            <div class="col-12">
                <Searcher
                    :request="request.keyWord ?? ''"
                    action_route="good.index"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table
                    v-if="hasGoods"
                    class="table sortable-table"
                >
                    <thead>
                    <tr>
                        <SortableTh label="ID" field="id" :current-sort="sort" :query="request" />
                        <SortableTh label="ID inner" field="id_inner" :current-sort="sort" :query="request" />
                        <th scope="col">Picture</th>
                        <SortableTh label="Good" field="name" :current-sort="sort" :query="request" />
                        <SortableTh label="Description" field="desc" :current-sort="sort" :query="request" />
                        <th scope="col">Model</th>
                        <SortableTh label="Brand" field="brand" :current-sort="sort" :query="request" />
                        <SortableTh label="Country" field="country" :current-sort="sort" :query="request" />
                        <SortableTh label="Cost" field="cost" :current-sort="sort" :query="request" />
                        <SortableTh label="Slug" field="slug" :current-sort="sort" :query="request" />
                        <th scope="col">Category</th>
                        <SortableTh label="Active" field="active" :current-sort="sort" :query="request" />
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="good in goods.data">
                        <th scope="row">{{ good.id }}</th>
                        <th scope="row">{{ good.id_inner ?? '-' }}</th>
                        <td><img
                            :src="`${imgStoragePath + good.img_path}`"
                            width="100"
                        ></td>
                        <td>{{ good.name }}</td>
                        <td>{{ good.desc }}</td>
                        <td>{{ good.model?.name || '-' }}</td>
                        <td>{{ good.brand }}</td>
                        <td>{{ good.country }}</td>
                        <td>{{ good.cost + good.currency }}</td>
                        <td>{{ good.slug }}</td>
                        <td>{{ good.category?.name || '-' }}</td>
                        <td>
                            <i v-if="good.active" class="fa-solid fa-check"></i>
                            <i v-else class="fa-solid fa-xmark"></i>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(good)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#goodModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                            <br>
                            <button
                                @click="deleteItem(good)"
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
                <div v-else class="col-12">No records. Pls create a first good</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Pagination :items="goods"/>
            </div>
        </div>
    </div>
    <CreateGoodModal
        :countries="countries"
        :marks="marks"
        :models="models"
        :categories="categories"
    />
    <UpdateGoodModal
        :countries="countries"
        :marks="marks"
        :models="models"
        :categories="categories"
        :good="chosenGood"
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
import { imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';
import CreateGoodModal from '@/Components/Admin/CreateGoodModal.vue';
import UpdateGoodModal from '@/Components/Admin/UpdateGoodModal.vue';
import DeleteItemModal from '@/Components/Admin/DeleteItemModal.vue';
import Searcher from '@/Components/Admin/Searcher.vue';
import SortableTh from '@/Components/Admin/SortableTh.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    /**
     * Name.
     */
    name: 'Good',

    /**
     * Components.
     */
    components: {
        Pagination,
        Searcher,
        SortableTh,
        CreateGoodModal,
        UpdateGoodModal,
        DeleteItemModal,
        Head,
        Nav
    },

    /**
     * Composition API
     */
    setup() {
        const chosenGood = ref(Object);
        const chosenItemForDelete = ref(Object);
        const moduleName = 'good';
        return {
            imgStoragePath,
            chosenGood,
            chosenItemForDelete,
            moduleName
        };
    },

    /**
     * Props.
     */
    props: {
        goods: {
            type: Object,
            default: {},
        },
        models: {
            type: Object,
            default: {},
        },
        marks: {
            type: Object,
            default: {},
        },
        countries: {
            type: Object,
            default: {},
        },
        categories: {
            type: Object,
            default: {},
        },
        request: {
            type: Object,
            default: {},
        },
        sort: {
            type: Object,
            default: () => ({ by: 'id', dir: 'asc' }),
        }
    },

    /**
     * Computed hook
     */
    computed: {
        /**
         * Check if categories exist
         */
        hasGoods() {
            return this.goods.data.length;
        }
    },

    /**
     * Methods
     */
     methods: {
        /**
         * Choose good
         * @param good
         */
        chooseItem(good) {
            this.chosenGood = good;
        },

        /**
         *
         * @param good
         */
        deleteItem(good) {
            this.chosenItemForDelete = good;
        }
    },

}
</script>
