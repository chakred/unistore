<template>
    <div
        v-if="goods.data.length"
        class="row"
    >
        <div
            v-for="good in goods.data"
            :key="good.id"
            class="col-lg-4 col-md-6 mb-4"
        >
            <div
                class="good-card"
                :class="{ 'good-card--out-of-stock': isOutOfStock(good) }"
            >
                <a
                    :href="route('home.good', good.slug)"
                    class="good-card__media"
                    :class="{ 'good-card__media--no-image': !good.img_path }"
                >
                    <img
                        v-if="good.img_path"
                        :src="`${imgStoragePath + good.img_path}`"
                    />
                    <img
                        v-else
                        class="good-card__media-placeholder"
                        src="../../../images/Client/mechanical_parts_gray_vector.svg"
                    />
                    <span
                        v-if="isOutOfStock(good)"
                        class="good-card__badge good-card__badge--out"
                    >
                        {{ $t('stock.out') }}
                    </span>
                    <span
                        v-else-if="isLowStock(good)"
                        class="good-card__badge good-card__badge--low"
                    >
                        {{ $t('stock.low') }}
                    </span>
                </a>
                <div class="good-card__body">
                    <a :href="route('home.good', good.slug)" class="good-card__name">
                        {{ good.name }}
                    </a>
                    <p
                        v-if="good.brand"
                        class="good-card__brand"
                    >
                        {{ $t('common.tm', { brand: good.brand }) }}
                    </p>
                    <p class="good-card__desc">
                        {{ good.desc }}
                    </p>
                </div>
                <div class="good-card__footer">
                    <div class="good-card__price">{{ good.price_uah }} {{ $t('common.currency') }}</div>
                    <div class="good-card__actions">
                        <button
                            type="button"
                            class="good-card__btn good-card__btn--cart"
                            :title="$t('goodCard.addToCart')"
                            :disabled="isOutOfStock(good)"
                            @click="addToCart(good.id)"
                        >
                            <i class="fas fa-cart-plus"></i>
                        </button>
                        <button
                            type="button"
                            class="good-card__btn good-card__btn--buy"
                            :disabled="isOutOfStock(good)"
                            @click="buyNow(good.id)"
                        >
                            {{ $t('goodCard.buy') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        v-else
        class="row justify-content-center"
    >
        <div class="d-flex justify-content-center">
            {{ $t('goodCard.nothingFound') }}
        </div>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import { imgStoragePath } from '@/Mixins/General';
import { isOutOfStock, isLowStock } from '@/Mixins/General/StockStatus';
import { addToCart, openCart } from '@/Components/Stores/Cart';

export default {
    /**
     * Name.
     */
    name: 'ContentGoods',

    /**
     * Props.
     */
    props: {
        goods: {
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

    /**
     * Methods.
     */
    methods: {
        addToCart(goodId) {
            addToCart(goodId).then(openCart);
        },

        buyNow(goodId) {
            addToCart(goodId).then(() => {
                router.visit(this.route('cart.index'));
            });
        },

        isOutOfStock,

        isLowStock,
    },
}
</script>

<style scoped>
.good-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
    transition: transform .2s ease, box-shadow .2s ease;
}

.good-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, .15);
}

.good-card--out-of-stock {
    filter: grayscale(1);
    opacity: .65;
}

.good-card__media {
    position: relative;
    display: block;
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: #f1f1f1;
}

.good-card__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
}

.good-card__media--no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
}

.good-card__media .good-card__media-placeholder {
    width: 160px;
    height: 160px;
    object-fit: contain;
}

.good-card:hover .good-card__media img {
    transform: scale(1.06);
}

.good-card__badge {
    position: absolute;
    top: .6rem;
    left: .6rem;
    padding: .25rem .55rem;
    border-radius: 10rem;
    font-size: .72rem;
    font-weight: 600;
    color: #fff;
}

.good-card__badge--out {
    background: #6c757d;
}

.good-card__badge--low {
    background: #dc3545;
}

.good-card__body {
    flex-grow: 1;
    padding: .85rem .9rem 0;
}

.good-card__name {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-weight: 700;
    font-size: .95rem;
    color: #212529;
    text-decoration: none;
    line-height: 1.3;
    margin-bottom: .3rem;
}

.good-card__brand {
    font-size: .78rem;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: .3rem;
}

.good-card__desc {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-size: .82rem;
    color: #6c757d;
    margin-bottom: 0;
}

.good-card__footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    padding: .75rem .9rem .9rem;
    margin-top: .75rem;
}

.good-card__price {
    font-weight: 700;
    font-size: 1.05rem;
    color: #212529;
    white-space: nowrap;
}

.good-card__actions {
    display: flex;
    align-items: center;
    gap: .4rem;
}

.good-card__btn {
    border: 1px solid #dee2e6;
    background: #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color .15s ease, border-color .15s ease;
}

.good-card__btn:disabled {
    cursor: not-allowed;
    opacity: .6;
}

.good-card__btn--cart {
    width: 2.2rem;
    height: 2.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #212529;
    flex-shrink: 0;
}

.good-card__btn--cart:hover:not(:disabled) {
    background: #f8f9fa;
    border-color: #adb5bd;
}

.good-card__btn--buy {
    padding: .4rem .9rem;
    font-size: .82rem;
    font-weight: 600;
    color: #fff;
    background: #212529;
    border-color: #212529;
    white-space: nowrap;
}

.good-card__btn--buy:hover:not(:disabled) {
    background: #000;
}
</style>
