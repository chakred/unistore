<template>
    <Nav />
    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 100px">
            <div class="col-12">
                <Searcher />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Breadcrumbs :items="breadcrumbItems" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <SidebarCategories
                    :categories="categories"
                />
                <br/>
                <SidebarContacts />
                <br/>
                <SidebarWorkHours />
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                <div class="card good-page mb-4">
                    <div class="row g-0">
                        <div class="col-md-5 good-page__media">
                            <img
                                v-if="good.img_path"
                                :src="`${imgStoragePath + good.img_path}`"
                                class="good-page__img"
                            />
                            <img
                                v-else
                                src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                                class="good-page__img"
                            />
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h1 class="good-page__title">{{ good.name }}</h1>
                                <p v-if="good.brand" class="text-muted mb-1">{{ $t('common.tm', { brand: good.brand }) }}</p>
                                <p v-if="good.country" class="text-muted mb-1">{{ $t('goodPage.country', { country: good.country }) }}</p>
                                <p v-if="good.is_original !== null" class="mb-2">
                                    <span
                                        class="badge"
                                        :class="good.is_original ? 'bg-success' : 'bg-secondary'"
                                    >{{ good.is_original ? $t('goodPage.original') : $t('goodPage.analog') }}</span>
                                </p>
                                <h3 class="good-page__price">{{ good.price_uah }} {{ $t('common.currency') }}</h3>
                                <p
                                    v-if="outOfStock"
                                    class="stock-status stock-status--out"
                                >
                                    {{ $t('stock.out') }}
                                </p>
                                <p
                                    v-else-if="lowStock"
                                    class="stock-status stock-status--low"
                                >
                                    {{ $t('stock.lowFull') }}
                                </p>
                                <p class="good-page__desc">{{ good.desc }}</p>
                                <button
                                    type="button"
                                    class="btn btn-outline-dark"
                                    :disabled="outOfStock"
                                    @click="addToCart(good.id)"
                                >
                                    <i class="fas fa-cart-plus"></i> {{ $t('goodCard.addToCart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">{{ $t('goodPage.carFitmentTitle') }}</div>
                    <div class="card-body">
                        <p v-if="good.model" class="mb-0">
                            {{ good.model.mark?.name }} {{ good.model.name }}
                            <span v-if="good.model.year_start">
                                ({{ good.model.year_start }}&ndash;{{ good.model.year_end || $t('home.yearsUntilNow') }})
                            </span>
                        </p>
                        <p v-else-if="good.mark" class="mb-0">
                            {{ $t('goodPage.fitsAllModelsOf', { mark: good.mark.name }) }}
                        </p>
                        <p v-else class="mb-0">
                            {{ $t('goodPage.universal') }}
                        </p>
                    </div>
                </div>

                <div v-if="similarGoods.data.length" class="card">
                    <div class="card-header">{{ $t('goodPage.similarGoods') }}</div>
                    <div class="card-body">
                        <ContentGoods :goods="similarGoods" />
                    </div>
                </div>
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <Footer :viewNumbers="viewNumbers" />
</template>

<script>
import Nav from '@/Components/Client/Nav.vue';
import Searcher from '@/Components/Client/Searcher.vue';
import Breadcrumbs from '@/Components/Client/Breadcrumbs.vue';
import Footer from '@/Layouts/Client/Footer.vue';
import SidebarContacts from '@/Components/Client/SidebarContacts.vue';
import SidebarWorkHours from '@/Components/Client/SidebarWorkHours.vue';
import SidebarCategories from '@/Components/Client/SidebarCategories.vue';
import ContentGoods from '@/Components/Client/ContentGoods.vue';
import { imgStoragePath } from '@/Mixins/General';
import { isOutOfStock, isLowStock } from '@/Mixins/General/StockStatus';
import { addToCart, openCart } from '@/Components/Stores/Cart';

export default {
    /**
     * Name.
     */
    name: 'GoodPage',

    /**
     * Components.
     */
    components: {
        SidebarWorkHours,
        SidebarContacts,
        Footer,
        Nav,
        Searcher,
        Breadcrumbs,
        SidebarCategories,
        ContentGoods,
    },

    /**
     * Props.
     */
    props: {
        good: {
            type: Object,
            required: true,
        },
        categories: {
            type: Object,
            default: () => ({}),
        },
        similarGoods: {
            type: Object,
            default: () => ({ data: [] }),
        },
        viewNumbers: {
            type: Number,
            default: 0,
        },
    },

    /**
     * Composition API.
     */
    setup() {
        return {
            imgStoragePath,
        };
    },

    /**
     * Computed.
     */
    computed: {
        breadcrumbItems() {
            const items = [{ label: this.$t('common.home'), href: '/' }];

            if (this.good.category) {
                items.push({
                    label: this.good.category.name,
                    href: this.route('home.category', this.good.category.slug),
                });
            }

            items.push({ label: this.good.name });

            return items;
        },

        outOfStock() {
            return isOutOfStock(this.good);
        },

        lowStock() {
            return isLowStock(this.good);
        },
    },

    /**
     * Methods.
     */
    methods: {
        addToCart(goodId) {
            addToCart(goodId).then(openCart);
        },
    },
}
</script>

<style scoped>
.good-page__media {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.good-page__img {
    max-width: 100%;
    max-height: 320px;
    object-fit: contain;
}

.good-page__title {
    font-size: 1.5rem;
}

.good-page__price {
    font-weight: 700;
}

.good-page__desc {
    white-space: pre-line;
}

.stock-status {
    font-weight: 600;
}

.stock-status--out {
    color: #6c757d;
}

.stock-status--low {
    color: #dc3545;
}
</style>
