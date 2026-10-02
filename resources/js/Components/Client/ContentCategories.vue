<template>
    <section class="category-section">
        <div class="category-section__header">
            <h2 class="category-section__title">{{ $t('home.categoriesTitle') }}</h2>
        </div>
        <div class="tile-grid">
            <ImageTile
                v-for="category in categories"
                :key="category.id"
                :href="route('home.category', { category: category.slug })"
                :img-src="category.img_path ? (imgStoragePath + category.img_path) : ''"
                :title="category.name"
                :subtitle="goodsCountLabel(category)"
                :icon="category.icon || defaultCategoryIcon"
            />
        </div>
    </section>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';
import { defaultCategoryIcon } from '@/Mixins/Category/CategoryIcons';
import ImageTile from '@/Components/Client/ImageTile.vue';

export default {
    /**
     * Name.
     */
    name: 'ContentCategories',

    /**
     * Components.
     */
    components: {
        ImageTile,
    },

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
            defaultCategoryIcon,
        };
    },

    /**
     * Methods.
     */
    methods: {
        goodsCountLabel(category) {
            if (category.goods_count === undefined || category.goods_count === null) {
                return '';
            }

            return this.$t('home.goodsCount', { count: category.goods_count }, category.goods_count);
        },
    },
}
</script>

<style scoped>
.category-section {
    margin-bottom: 1.5rem;
}

.category-section__header {
    margin-bottom: 1rem;
}

.category-section__title {
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 0;
}

.tile-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

@media (min-width: 576px) {
    .tile-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 992px) {
    .tile-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}
</style>
