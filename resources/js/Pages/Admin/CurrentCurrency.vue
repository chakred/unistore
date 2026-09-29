<template>
    <Head title="Current Currency" />
    <Nav
        createButtonAction="#currentCurrencyModal"
    />
    <div class="container text-center mt-20">
        <div class="row">
            <div class="col">
                <table
                    v-if="hasCurrentCurrencies"
                    class="table"
                >
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Date</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="currentCurrency in currentCurrencies"
                        :key="currentCurrency.id"
                    >
                        <th scope="row">{{ currentCurrency.id }}</th>
                        <td>{{ currentCurrency.currency }}</td>
                        <td>{{ currentCurrency.rate }}</td>
                        <td>{{ formatDate(currentCurrency.date) }}</td>
                        <td>
                            <i v-if="currentCurrency.is_active" class="fa-solid fa-check"></i>
                            <i v-else class="fa-solid fa-xmark"></i>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(currentCurrency)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#currentCurrencyModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                            <br>
                            <button
                                @click="deleteItem(currentCurrency)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDeleteCurrentCurrency"
                            >
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="col-12">No records. Pls create a first currency rate</div>
            </div>
        </div>
    </div>
    <CreateCurrentCurrencyModal />
    <UpdateCurrentCurrencyModal
        v-if="chosenCurrentCurrency"
        :currentCurrency="chosenCurrentCurrency"
    />
    <DeleteCurrentCurrencyModal
        v-if="chosenItemForDelete"
        :item="chosenItemForDelete"
    />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateCurrentCurrencyModal from '@/Components/Admin/CreateCurrentCurrencyModal.vue';
import UpdateCurrentCurrencyModal from '@/Components/Admin/UpdateCurrentCurrencyModal.vue';
import DeleteCurrentCurrencyModal from '@/Components/Admin/DeleteCurrentCurrencyModal.vue';
import { ref } from 'vue';

export default {
    name: 'CurrentCurrency',
    setup() {
        const chosenCurrentCurrency = ref(null);
        const chosenItemForDelete = ref(null);

        return {
            chosenCurrentCurrency,
            chosenItemForDelete,
        };
    },
    components: {
        Head,
        Nav,
        CreateCurrentCurrencyModal,
        UpdateCurrentCurrencyModal,
        DeleteCurrentCurrencyModal,
    },
    props: {
        currentCurrencies: {
            type: Array,
            default: () => [],
        }
    },
    computed: {
        hasCurrentCurrencies() {
            return this.currentCurrencies.length;
        }
    },
    methods: {
        chooseItem(currentCurrency) {
            this.chosenCurrentCurrency = currentCurrency;
        },
        deleteItem(currentCurrency) {
            this.chosenItemForDelete = currentCurrency;
        },
        formatDate(date) {
            return date ? date.substring(0, 10) : '';
        }
    }
}
</script>
