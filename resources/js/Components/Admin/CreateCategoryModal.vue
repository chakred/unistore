<template>
    <!-- Modal -->
    <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <form @submit.prevent="form.post(route('category.store'))" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="categoryModalLabel"><strong>Add category:</strong></h1>
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
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category name</label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="form-control"
                                        id="categoryName"
                                        aria-describedby="categoryName"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDesc" class="form-label">Category desc.</label>
                                    <input
                                        v-model="form.desc"
                                        type="text"
                                        class="form-control"
                                        id="categoryDesc"
                                        aria-describedby="categoryDesc"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="categoryIcon" class="form-label">Icon</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <i
                                            class="category-icon-preview"
                                            :class="form.icon || defaultCategoryIcon"
                                        ></i>
                                        <select
                                            v-model="form.icon"
                                            class="form-control"
                                            id="categoryIcon"
                                        >
                                            <option value="">Без иконки</option>
                                            <option
                                                v-for="icon in categoryIcons"
                                                :key="icon.value"
                                                :value="icon.value"
                                            >
                                                {{ icon.label }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <label for="subCategoryMake" class="form-label">Make sub-category</label>
                                    <input
                                        v-model="subCatEnable"
                                        type="checkbox"
                                        class="form-check-input"
                                        id="subCategoryMake"
                                        aria-describedby="subCategoryMake"
                                    >
                                </div>
                                <div
                                    v-if="subCatEnable"
                                    class="form-group mb-3"
                                >
                                    <label for="parentCategory">Parent category</label>
                                    <select
                                        v-model="form.parent_id"
                                        class="form-control"
                                        id="parentCategory"
                                    >
                                        <option
                                            v-for="category in categories"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
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
import { categoryIcons, defaultCategoryIcon } from '@/Mixins/Category/CategoryIcons';

export default {
    /**
     * Name.
     */
    name: 'CreateCategoryModal',

    /**
     * Props.
     */
    props: {
        categories: {
            type: Object,
            default: {},
        }
    },

    /**
     * Data.
     */
    data() {
        return {
            subCatEnable: false,
        };
    },

    /**
     * Composition API.
     */
    setup() {
        const form = useForm({
            name: '',
            picture: null,
            desc: '',
            icon: '',
            parent_id: '',
        });

        return {
            form,
            categoryIcons,
            defaultCategoryIcon,
        };
    },
}
</script>

<style scoped>
.category-icon-preview {
    font-size: 1.5rem;
    width: 2rem;
    text-align: center;
    flex-shrink: 0;
}
</style>
