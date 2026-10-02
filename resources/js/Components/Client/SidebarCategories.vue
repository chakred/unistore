<template>
    <div class="card sidebar-categories">
        <div class="card-header">
            <span>{{ $t('sidebar.categories.title') }}</span>
        </div>
        <div class="list-group list-group-flush">
            <a
                v-for="category in categories"
                :key="category.id"
                :href="route('home.category', { category: category.slug })"
                class="list-group-item list-group-item-action sidebar-categories__item"
            >
                <i
                    class="sidebar-categories__icon"
                    :class="category.icon || defaultCategoryIcon"
                ></i>
                <span class="sidebar-categories__name">{{ category.name }}</span>
                <span
                    v-if="category.goods_count !== undefined && category.goods_count !== null"
                    class="sidebar-categories__count"
                >{{ category.goods_count }}</span>
            </a>
        </div>
    </div>
</template>

<script>
import { defaultCategoryIcon } from '@/Mixins/Category/CategoryIcons';

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
     * Composition API.
     */
    setup() {
        return {
            defaultCategoryIcon,
        };
    },
}
</script>

<style scoped>
.sidebar-categories__item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    color: #212529;
    text-decoration: none;
    transition: background-color .15s ease;
}

.sidebar-categories__item:hover {
    background-color: #f8f9fa;
    color: #212529;
}

.sidebar-categories__icon {
    width: 1.35rem;
    text-align: center;
    color: #6c757d;
    flex-shrink: 0;
}

.sidebar-categories__name {
    font-size: .9rem;
    flex-grow: 1;
}

.sidebar-categories__count {
    background-color: #e9ecef;
    color: #495057;
    font-weight: 600;
    font-size: .75rem;
    line-height: 1;
    padding: .35em .55em;
    border-radius: 10rem;
    min-width: 1.75rem;
    text-align: center;
}
</style>
