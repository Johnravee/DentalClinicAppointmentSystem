document.querySelector('#searchInput').addEventListener('input', (e)=>{
    const transactionNumbers = document.querySelectorAll('#transactionNumber');
    const searchValue = e.target.value.toUpperCase();
    transactionNumbers.forEach(transactionNumber =>{
        transactionNumber.textContent.includes(searchValue) ?  transactionNumber.closest('form').style.display = "" :  transactionNumber.closest('form').style.display = "none"
    })
})