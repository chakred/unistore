import { reactive } from 'vue';

export const cartState = reactive({
    items: [],
    total: 0,
    count: 0,
    loading: false,
    isOpen: false,
});

function applyPayload(payload) {
    cartState.items = payload.items;
    cartState.total = payload.total;
    cartState.count = payload.count;
}

export function openCart() {
    cartState.isOpen = true;
}

export function closeCart() {
    cartState.isOpen = false;
}

export async function fetchCart() {
    cartState.loading = true;

    try {
        const { data } = await window.axios.get('/cart');
        applyPayload(data);
    } finally {
        cartState.loading = false;
    }
}

export async function addToCart(goodId, quantity = 1) {
    cartState.loading = true;

    try {
        const { data } = await window.axios.post('/cart', { good_id: goodId, quantity });
        applyPayload(data);
    } finally {
        cartState.loading = false;
    }
}

export async function increaseCartItem(goodId) {
    cartState.loading = true;

    try {
        const { data } = await window.axios.patch(`/cart/${goodId}/increase`);
        applyPayload(data);
    } finally {
        cartState.loading = false;
    }
}

export async function decreaseCartItem(goodId) {
    cartState.loading = true;

    try {
        const { data } = await window.axios.patch(`/cart/${goodId}/decrease`);
        applyPayload(data);
    } finally {
        cartState.loading = false;
    }
}

export async function removeCartItem(goodId) {
    cartState.loading = true;

    try {
        const { data } = await window.axios.delete(`/cart/${goodId}`);
        applyPayload(data);
    } finally {
        cartState.loading = false;
    }
}
