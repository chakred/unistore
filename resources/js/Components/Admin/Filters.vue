<template>
    <div class="mb-5">
        <form
            @submit.prevent="form.get(route(action_route))"
            enctype="multipart/form-data"
            role="filter"
            id="admin-filter"
        >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title fs-5" id="markModalLabel"><strong>Filters:</strong></h6>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="yearAuto">Auto's mark</label>
                            <select
                                v-model="form.mark"
                                class="form-control"
                                id="yearAuto"
                            >
                                <option
                                    v-for="mark in filter_inputs.marks"
                                    :key="mark"
                                    :value="mark"
                                >
                                    {{ mark }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="yearAuto">Auto's model</label>
                            <select
                                v-model="form.model"
                                class="form-control"
                                id="yearAuto"
                                :disabled="!form.mark"
                            >
                                <option
                                    v-for="model in filter_inputs.models"
                                    :key="model"
                                    :value="model"
                                >
                                    {{ model.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="minCostRange" class="form-label">Min Cost: {{form.min_cost}} UAH</label>
                            <input
                                v-model="form.min_cost"
                                type="range"
                                :min="filter_inputs.cost.min"
                                :max="filter_inputs.cost.max"
                                class="form-range"
                                id="minCostRange"
                            >
                        </div>
                        <div class="form-group mb-3">
                            <label for="maxCostRange" class="form-label">Max Cost: {{form.max_cost}} UAH</label>
                            <input
                                v-model="form.max_cost"
                                type="range"
                                :min="filter_inputs.cost.min"
                                :max="filter_inputs.cost.max"
                                class="form-range"
                                id="maxCostRange"
                            >
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn mx-1 btn-outline-dark" data-bs-dismiss="modal">Clear</button>
                        <br/>
                        <button type="submit" class="btn mx-1 btn-outline-success">Apply</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { marksList } from '@/Mixins/Mark'
import ImagePreviewMixin from '@/Mixins/General/ImagePreviewMixin';

export default {
    /**
     * Name.
     */
    name: 'Filters',

    /**
     * Mixins.
     */
    mixins: [ImagePreviewMixin],

    /**
     * Components.
     */
     components: {
        useForm
    },

    /**
     * Props.
     */
    props: {
        request: {
            type: String,
            default: '',
        },
        action_route: {
            type: String,
            default: '',
        },
        filter_inputs: {
            type: Object,
            default: {},
        },
    },

    /**
     * Composition API.
     */
     setup(props) {
        const form = useForm({
            mark: props.request?.filter?.mark ?? '',
            model: props.request?.filter?.model ?? '',
            min_cost: props.request?.filter?.cost ?? props.filter_inputs.cost.min,
            max_cost: props.request?.filter?.cost ?? props.filter_inputs.cost.max,
        })

        return { form, marksList };
    },
}
</script>
