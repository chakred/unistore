<template>
    <div>
        <div class="card">
            <div class="card-header">
                <span>Categories:</span>
            </div>
            <div class="card-body">
                <div
                    v-for="category in categories"
                    v-key="category.id"
                >
                    <a href="#">
                        <div>
                            <img
                                v-if="category.img_path"
                                :src="`${imgStoragePath + category.img_path}`"
                                width="50"
                            />
                            <img
                                v-else
                                src="http://dummyimage.com/50x50/ffffff/545454&text=No+image"
                                width="50"
                            />
                            <small class="text-muted">
                                {{ category.name }}
                            </small>
                        </div>
                    </a>
                    <hr>
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
    name: 'SidebarCategories',

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
     * Composition API
     */
    setup() {
        return {
            imgStoragePath,
        };
    },
}
</script>

