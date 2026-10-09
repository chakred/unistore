<template>
    <Head title="Orders" />
    <Nav />
    <div class="container text-center mt-10">
        <div class="row">
            <div class="col-12">
                <div class="row g-2 mb-3 order-filters-bar">
                    <div class="col-md-3">
                        <select v-model="status" class="form-select" @change="applyFilter">
                            <option value="">All statuses</option>
                            <option
                                v-for="item in statuses"
                                :key="item"
                                :value="item"
                            >
                                {{ item }}
                            </option>
                        </select>
                    </div>
                    <div v-if="status" class="col-12">
                        <button
                            type="button"
                            class="btn btn-sm btn-outline-secondary"
                            @click="resetFilter"
                        >
                            <i class="fa-solid fa-rotate-left"></i> Reset filters
                        </button>
                    </div>
                </div>
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
                        <SortableTh label="ID" field="id" :current-sort="sort" :query="request" />
                        <SortableTh label="Date" field="created_at" :current-sort="sort" :query="request" />
                        <SortableTh label="Buyer" field="buyer_name" :current-sort="sort" :query="request" />
                        <th scope="col">Phone</th>
                        <th scope="col">Items</th>
                        <SortableTh label="Total" field="total" :current-sort="sort" :query="request" />
                        <SortableTh label="Status" field="status" :current-sort="sort" :query="request" />
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in orders.data" :key="order.id">
                        <th scope="row">{{ order.id }}</th>
                        <td>{{ formatDate(order.created_at) }}</td>
                        <td>{{ order.buyer_name }}</td>
                        <td>{{ order.buyer_phone }}</td>
                        <td class="text-start">
                            <div v-for="item in order.items" :key="item.id">
                                {{ item.good?.name || `Good #${item.good_id}` }} × {{ item.quantity }}
                            </div>
                        </td>
                        <td>{{ order.total }}</td>
                        <td>
                            <span
                                class="badge order-status-badge"
                                :class="`order-status-badge--${order.status}`"
                            >
                                {{ order.status }}
                            </span>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(order)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#orderModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="col-12">No orders yet.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Pagination :items="orders" />
            </div>
        </div>
    </div>
    <UpdateOrderModal
        :order="chosenOrder"
        :statuses="statuses"
    />
</template>

<script>
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Nav from '@/Components/Admin/Nav.vue';
import SortableTh from '@/Components/Admin/SortableTh.vue';
import Pagination from '@/Components/Pagination.vue';
import UpdateOrderModal from '@/Components/Admin/UpdateOrderModal.vue';

export default {
    /**
     * Name.
     */
    name: 'Order',

    /**
     * Components.
     */
    components: {
        Head,
        Nav,
        SortableTh,
        Pagination,
        UpdateOrderModal,
    },

    /**
     * Props.
     */
    props: {
        orders: {
            type: Object,
            default: () => ({}),
        },
        request: {
            type: Object,
            default: () => ({}),
        },
        sort: {
            type: Object,
            default: () => ({ by: 'created_at', dir: 'desc' }),
        },
        statuses: {
            type: Array,
            default: () => [],
        },
    },

    /**
     * Data.
     */
    data() {
        return {
            status: this.request.status ?? '',
            chosenOrder: {},
        };
    },

    /**
     * Computed.
     */
    computed: {
        hasOrders() {
            return this.orders.data?.length;
        },
    },

    /**
     * Methods.
     */
    methods: {
        formatDate(date) {
            return date ? date.replace('T', ' ').substring(0, 16) : '';
        },

        chooseItem(order) {
            this.chosenOrder = order;
        },

        applyFilter() {
            router.get(window.location.pathname, {
                ...this.request,
                status: this.status,
            }, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },

        resetFilter() {
            this.status = '';

            const { status, ...rest } = this.request;

            router.get(window.location.pathname, rest, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },
    },
}
</script>

<style scoped>
.order-filters-bar {
    text-align: left;
}

.order-status-badge {
    text-transform: capitalize;
    color: #fff;
    background: #6c757d;
}

.order-status-badge--new {
    background: #0d6efd;
}

.order-status-badge--handled {
    background: #198754;
}

.order-status-badge--canceled {
    background: #6c757d;
}

.order-status-badge--invalid {
    background: #dc3545;
}
</style>
