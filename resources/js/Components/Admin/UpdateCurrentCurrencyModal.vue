<template>
    <!-- Modal -->
    <div
        id="currentCurrencyModalUpdate"
        class="modal fade"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="currentCurrencyModalUpdateLabel"
        aria-hidden="true"
    >
        <form @submit.prevent="form.post(route('currentcurrency.update', currentCurrency.id))">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="currentCurrencyModalUpdateLabel">
                            <strong>Update currency rate: {{ currentCurrency.currency }}</strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-border silver pad-15">
                            <div class="form-group mb-3">
                                <label for="currencyUpdate">Currency</label>
                                <select
                                    v-model="form.currency"
                                    class="form-control"
                                    id="currencyUpdate"
                                >
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rateUpdate" class="form-label">Rate to UAH</label>
                                <input
                                    v-model="form.rate"
                                    type="number"
                                    step="0.0001"
                                    min="0"
                                    class="form-control"
                                    id="rateUpdate"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="dateUpdate" class="form-label">Date</label>
                                <input
                                    v-model="form.date"
                                    type="date"
                                    class="form-control"
                                    id="dateUpdate"
                                >
                            </div>
                            <div class="form-check">
                                <label for="isActiveUpdate" class="form-check-label">Active</label>
                                <input
                                    v-model="form.is_active"
                                    type="checkbox"
                                    class="form-check-input"
                                    id="isActiveUpdate"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    name: 'UpdateCurrentCurrencyModal',
    props: {
        currentCurrency: {
            type: Object,
            required: true,
        }
    },
    setup(props) {
        const form = useForm({
            _method: 'put',
            currency: props.currentCurrency.currency,
            rate: props.currentCurrency.rate,
            date: props.currentCurrency.date ? props.currentCurrency.date.substring(0, 10) : '',
            is_active: props.currentCurrency.is_active,
        });

        return { form };
    },
    watch: {
        currentCurrency(newValue) {
            this.form.currency = newValue.currency;
            this.form.rate = newValue.rate;
            this.form.date = newValue.date ? newValue.date.substring(0, 10) : '';
            this.form.is_active = newValue.is_active;
        }
    }
}
</script>
