<template>
    <!-- Modal -->
    <div
        id="currentCurrencyModal"
        class="modal fade"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="currentCurrencyModalLabel"
        aria-hidden="true"
    >
        <form @submit.prevent="form.post(route('currentcurrency.store'))">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="currentCurrencyModalLabel"><strong>Add currency rate:</strong></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-border silver pad-15">
                            <div class="form-group mb-3">
                                <label for="currency">Currency</label>
                                <select
                                    v-model="form.currency"
                                    class="form-control"
                                    id="currency"
                                >
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rate" class="form-label">Rate to UAH</label>
                                <input
                                    v-model="form.rate"
                                    type="number"
                                    step="0.0001"
                                    min="0"
                                    class="form-control"
                                    id="rate"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input
                                    v-model="form.date"
                                    type="date"
                                    class="form-control"
                                    id="date"
                                >
                            </div>
                            <div class="form-check">
                                <label for="isActive" class="form-check-label">Active</label>
                                <input
                                    v-model="form.is_active"
                                    type="checkbox"
                                    class="form-check-input"
                                    id="isActive"
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
    name: 'CreateCurrentCurrencyModal',
    setup() {
        const form = useForm({
            currency: 'USD',
            rate: '',
            date: new Date().toISOString().substring(0, 10),
            is_active: true,
        });

        return { form };
    },
}
</script>
