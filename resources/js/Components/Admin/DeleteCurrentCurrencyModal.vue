<template>
    <!-- Modal -->
    <div
        id="modalDeleteCurrentCurrency"
        class="modal fade"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="modalDeleteCurrentCurrencyLabel"
        aria-hidden="true"
    >
        <form @submit.prevent="form.post(route('currentcurrency.delete', item.id))">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDeleteCurrentCurrencyLabel">
                            <strong>Are you sure want to delete?</strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-border silver pad-15">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">{{ item.id }}</th>
                                    <td>{{ item.currency }}</td>
                                    <td>{{ item.rate }}</td>
                                    <td>{{ item.date ? item.date.substring(0, 10) : '' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Delete</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    name: 'DeleteCurrentCurrencyModal',
    props: {
        item: {
            type: Object,
            required: true,
        }
    },
    setup() {
        const form = useForm({
            _method: 'delete',
        });

        return { form };
    },
}
</script>
