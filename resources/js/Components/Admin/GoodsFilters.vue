<template>
    <div class="row g-2 mb-3 goods-filters-bar">
        <div class="col-md-3">
            <select v-model="categoryId" class="form-select" @change="apply">
                <option value="">All categories</option>
                <option
                    v-for="(name, id) in categories"
                    :key="id"
                    :value="String(id)"
                >
                    {{ name }}
                </option>
            </select>
        </div>
        <div class="col-md-3">
            <select v-model="modelId" class="form-select" @change="apply">
                <option value="">All models</option>
                <option
                    v-for="model in models"
                    :key="model.id"
                    :value="String(model.id)"
                >
                    {{ model.name }} ({{ model.mark.name }})
                </option>
            </select>
        </div>
        <div class="col-md-3">
            <select v-model="brand" class="form-select" @change="apply">
                <option value="">All brands</option>
                <option
                    v-for="item in brands"
                    :key="item"
                    :value="item"
                >
                    {{ item }}
                </option>
            </select>
        </div>
        <div class="col-md-3">
            <select v-model="country" class="form-select" @change="apply">
                <option value="">All countries</option>
                <option
                    v-for="item in countries"
                    :key="item"
                    :value="item"
                >
                    {{ item }}
                </option>
            </select>
        </div>
        <div class="col-md-3">
            <select v-model="active" class="form-select" @change="apply">
                <option value="">All (active &amp; inactive)</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div v-if="hasActiveFilters" class="col-12">
            <button
                type="button"
                class="btn btn-sm btn-outline-secondary"
                @click="reset"
            >
                <i class="fa-solid fa-rotate-left"></i> Reset filters
            </button>
        </div>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'GoodsFilters',

    /**
     * Props.
     */
    props: {
        categories: {
            type: Object,
            default: () => ({}),
        },
        models: {
            type: Array,
            default: () => [],
        },
        brands: {
            type: Array,
            default: () => [],
        },
        countries: {
            type: Array,
            default: () => [],
        },
        query: {
            type: Object,
            default: () => ({}),
        },
    },

    /**
     * Composition API.
     */
    data() {
        return {
            categoryId: this.query.category_id ?? '',
            modelId: this.query.model_id ?? '',
            brand: this.query.brand ?? '',
            country: this.query.country ?? '',
            active: this.query.active ?? '',
        };
    },

    /**
     * Computed.
     */
    computed: {
        hasActiveFilters() {
            return Boolean(this.categoryId || this.modelId || this.brand || this.country || this.active !== '');
        },
    },

    /**
     * Methods.
     */
    methods: {
        apply() {
            router.get(window.location.pathname, {
                ...this.query,
                category_id: this.categoryId,
                model_id: this.modelId,
                brand: this.brand,
                country: this.country,
                active: this.active,
            }, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },

        reset() {
            this.categoryId = '';
            this.modelId = '';
            this.brand = '';
            this.country = '';
            this.active = '';

            const {
                category_id, model_id, brand, country, active, ...rest
            } = this.query;

            router.get(window.location.pathname, rest, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },
    },
}
</script>

<style scoped>
.goods-filters-bar {
    text-align: left;
}
</style>
