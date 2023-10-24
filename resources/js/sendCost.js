const shippingOptions = document.getElementsByName('shipping_option');
const cartTotal = document.getElementById('cartTotal');


for (let i = 0; i < shippingOptions.length; i++) {
  shippingOptions[i].addEventListener('change', function() {
    const shippingCost = parseFloat(this.value);
    const cartTotalPrice = parseFloat(document.getElementById('orderTotal').value);

    const newTotalPrice = cartTotalPrice + shippingCost;
    cartTotal.textContent = newTotalPrice;
  });
}