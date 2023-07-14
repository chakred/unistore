<template>
    <!-- Modal -->
    <div
        id="modelModalUpdate"
        class="modal fade"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="modelModalUpdateLabel"
        aria-hidden="true"
    >
        <form
            @submit.prevent="form.post(route('model.store'))"
            enctype="multipart/form-data"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modelModalUpdateLabel">
                            <strong>Update auto's model: {{ model.name }}</strong>
                        </h1>
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
                                    <input
                                        v-model="form.model"
                                        type="text"
                                        class="form-control"
                                        id="model"
                                        aria-describedby="model"
                                    >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="startIssue">Start issue</label>
                                    <select
                                        v-model="form.year_start"
                                        class="form-control"
                                        id="startIssue"
                                    >
                                        <option
                                            v-for="year in years"
                                            :key="year"
                                        >{{ year }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="endIssue">End issue</label>
                                    <select
                                        v-model="form.year_end"
                                        class="form-control"
                                        id="endIssue"
                                    >
                                        <option
                                            v-for="year in years"
                                            :key="year"
                                        >{{ year }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engine">Engine value</label>
                                    <select
                                        v-model="form.engine"
                                        class="form-control"
                                        id="engine"
                                    >
                                        <option
                                            v-for="engine in engines"
                                            :key="engine"
                                        >{{ engine }}</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="engine_type">Engine type</label>
                                    <select
                                        v-model="form.engine_type"
                                        class="form-control"
                                        id="engine_type"
                                    >
                                    <Option :options="engineTypes" />
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="transmission">Transmission</label>
                                    <select
                                        v-model="form.transmission"
                                        class="form-control"
                                        id="transmission"
                                    >
                                    <Option :options="transmissions" />
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="transmission_type" class="form-label">Transmission type</label>
                                    <input
                                        v-model="form.transmission_type"
                                        type="text"
                                        class="form-control"
                                        id="transmission_type"
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
import { transmissions, engineTypes } from '@/Mixins/Model';
import Option from '@/Components/Fields/Option.vue'


export default {
    /**
     * Name.
     */
    name: 'UpdateModelModal',

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
        marks: {
            type: Object,
            required: true
        },
        model: {
            type: Object,
            required: true
        }
    },

    /**
     * Composition API.
     */
    setup(props) {

        const marks = props.marks;

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
        const engines = fillRange(0.9, 5.0, true);
        const form = useForm({
            _method: 'put',
            mark: '',
            model: '',
            picture: null,
            engine: '',
            engine_type: '',
            year_start: '',
            year_end: '',
            transmission: '',
            transmission_type: '',
        });

        return {
            form,
            marks,
            years,
            engines,
            engineTypes,
            transmissions,
        };
    },
}
</script>
