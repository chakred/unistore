<template>
    <div
        v-if="goods.data.length"
        class="row"
    >
        <div
            v-for="good in goods.data"
            class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 cat-block">
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
                        <h6>{{good.cost}} {{good.currency}}</h6>
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
                </div>
                <div class="card-footer buttons-area">
                    <button type="button" class="define-goods card-btn-cart card-btn"
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
                        <i class="fas fa-cart-plus"></i>
                    </button>
                    <button type="button" class="define-goods card-btn-buy card-btn"
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
}
</script>
