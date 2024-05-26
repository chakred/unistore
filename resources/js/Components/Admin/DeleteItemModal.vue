<template>
    <!-- Modal -->
    <div
        id="modalDelete"
        class="modal fade"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="modalDeleteLabel"
        aria-hidden="true"
    >
        <form
            @submit.prevent="form.post(route(routeActionName, item.id))"
            enctype="multipart/form-data"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDeleteLabel">
                            <strong>Are you sure want to delete? </strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="custom-border silver pad-15">
                                <div class="row">
                                    <div class="col">
                                        <table
                                            class="table table-borderless"
                                        >
                                            <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Name</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">{{ item.id }}</th>
                                                <td>
                                                    <img
                                                        v-if="item.img_path"
                                                        :src="imgUrl"
                                                        width="50"
                                                    >
                                                    <img
                                                        v-else
                                                        src="http://dummyimage.com/100x100/ffffff/545454&text=No+image"
                                                        width="50"
                                                    />
                                                </td>
                                                <td>{{ item.name }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
import { transmissions, engineTypes } from '@/Mixins/Model';
import Option from '@/Components/Fields/Option.vue';
import { imgStoragePath } from '@/Mixins/General';


export default {
    /**
     * Name.
     */
    name: 'DeleteItemModal',

    /**
     * Components.
     */
    components: {
        Option,
    },

    computed: {
        imgUrl() {
            return this.item.img_path ? this.imgStoragePath + this.item.img_path : this.imagePreviewURL;
        },

        routeActionName() {
            return this.routeName+'.delete';
        }
    },

    /**
     * Props
     */
    props: {
        item: {
            type: Object,
            required: true
        },
        routeName: {
            type: String,
            required: true
        }
    },

    /**
     * Composition API.
     */
    setup(props) {
        const form = useForm({
            _method: 'delete',
            id: '',
        });

        return {
            form,
            imgStoragePath
        };
    },

    /**
     * Watchers.
     */
    watch: {
        'item'(newValue) {
            this.form.id = newValue.id;
        }
    }
}
</script>
