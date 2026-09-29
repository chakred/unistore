<template>
    <div
        v-if="goods.data.length"
        class="row"
    >
        <div
            v-for="good in goods.data"
            class="col-lg-4 col-md-6 mb-4">
            <div
                class="card h-100 cat-block"
                :class="{ 'cat-block--out-of-stock': isOutOfStock(good) }"
            >
                <a href="#">
                    <img
                        v-if="good.img_path"
                        :src="`${imgStoragePath + good.img_path}`"
                    />
                    <img
                        v-else
                        src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                    />
                </a>
                <div class="card-body">
                    <div class="card-title">
                        <h4>
                            <a href="#">{{good.name}}</a>
                        </h4>
                        <h6>{{good.price_uah}} грн</h6>
                    </div>
                    <p class="card-text">
                        {{good.desc}}
                    </p>
                    <p
                        v-if="good.brand"
                        class="card-text trade-mark"
                    >
                        TM: {{good.brand}}
                    </p>
                    <p
                        v-if="isOutOfStock(good)"
                        class="card-text stock-status stock-status--out"
                    >
                        Нет в наличии
                    </p>
                    <p
                        v-else-if="isLowStock(good)"
                        class="card-text stock-status stock-status--low"
                    >
                        Товар заканчивается
                    </p>
                </div>
                <div class="card-footer buttons-area">
                    <button
                        type="button"
                        class="card-btn-cart card-btn"
                        :disabled="isOutOfStock(good)"
                        @click="addToCart(good.id)"
                    >
                        <i class="fas fa-cart-plus"></i>
                    </button>
                    <button type="button" class="define-goods card-btn-buy card-btn"
                            :disabled="isOutOfStock(good)"
                            data-goods-id="1"
                            data-goods-name="1"
                            data-goods-image="1"
                            data-goods-price="1"
                            data-goods-mark="1"
                            data-fixed-rate="1"
                            data-currency-name="1"
                            data-bought-price="1"
                            data-toggle="modal"
                            data-target="#buyProductModal">
                        Купить
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div
        v-else
        class="row justify-content-center"
    >
        <div class="d-flex justify-content-center">
            Nothing found!
        </div>
    </div>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';
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

        isOutOfStock(good) {
            return Number(good.quantity) <= 0;
        },

        isLowStock(good) {
            return Number(good.quantity) > 0 && Number(good.quantity) < 3;
        },
    },
}
</script>

<style scoped>
.cat-block--out-of-stock {
    filter: grayscale(1);
    opacity: .6;
}

.stock-status {
    font-weight: 600;
    margin-bottom: 0;
}

.stock-status--out {
    color: #6c757d;
}

.stock-status--low {
    color: #dc3545;
}
</style>
