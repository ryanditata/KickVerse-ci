// public/assets/js/custom.js

/**
 * Fungsi untuk Keranjang Belanja
 */
function changeQty(id, delta) {
    const input = document.getElementById(id);
    const current = parseInt(input.value);
    if (!isNaN(current)) {
        const newValue = Math.max(current + delta, 1);
        input.value = newValue;
    }
}