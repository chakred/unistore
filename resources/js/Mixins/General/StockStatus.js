export function isOutOfStock(good) {
    return Number(good.quantity) <= 0;
}

export function isLowStock(good) {
    return Number(good.quantity) > 0 && Number(good.quantity) < 3;
}
