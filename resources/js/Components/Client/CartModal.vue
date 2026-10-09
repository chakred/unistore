<template>
    <teleport to="body">
        <div v-if="cartState.isOpen" class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $t('cart.title') }}</h5>
                        <button type="button" class="close" aria-label="Close" @click="closeCart">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="cartState.items.length" class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ $t('cart.image') }}</th>
                                        <th scope="col">{{ $t('cart.product') }}</th>
                                        <th scope="col">{{ $t('cart.price') }}</th>
                                        <th scope="col">{{ $t('cart.quantity') }}</th>
                                        <th scope="col">{{ $t('cart.total') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <CartItem
                                        v-for="item in cartState.items"
                                        :key="item.id"
                                        :item="item"
                                        @increase="increaseCartItem"
                                        @decrease="decreaseCartItem"
                                        @remove="removeCartItem"
                                    />
                                </tbody>
                            </table>
                        </div>
                        <p v-else class="text-center mb-0">{{ $t('cart.empty') }}</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <strong v-if="cartState.items.length">{{ $t('cart.grandTotal', { total: cartState.total }) }}</strong>
                        <span v-else></span>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary" @click="closeCart">{{ $t('cart.close') }}</button>
                            <Link
                                v-if="cartState.items.length"
                                :href="route('checkout')"
                                class="btn btn-dark"
                                @click="closeCart"
                            >
                                {{ $t('cart.checkout') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="cartState.isOpen" class="modal-backdrop fade show"></div>
    </teleport>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import CartItem from '@/Components/Client/CartItem.vue';
import {
    cartState,
    closeCart,
    increaseCartItem,
    decreaseCartItem,
    removeCartItem,
} from '@/Components/Stores/Cart';

export default {
    /**
     * Name.
     */
    name: 'CartModal',

    /**
     * Components.
     */
    components: {
        Link,
        CartItem,
    },

    /**
     * Composition API
     */
    setup() {
        return {
            cartState,
            closeCart,
            increaseCartItem,
            decreaseCartItem,
            removeCartItem,
        };
    },
}
</script>
