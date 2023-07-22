<template>
    <!-- Modal -->
    <div class="modal fade" id="goodModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="goodModalLabel" aria-hidden="true">
        <form @submit.prevent="form.post(route('model.store'))" enctype="multipart/form-data">
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
                                <div class="mb-3">
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
                                <div class="form-group mb-3">
                                    <label for="mark">Auto's mark</label>
                                    <select
                                        v-model="form.mark"
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
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <select
                                        v-model="form.model"
                                        type="text"
                                        class="form-control"
                                        id="model"
                                        aria-describedby="model"
                                    >
                                        <option
                                            v-for="(model, id) in models"
                                            :key="model"
                                            :value="id"
                                            selected
                                        >
                                            {{ model.name }} ({{ model.mark.name }})
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="desc">Description</label>
                                    <textarea
                                        v-model="form.desc"
                                        class="form-control"
                                        id="desc"
                                    >
                                    </textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Brand</label>
                                    <input
                                        v-model="form.brand"
                                        class="form-control"
                                        id="brand"
                                        type="text"
                                    >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country">Country</label>
                                    <select
                                        v-model="form.engine"
                                        class="form-control"
                                        id="country"
                                    >
                                        <option
                                            v-for="engine in engines"
                                            :key="engine"
                                        >{{ engine }}</option>
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

export default {
    /**
     * Name.
     */
    name: 'CreateGoodModal',

    /**
     * Mixins.
     */
    mixins: [ImagePreviewMixin],

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
        goods: {
            type: Object,
            required: true
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
    },

    /**
     * Composition API.
     */
    setup(props) {

        const marks = props.marks;
        const models = props.models;
        const countries = props.countries;


        const form = useForm({
            mark: '',
            model: '',
            picture: null,
            engine: '',
            engine_type: '',
            desc: '',
            brand: '',
            country: '',
            transmission: '',
            transmission_type: '',
        });

        return {
            form,
            marks,
            models,
            countries,
            engineTypes,
            transmissions,
        };
    },
}
</script>
