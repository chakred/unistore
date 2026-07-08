<template>
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <p><span>Good's Categories</span></p>
                </div>
            </div>
        </div>
        <div
            v-for="category in categories"
            class="col-lg-4 col-md-6 mb-4"
        >
            <div class="card h-100 cat-block">
                <a :href="route('home.category', { category: category.slug })">
                    <div class="cat-block-media">
                        <img
                            v-if="category.img_path"
                            :src="`${imgStoragePath + category.img_path}`"
                        />
                        <img
                            v-else
                            src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                        />
                    </div>
                    <div class="cat-block-info">
                        <div class="card-footer">
                            <small class="text-muted">{{category.name}}</small>
                        </div>
                    </div>
                </a>
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
        categories: {
            type: Object,
            default: {},
        },
        model_id: {
            type: Number,
            default: null
        }
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
