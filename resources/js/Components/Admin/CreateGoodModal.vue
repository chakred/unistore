<template>
    <!-- Modal -->
    <div class="modal modal-lg fade" id="goodModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="goodModalLabel" aria-hidden="true">
        <form @submit.prevent="form.post(route('good.store'))" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="goodModalLabel"><strong>Add a new good:</strong></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="custom-border silver pad-15">
                                <div class="mb-3 create-modal__img-block">
                                    <img
                                        v-if="imagePreviewURL"
                                        :src="imagePreviewURL"
                                        alt="preview"
                                        class="create-modal__img-preview"
                                    />
                                </div>
                                <div class="form-group row">
                                    <div class="mb-3">
                                        <label for="picture" class="form-label">Picture</label>
                                        <input
                                            @change="onFileChange"
                                            @input="form.picture = $event.target.files[0]"
                                            type="file"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.picture }"
                                            id="picture"
                                            aria-describedby="picture"
                                        >
                                        <div v-if="form.errors.picture" class="text-danger small mt-1">{{ form.errors.picture }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input
                                                v-model="onlyMarks"
                                                class="form-check-input"
                                                type="checkbox"
                                                id="flexSwitchCheckDefault"
                                            >
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Only Marks</label>
                                        </div>
                                    </div>
                                    <div
                                        v-if="onlyMarks"
                                        class="mb-3"
                                    >
                                        <label for="mark">Auto's mark</label>
                                        <select
                                            v-model="form.mark_id"
                                            class="form-control"
                                            :class="{ 'is-invalid': form.errors.mark_id }"
                                            id="mark"
                                        >
                                            <option
                                                v-for="(mark, id) in marks"
                                                :key="mark"
                                                :value="id"
                                                selected
                                            >
                                                {{ mark }}
                                            </option>

                                        </select>
                                        <div v-if="form.errors.mark_id" class="text-danger small mt-1">{{ form.errors.mark_id }}</div>
                                    </div>
                                </div>
                                <div
                                    v-if="!onlyMarks"
                                    class="mb-3"
                                >
                                    <label for="model" class="form-label">Model</label>
                                    <select
                                        v-model="form.model_id"
                                        type="text"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.model_id }"
                                        id="model"
                                        aria-describedby="model"
                                    >
                                        <option
                                            v-if="!models || !models.length"
                                            value=""
                                            disabled
                                            selected
                                        >
                                            no models created
                                        </option>
                                        <option
                                            v-for="model in models"
                                            :key="model.id"
                                            :value="model.id"
                                            selected
                                        >
                                            {{ model.name }} ({{ model.mark.name }})
                                        </option>
                                    </select>
                                    <div v-if="form.errors.model_id" class="text-danger small mt-1">{{ form.errors.model_id }}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="desc">Description</label>
                                    <textarea
                                        v-model="form.desc"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.desc }"
                                        id="desc"
                                    >
                                    </textarea>
                                    <div v-if="form.errors.desc" class="text-danger small mt-1">{{ form.errors.desc }}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Name</label>
                                    <input
                                        v-model="form.name"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.name }"
                                        id="name"
                                        type="text"
                                    >
                                    <div v-if="form.errors.name" class="text-danger small mt-1">{{ form.errors.name }}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Brand</label>
                                    <input
                                        v-model="form.brand"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.brand }"
                                        id="brand"
                                        type="text"
                                    >
                                    <div v-if="form.errors.brand" class="text-danger small mt-1">{{ form.errors.brand }}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Quantity(pcs.)</label>
                                    <input
                                        v-model="form.quantity"
                                        class="form-control"
                                        id="quantity"
                                        type="text"
                                    >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country">Country</label>
                                    <select
                                        v-model="form.country"
                                        class="form-control"
                                        id="country"
                                    >
                                        <option
                                            v-for="country in countries"
                                            :key="country"
                                        >{{ country }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Cost</label>
                                    <input
                                        v-model="form.cost"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.cost }"
                                        id="cost"
                                        type="text"
                                    >
                                    <div v-if="form.errors.cost" class="text-danger small mt-1">{{ form.errors.cost }}</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Currency</label>
                                    <select
                                        v-model="form.currency"
                                        class="form-control"
                                        id="profit"
                                    >
                                        <option
                                            v-for="currency in currencies"
                                            :key="currency"
                                        >{{ currency }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Category</label>
                                    <select
                                        v-model="form.category_id"
                                        class="form-control"
                                        id="profit"
                                    >
                                        <option
                                            v-for="(category, id) in categories"
                                            :key="category"
                                            :value="id"
                                        >{{ category }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country">Profit%</label>
                                    <select
                                        v-model="form.profit"
                                        class="form-control"
                                        id="profit"
                                    >
                                        <option
                                            v-for="profit in profits"
                                            :key="profit"
                                            :value="profit"
                                        >{{ profit }}%</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country">Discount%</label>
                                    <select
                                        v-model="form.discount"
                                        class="form-control"
                                        id="discount"
                                    >
                                        <option
                                            v-for="discount in discounts"
                                            :key="discount"
                                        >{{ discount }}%</option>
                                    </select>
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
import { transmissions, engineTypes } from '@/Mixins/Model';
import Option from '@/Components/Fields/Option.vue'
import ImagePreviewMixin from '@/Mixins/General/ImagePreviewMixin';
import { fillRange } from '@/Mixins/General';
import { ref } from 'vue';

export default {
    /**
     * Name.
     */
    name: 'CreateGoodModal',

    /**
     * Mixins.
     */
    mixins: [ImagePreviewMixin, fillRange],

    /**
     * Components.
     */
    components: {
        Option,
    },

    /**
     * Props
     */
    props: {
        models: {
            type: Object,
            required: true
        },
        marks: {
            type: Object,
            required: true
        },
        countries: {
            type: Object,
            required: true
        },
        categories: {
            type: Object,
            required: true
        },
    },

    /**
     * Composition API.
     */
    setup(props) {

        const marks = props.marks;
        const models = props.models;
        const countries = props.countries;
        const categories = props.categories;

        const onlyMarks = ref(false)

        const discounts = fillRange(0,100);
        const profits = fillRange(0,100);
        const currencies = [
            'EUR',
            'USD',
            'UAH'
        ];
        const form = useForm({
            mark_id: '',
            model_id: '',
            picture: null,
            engine: '',
            engine_type: '',
            desc: '',
            brand: '',
            country: Object.values(countries)[0] ?? '',
            transmission: '',
            transmission_type: '',
            category_id: null,
            cost: '',
            profit: 0,
            discount: 0,
            currency: currencies[0],
            quantity: '',
            name: '',
            only_marks: onlyMarks
        });

        return {
            form,
            marks,
            models,
            countries,
            engineTypes,
            transmissions,
            discounts,
            profits,
            currencies,
            categories,
            onlyMarks
        };
    },
}
</script>
