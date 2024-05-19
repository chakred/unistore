<template>
    <!-- Modal -->
    <div
        id="markModalUpdate"
        class="modal fade create-modal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="markModalUpdateLabel"
        aria-hidden="true"
    >
        <form
            @submit.prevent="form.post(route('mark.update', mark.id))"
            enctype="multipart/form-data"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="markModalUpdateLabel">
                            <strong>Update auto's model: {{ mark.name }}</strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-border silver pad-15 img-preview">
                            <div class="mb-3 create-modal__img-block">
                                <img
                                    v-if="imgUrl"
                                    :src="imgUrl"
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
                                <label for="yearAuto">Auto's mark</label>
                                <select
                                    v-model="form.name"
                                    class="form-control"
                                    id="yearAuto"
                                >
                                    <option
                                        v-for="mark in marksList"
                                        :key="mark"
                                        :value="mark"
                                        :selected="form.name == mark ? 'selected' : ''"
                                    >
                                        {{ mark }}
                                    </option>
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
import { marksList } from '@/Mixins/Mark'
import ImagePreviewMixin from '@/Mixins/General/ImagePreviewMixin';
import { imgStoragePath } from '@/Mixins/General';

export default {
    /**
     * Name.
     */
    name: 'UpdateMarkModal',

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

    computed: {
        imgUrl() {
            return this.mark.img_path ? this.imgStoragePath + this.mark.img_path : this.imagePreviewURL;
        }
    },

    /**
     * Props.
     */
    props: {
        mark: {
            type: Object
        },
        title: {
            type: String,
            default: 'Smart',
        }
    },

    /**
     * Composition API.
     */
    setup(props) {
        // const mark = props.mark;
        const form = useForm({
            _method: 'put',
            picture: null,
            name: ''
        })

        return {
            form,
            marksList,
            imgStoragePath,
        };
    },

    /**
     * Watchers.
     */
    watch: {
        'mark'(newValue) {
            this.form.name = newValue.name;
        }
    }
}
</script>
