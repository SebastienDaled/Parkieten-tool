const cartItemForm = document.querySelectorAll('.cartItem');

// op submit moet de form toegevoegd worden aan de sesionstorage
// cartItemForm.forEach((item) => {
//   item.addEventListener('submit', (e) => {
//     e.preventDefault();
    
//     const formData = new FormData(cartItemForm);
//     const data = Object.fromEntries(formData);
    
//     let cart = JSON.parse(sessionStorage.getItem('cart'));
    
//     if (cart === null) {
//       cart = [];
//     }
    
//     cart.push(data);
    
//     sessionStorage.setItem('cart', JSON.stringify(cart));
    
//     // console.log(data);
//     // consol
  
//   });
// });

cartItemForm.forEach((item) => {
  console.log(item.dataset.id);
  const idForm = document.querySelector(`#cartItem${item.dataset.id}`);

  idForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const formData = new FormData(idForm);
    const data = Object.fromEntries(formData);
    
    let cart = JSON.parse(sessionStorage.getItem('cart'));
    
    if (cart === null) {
      cart = [];
    }
    
    cart.push(data);
    
    sessionStorage.setItem('cart', JSON.stringify(cart));
    
    // console.log(data);
    // consol
  
  });
});

const cartCount = document.querySelector('#cartCount');

if (sessionStorage.getItem('cart') !== null) {
  const cart = JSON.parse(sessionStorage.getItem('cart'));
  cartCount.innerHTML = cart.length;
}
