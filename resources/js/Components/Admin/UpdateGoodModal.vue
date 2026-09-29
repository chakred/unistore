<template>
    <!-- Modal -->
    <div
        class="modal modal-xl fade"
        id="goodModalUpdate"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="goodModalUpdateLabel"
        aria-hidden="true"
    >
        <form @submit.prevent="form.post(route('good.update'))" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="goodModalUpdateLabel">
                            <strong>Update the good: {{ good.name }}</strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="custom-border silver pad-15">
                                <div class="mb-3 create-modal__img-block">
                                    <img
                                        v-if="imgUrl"
                                        :src="imgUrl"
                                        alt="preview"
                                        class="create-modal__img-preview"
                                    />
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="picture" class="form-label">Picture</label>
                                        <input
                                            @change="onFileChange"
                                            @input="form.picture = $event.target.files[0]"
                                            type="file"
                                            class="form-control"
                                            id="picture"
                                            aria-describedby="picture"
                                        >
                                    </div>
                                    <div class="col-md-6 mb-3 d-flex align-items-end">
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
                                </div>
                                <div class="row">
                                    <div
                                        v-if="onlyMarks"
                                        class="col-md-6 mb-3"
                                    >
                                        <label for="mark">Auto's mark</label>
                                        <select
                                            v-model="form.mark_id"
                                            class="form-control"
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
                                    </div>
                                    <div
                                        v-if="!onlyMarks"
                                        class="col-md-6 mb-3"
                                    >
                                        <label for="model" class="form-label">Model</label>
                                        <select
                                            v-model="form.model_id"
                                            type="text"
                                            class="form-control"
                                            id="model"
                                            aria-describedby="model"
                                        >
                                            <option
                                                v-for="model in models"
                                                :key="model.id"
                                                :value="model.id"
                                                selected
                                            >
                                                {{ model.name }} ({{ model.mark.name }})
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name">Name</label>
                                        <input
                                            v-model="form.name"
                                            class="form-control"
                                            id="name"
                                            type="text"
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="desc">Description</label>
                                        <textarea
                                            v-model="form.desc"
                                            class="form-control"
                                            id="desc"
                                        >
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="brand">Brand</label>
                                        <input
                                            v-model="form.brand"
                                            class="form-control"
                                            id="brand"
                                            type="text"
                                        >
                                    </div>
                                    <div class="col-md-4 mb-3">
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
                                    <div class="col-md-4 mb-3">
                                        <label for="quantity">Quantity(pcs.)</label>
                                        <input
                                            v-model="form.quantity"
                                            class="form-control"
                                            id="quantity"
                                            type="text"
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="cost">Cost</label>
                                        <input
                                            v-model="form.cost"
                                            class="form-control"
                                            id="cost"
                                            type="text"
                                        >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="currency">Currency</label>
                                        <select
                                            v-model="form.currency"
                                            class="form-control"
                                            id="currency"
                                        >
                                            <option
                                                v-for="currency in currencies"
                                                :key="currency"
                                            >{{ currency }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="category_id">Category</label>
                                        <select
                                            v-model="form.category_id"
                                            class="form-control"
                                            id="category_id"
                                        >
                                            <option
                                                v-for="(category, id) in categories"
                                                :key="category"
                                                :value="id"
                                            >{{ category }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="profit">Profit%</label>
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
                                    <div class="col-md-4 mb-3">
                                        <label for="discount">Discount%</label>
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
                                    <div class="col-md-4 mb-3">
                                        <label for="is_original">Original/Analog</label>
                                        <select
                                            v-model="form.is_original"
                                            class="form-control"
                                            id="is_original"
                                        >
                                            <option :value="null">Unknown</option>
                                            <option :value="true">Original</option>
                                            <option :value="false">Analog</option>
                                        </select>
                                    </div>
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
import { fillRange, imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';

export default {
    /**
     * Name.
     */
    name: 'UpdateGoodModal',

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
        good: {
            type: Object,
            default: {},
        },
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
        const profits = fillRange(1,100);
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
            country: '',
            transmission: '',
            transmission_type: '',
            category_id: null,
            cost: '',
            profit: '',
            discount: 0,
            is_original: null,
            currency: '',
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
            onlyMarks,
            imgStoragePath,
        };
    },

    /**
     * Computed.
     */
    computed: {
        imgUrl() {
            return this.good.img_path ? this.imgStoragePath + this.good.img_path : this.imagePreviewURL;
        }
    },

    /**
     * Watchers.
     */
    watch: {
        'good'(newValue) {
            this.imagePreviewURL = null;
            this.form.picture = null;
            this.form.name = newValue.name;
            this.form.desc = newValue.desc;
            this.form.active = newValue.active ? true : false;
            this.form.brand = newValue.brand;
            this.form.category_id = newValue.category_id;
            this.form.cost = newValue.cost;
            this.form.country = newValue.country;
            this.form.currency = newValue.currency;
            this.form.discount = newValue.discount;
            this.form.is_original = newValue.is_original;
            this.form.id_inner =  newValue.id_inner;
            this.form.item = newValue.item;
            this.form.mark = newValue.mark?.name;
            this.form.mark_id = newValue.mark?.id;
            this.form.model = newValue.model?.name;
            this.form.model_id = newValue.model?.id;
            this.form.profit = newValue.profit;
            this.form.quantity = newValue.quantity;
        }
    }
}
</script>
