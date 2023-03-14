<template>
    <!-- Modal -->
    <div class="modal fade" id="markModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="markModalLabel" aria-hidden="true">
        <form @submit.prevent="form.post(route('mark.store'))" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="markModalLabel"><strong>Add auto's model:</strong></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="custom-border silver pad-15">
                                <div class="mb-3">
                            <label for="picture" class="form-label">Picture</label>
                            <input
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
                                <option value="Renault" selected>Renault</option>
                                <option value="Smart">Smart</option>
                                <option value="Saab">Saab</option>
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

export default {
    /**
     * Name.
     */
    name: 'CreateMarkModal',

        /**
     * Components.
     */
     components: {
        useForm
    },

    /**
     * Composition API.
     */
     setup() {
        const form = useForm({
            name: '',
            picture: null,
        })

        return { form };
    },
}
</script>
