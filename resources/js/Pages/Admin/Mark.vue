<template>
    <Head title="Mark" />
    <Nav />
    <div class="container text-center mt-20">
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="mark in marks">
                        <th scope="row">{{ mark.id }}</th>
                        <td><img
                            :src="/upload/+ mark.img_path"
                            width="100"
                        ></td>
                        <td>{{ mark.name }}</td>
                        <td>{{ mark.slug }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="custom-border silver pad-15">
                    <p><strong>Add auto's mark:</strong></p>
                    <form @submit.prevent="form.post(route('mark.store'))" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, useForm } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';

export default {
    /**
     * Name.
     */
    name: 'Mark',

    /**
     * Components.
     */
    components: {
        Head,
        Nav,
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

    /**
     * Props.
     */
    props: {
        marks: {
            type: Object,
            default: {},
        }
    }
}
</script>
