<template>
    <Head title="Model" />
    <Nav
        createButtonAction="#goodModal"
    />
    <div class="container text-center mt-10">
        <div class="row">
            <div class="col-12">
                <table
                    v-if="hasGoods"
                    class="table"
                >
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID inner</th>
                        <th scope="col">Good</th>
                        <th scope="col">Description</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Country</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Category</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="good in goods">
                        <th scope="row">{{ good.id }}</th>
                        <td><img
                            :src="`${imgStoragePath + good.img_path}`"
                            width="100"
                        ></td>
                        <td>{{ good.name }}</td>
                        <td>{{ good.desc }}</td>
                        <td>{{ good.slug }}</td>
                        <td>
                            <i v-if="good.active" class="fa-solid fa-check"></i>
                            <i v-else class="fa-solid fa-xmark"></i>
                        </td>
                        <td>
                            <button
                                @click="chooseItem(good)"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#goodModalUpdate"
                            >
                                <i class="fa-solid fa-gear fa-xl"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-else class="col-12">No records. Pls create a first good</div>
            </div>
        </div>
    </div>
    <CreateGoodModal
        :moleds="models"
    />
    <UpdateGoodModal
        :good="chosenGood"
    />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';
import CreateGoodModal from '@/Components/Admin/CreateGoodModal.vue';
import UpdateGoodModal from '@/Components/Admin/UpdateGoodModal.vue';
import { imgStoragePath } from '@/Mixins/General';
import { ref } from 'vue';

export default {
    /**
     * Name.
     */
    name: 'Good',

    /**
     * Components.
     */
    components: {
        CreateGoodModal,
        UpdateGoodModal,
        Head,
        Nav
    },

    /**
     * Composition API
     */
    setup() {
        const chosenGood = ref(Object);
        return {
            imgStoragePath,
            chosenGood
        };
    },

    /**
     * Props.
     */
    props: {
        goods: {
            type: Object,
            default: {},
        },
        models: {
            type: Object,
            default: {},
        }
    },

    /**
     * Computed hook
     */
    computed: {
        /**
         * Check if categories exist
         */
        hasGoods() {
            return this.goods.length;
        }
    },

    /**
     * Methods
     */
     methods: {
        /**
         * Choose good
         * @param good
         */
        chooseItem(good) {
            this.chosenGood = good;
        }
    },

}
</script>
