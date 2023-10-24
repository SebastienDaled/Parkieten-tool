const amount = document.querySelectorAll('.amount');
const total = document.querySelectorAll('.totalPrice');

// amount.forEach((item) => {
//   item.addEventListener('change', (e) => {
//     console.log(e.target.value);
//     const value = e.target.value;
//   })
// })

for (let i = 0; i < amount.length; i++) {
  amount[i].addEventListener('change', (e) => {
    const value = e.target.value;
    
    let price = e.target.dataset.price;
    let totalPrice = value * price;
    
    // max 2 decimals
    totalPrice = totalPrice.toFixed(2);
    
    total[i].innerHTML = `€ ${totalPrice}`;
  }
  )
  
}
