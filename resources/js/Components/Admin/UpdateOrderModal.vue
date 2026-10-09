<template>
    <!-- Modal -->
    <div
        class="modal modal-lg fade"
        id="orderModalUpdate"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="orderModalUpdateLabel"
        aria-hidden="true"
    >
        <form @submit.prevent="submit">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="orderModalUpdateLabel">
                            <strong>Order #{{ order.id }} — {{ order.buyer_name }}</strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="order_status" class="form-label">Status</label>
                            <select
                                v-model="form.status"
                                class="form-select"
                                :class="{ 'is-invalid': form.errors.status }"
                                id="order_status"
                            >
                                <option
                                    v-for="status in statuses"
                                    :key="status"
                                    :value="status"
                                >
                                    {{ status }}
                                </option>
                            </select>
                            <div v-if="form.errors.status" class="text-danger small mt-1">{{ form.errors.status }}</div>
                        </div>

                        <h6>Items</h6>
                        <table class="table table-sm align-middle">
                            <thead>
                            <tr>
                                <th scope="col">Good</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in form.items" :key="item.good_id">
                                <td>{{ item.name }}</td>
                                <td>{{ item.price }}</td>
                                <td>
                                    <input
                                        v-model.number="item.quantity"
                                        type="number"
                                        min="1"
                                        class="form-control form-control-sm order-item-qty"
                                    >
                                </td>
                                <td>{{ (item.price * item.quantity).toFixed(2) }}</td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        @click="removeItem(index)"
                                    >
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="!form.items.length">
                                <td colspan="5" class="text-muted">No items. Add at least one good below.</td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="form.errors.items" class="text-danger small mb-2">{{ form.errors.items }}</div>
                        <div class="text-end fw-bold mb-3">Total: {{ orderTotal.toFixed(2) }}</div>

                        <div class="order-add-good">
                            <label for="order_good_search" class="form-label">Add a good</label>
                            <input
                                v-model="searchQuery"
                                type="text"
                                class="form-control"
                                id="order_good_search"
                                placeholder="Search goods by name..."
                                @input="onSearchInput"
                            >
                            <ul v-if="searchResults.length" class="list-group order-add-good__results">
                                <li
                                    v-for="good in searchResults"
                                    :key="good.id"
                                    class="list-group-item list-group-item-action"
                                    role="button"
                                    @click="addGood(good)"
                                >
                                    {{ good.name }}
                                    <span v-if="good.brand" class="text-muted"> ({{ good.brand }})</span>
                                    — {{ good.price }}, in stock: {{ good.quantity }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success" :disabled="form.processing">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'UpdateOrderModal',

    /**
     * Props.
     */
    props: {
        order: {
            type: Object,
            default: () => ({}),
        },
        statuses: {
            type: Array,
            default: () => [],
        },
    },

    /**
     * Composition API.
     */
    setup() {
        const form = useForm({
            status: '',
            items: [],
        });

        return { form };
    },

    /**
     * Data.
     */
    data() {
        return {
            searchQuery: '',
            searchResults: [],
            searchTimeout: null,
        };
    },

    /**
     * Computed.
     */
    computed: {
        orderTotal() {
            return this.form.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
        },
    },

    /**
     * Watchers.
     */
    watch: {
        order(newOrder) {
            this.form.status = newOrder.status ?? 'new';
            this.form.items = (newOrder.items ?? []).map((item) => ({
                good_id: item.good_id,
                name: item.good?.name ?? `Good #${item.good_id}`,
                price: item.bought_price,
                quantity: item.quantity,
            }));
            this.searchQuery = '';
            this.searchResults = [];
        },
    },

    /**
     * Methods.
     */
    methods: {
        onSearchInput() {
            clearTimeout(this.searchTimeout);

            if (!this.searchQuery.trim()) {
                this.searchResults = [];
                return;
            }

            this.searchTimeout = setTimeout(async () => {
                const { data } = await window.axios.get(this.route('order.goods.search'), {
                    params: { q: this.searchQuery },
                });
                this.searchResults = data;
            }, 300);
        },

        addGood(good) {
            const existing = this.form.items.find((item) => item.good_id === good.id);

            if (existing) {
                existing.quantity += 1;
            } else {
                this.form.items.push({
                    good_id: good.id,
                    name: good.name,
                    price: good.price,
                    quantity: 1,
                });
            }

            this.searchQuery = '';
            this.searchResults = [];
        },

        removeItem(index) {
            this.form.items.splice(index, 1);
        },

        submit() {
            this.form.put(this.route('order.update', this.order.id), {
                preserveScroll: true,
            });
        },
    },
}
</script>

<style scoped>
.order-item-qty {
    width: 5rem;
}

.order-add-good {
    position: relative;
}

.order-add-good__results {
    position: absolute;
    z-index: 10;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
}
</style>
