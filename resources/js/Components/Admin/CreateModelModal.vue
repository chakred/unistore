<template>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form @submit.prevent="" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><strong>Add auto's model:</strong></h1>
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
                                    <label for="mark">Auto's mark</label>
                                    <select
                                        v-model="form.name"
                                        class="form-control"
                                        id="mark"
                                    >
                                        <option value="Renault" selected>Renault</option>
                                        <option value="Smart">Smart</option>
                                        <option value="Saab">Saab</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="form-control"
                                        id="model"
                                        aria-describedby="model"
                                    >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="startIssue">Start issue</label>
                                    <select
                                        v-model="form.startYear"
                                        class="form-control"
                                        id="startIssue"
                                    >
                                        <option v-for="year in years">{{ year }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="endIssue">End issue</label>
                                    <select
                                        v-model="form.endYear"
                                        class="form-control"
                                        id="endIssue"
                                    >
                                        <option v-for="year in years">{{ year }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engineValue">Engine value</label>
                                    <select
                                        v-model="form.engineValue"
                                        class="form-control"
                                        id="engineValue"
                                    >
                                        <option v-for="engineValue in engineValues">{{ engineValue }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engineType">Engine type</label>
                                    <select
                                        v-model="form.engineType"
                                        class="form-control"
                                        id="engineType"
                                    >
                                        <option v-for="engineType in engineTypes">{{ engineType }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="transmission">Transmission</label>
                                    <select
                                        v-model="form.transmission"
                                        class="form-control"
                                        id="transmission"
                                    >
                                        <option v-for="transmission in transmissions">{{ transmission }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="transmissionType" class="form-label">Transmission type</label>
                                    <input
                                        v-model="form.transmissionType"
                                        type="text"
                                        class="form-control"
                                        id="transmissionType"
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
    /**
     * Name.
     */
    name: 'CreateModelModal',

    /**
     * Composition API.
     */
    setup() {
        /**
         * Build an array of ranges
         * @param start
         * @param end
         * @param float
         * @returns {*[]}
         */
        function fillRange(start, end, float = false) {
            let values = [];
            while (start <= end) {

                if (float) {
                    start = start + 0.1;
                    values.push(start.toFixed(1));
                } else {
                    values.push(start++);
                }
            }

            return values;
        }

        const years = fillRange(1990, new Date().getFullYear());
        const engineValues = fillRange(0.9, 5.0, true);
        const engineTypes = [
            'Fuel',
            'Petrol',
            'Hybrid',
            'Gas',
        ];
        const transmissions = [
          'Mechanic',
          'Automatic',
          'Robot',
        ];
        const form = useForm({
            name: '',
            picture: null,
            engineValue: '',
            startYear: '',
            endYear: '',
            engineType: '',
            transmission: '',
            transmissionType: '',
        });

        return {
            form,
            years,
            engineValues,
            engineTypes,
            transmissions,
        };
    },
}
</script>
