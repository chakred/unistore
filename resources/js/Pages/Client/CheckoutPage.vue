<template>
    <Nav />
    <div class="container">
        <div class="row" style="margin-top: 100px">
            <div class="col-12">
                <Breadcrumbs :items="breadcrumbItems" />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div
                    v-if="successMessage"
                    class="alert alert-success"
                >
                    {{ successMessage }}
                </div>
                <div class="card checkout-page mb-4">
                    <div class="card-body">
                        <h1 class="checkout-page__title">{{ $t('checkout.title') }}</h1>

                        <div v-if="cartState.items.length" class="table-responsive mb-4">
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
                            <strong>{{ $t('cart.grandTotal', { total: cartState.total }) }}</strong>
                        </div>
                        <p v-else class="text-muted">{{ $t('cart.empty') }}</p>
                        <div v-if="form.errors.cart" class="text-danger small mb-3">{{ form.errors.cart }}</div>

                        <form @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="buyer_name" class="form-label">{{ $t('checkout.name') }}</label>
                                <input
                                    v-model="form.buyer_name"
                                    type="text"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.buyer_name }"
                                    id="buyer_name"
                                >
                                <div v-if="form.errors.buyer_name" class="text-danger small mt-1">{{ form.errors.buyer_name }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="buyer_phone" class="form-label">{{ $t('checkout.phone') }}</label>
                                <input
                                    v-model="form.buyer_phone"
                                    type="text"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.buyer_phone }"
                                    id="buyer_phone"
                                >
                                <div v-if="form.errors.buyer_phone" class="text-danger small mt-1">{{ form.errors.buyer_phone }}</div>
                            </div>
                            <button
                                type="submit"
                                class="btn btn-dark"
                                :disabled="!cartState.items.length || form.processing"
                            >
                                {{ $t('checkout.submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer :viewNumbers="viewNumbers" />
</template>

<script>
import { useForm, usePage } from '@inertiajs/vue3';
import Nav from '@/Components/Client/Nav.vue';
import Breadcrumbs from '@/Components/Client/Breadcrumbs.vue';
import Footer from '@/Layouts/Client/Footer.vue';
import CartItem from '@/Components/Client/CartItem.vue';
import {
    cartState,
    increaseCartItem,
    decreaseCartItem,
    removeCartItem,
} from '@/Components/Stores/Cart';

export default {
    /**
     * Name.
     */
    name: 'CheckoutPage',

    /**
     * Components.
     */
    components: {
        Nav,
        Breadcrumbs,
        Footer,
        CartItem,
    },

    /**
     * Props.
     */
    props: {
        viewNumbers: {
            type: Number,
            default: 0,
        },
    },

    /**
     * Composition API.
     */
    setup() {
        const form = useForm({
            buyer_name: '',
            buyer_phone: '',
        });

        const page = usePage();

        return {
            cartState,
            increaseCartItem,
            decreaseCartItem,
            removeCartItem,
            form,
            page,
        };
    },

    /**
     * Computed.
     */
    computed: {
        breadcrumbItems() {
            return [
                { label: this.$t('common.home'), href: '/' },
                { label: this.$t('checkout.title') },
            ];
        },

        successMessage() {
            return this.page.props.flash?.success;
        },
    },

    /**
     * Methods.
     */
    methods: {
        submit() {
            this.form.post(this.route('checkout.store'), {
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },
}
</script>

<style scoped>
.checkout-page__title {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1.25rem;
}
</style>
