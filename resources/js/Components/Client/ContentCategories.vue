<template>
    <section class="category-section">
        <div class="category-section__header">
            <h2 class="category-section__title">Категории товаров</h2>
        </div>
        <div class="category-grid">
            <a
                v-for="category in categories"
                :key="category.id"
                :href="route('home.category', { category: category.slug })"
                class="category-tile"
            >
                <div class="category-tile__media">
                    <img
                        v-if="category.img_path"
                        :src="`${imgStoragePath + category.img_path}`"
                        :alt="category.name"
                    />
                    <img
                        v-else
                        src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                        :alt="category.name"
                    />
                    <div class="category-tile__icon">
                        <i :class="category.icon || defaultCategoryIcon"></i>
                    </div>
                    <div class="category-tile__overlay">
                        <span class="category-tile__name">{{ category.name }}</span>
                        <span
                            v-if="category.goods_count !== undefined && category.goods_count !== null"
                            class="category-tile__count"
                        >
                            {{ category.goods_count }} {{ pluralizeRu(category.goods_count, ['товар', 'товара', 'товаров']) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </section>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';
import { pluralizeRu } from '@/Mixins/General/Pluralize';
import { defaultCategoryIcon } from '@/Mixins/Category/CategoryIcons';

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
            pluralizeRu,
            defaultCategoryIcon,
        };
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

.category-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

@media (min-width: 576px) {
    .category-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 992px) {
    .category-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.category-tile {
    display: block;
    border-radius: .75rem;
    overflow: hidden;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
    transition: transform .2s ease, box-shadow .2s ease;
}

.category-tile:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, .15);
}

.category-tile__media {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: #f1f1f1;
}

.category-tile__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
}

.category-tile:hover .category-tile__media img {
    transform: scale(1.06);
}

.category-tile__icon {
    position: absolute;
    top: .6rem;
    left: .6rem;
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 50%;
    background: rgba(255, 255, 255, .92);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
    font-size: 1.05rem;
    color: #212529;
}

.category-tile__overlay {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: .75rem .9rem;
    display: flex;
    flex-direction: column;
    gap: .15rem;
    background: linear-gradient(to top, rgba(0, 0, 0, .75) 0%, rgba(0, 0, 0, 0) 100%);
    color: #fff;
}

.category-tile__name {
    font-weight: 700;
    font-size: .95rem;
    text-transform: uppercase;
    line-height: 1.2;
}

.category-tile__count {
    font-size: .78rem;
    opacity: .85;
}
</style>
