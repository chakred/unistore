export const imgStoragePath = 'storage/upload';
export const fillRange = function (start, end, float = false) {
    let values = [];
    while (start <= end) {

        if (float) {
            start = start + 0.1;
            values.push(start.toFixed(1));
        } else {
            values.push(start++);
        }
    }

    return values;
};
