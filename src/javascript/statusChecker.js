const statuss = document.querySelectorAll('#statuss');

document.addEventListener('DOMContentLoaded', ()=>{
   statuss.forEach(stat => {
     stat.innerHTML === 'Cancelled' ?
     (stat.style.backgroundColor = '#D9534F',
    stat.style.color = '#FBFBFB') 
    :
    stat.innerHTML === 'Pending' ?
     (stat.style.backgroundColor = '#F0AD4E',
    stat.style.color = '#FBFBFB') 
    :
     (stat.style.backgroundColor = '#5CB85C',
    stat.style.color = '#FBFBFB')
   })
})


   document.querySelector('#searchInput').addEventListener('input', (e)=>{
    const searchValue = e.target.value.toUpperCase();
    const transactionNumbers = document.querySelectorAll('.transactionNumbers');

    transactionNumbers.forEach(transactionNumber =>{
        transactionNumber.textContent.includes(searchValue) ?  transactionNumber.closest('tr').style.display = "" :  transactionNumber.closest('tr').style.display = "none"
    })
})





