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
                    v-if="hasOrders"
                    class="table sortable-table"
                >
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">Bought price</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Buyer name</th>
                        <th scope="col">Buyer cell.</th>
                        <th scope="col">Status</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in orders.data">
                        <th scope="row">{{ order.id }}</th>
                        <th scope="row">{{ order.quantity }}</th>
                        <td>{{ order.bought_price }}</td>
                        <td>{{ order.currency }}</td>
                        <td>{{ order.buyer_name }}</td>
                        <td>{{ order.buyer_email || '-' }}</td>
                        <td>{{ order.buyer_phone }}</td>
                        <td>{{ order.status }}</td>
                        <td>{{ order.comments || '-' }}</td>
                        <td>
                            <button
                                @click="chooseItem(order)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#goodModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                            <br>
                            <button
                                @click="deleteItem(order)"
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
                <div v-else class="col-12">No records.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Pagination :items="orders"/>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import { imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';
import UpdateGoodModal from '@/Components/Admin/UpdateGoodModal.vue';
import DeleteItemModal from '@/Components/Admin/DeleteItemModal.vue';
import Searcher from '@/Components/Admin/Searcher.vue';
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
        UpdateGoodModal,
        DeleteItemModal,
        Head,
        Nav
    },

    /**
     * Composition API
     */
    setup() {
        const chosenOrder = ref(Object);
        const chosenItemForDelete = ref(Object);
        const moduleName = 'order';
        return {
            imgStoragePath,
            chosenOrder,
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
        orders: {
            type: Object,
            default: {},
        },
        request: {
            type: Object,
            default: {},
        }
    },

    /**
     * Computed hook
     */
    computed: {
        /**
         * Check if orders exist
         */
        hasOrders() {
            return this.orders.data.length;
        }
    },

    /**
     * Methods
     */
     methods: {
        /**
         * Choose item
         * @param order
         */
        chooseItem(order) {
            this.chosenOrder = order;
        },

        /**
         *
         * @param order
         */
        deleteItem(order) {
            this.chosenItemForDelete = order;
        }
    },

}
</script>
