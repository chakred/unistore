<template>
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <div>
                        <img src="#">
                    </div>
                    <p><span>Good's categories for {{ model.name }}</span></p>
                </div>
            </div>
        </div>
        <div
            v-for="category in model.categories"
            class="col-lg-4 col-md-6 mb-4"
        >
            <div class="card h-100 cat-block">
                <a href="#">
                    <img
                        v-if="category.img_path"
                        :src="`${imgStoragePath + category.img_path}`"
                    />
                    <img
                        v-else
                        src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                    />
                </a>
                <div class="card-footer">
                    <small class="text-muted"><a href="#">{{category.name}}</a></small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';

export default {
    /**
     * Name.
     */
    name: 'ContentCategories',

    /**
     * Props.
     */
    props: {
        model: {
            type: Object,
            default: {},
        },
    },

    /**
     * Composition API
     */
    setup() {
        return {
            imgStoragePath,
        };
    },
}
</script>
