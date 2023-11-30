document.querySelector('#searchInput').addEventListener('input', (e)=>{
    const searchValue = e.target.value.toUpperCase();
    const transactionNumbers = document.querySelectorAll('#transactionNumbers');

    transactionNumbers.forEach(transactionNumber =>{
        transactionNumber.textContent.includes(searchValue) ?  transactionNumber.closest('tr').style.display = "" :  transactionNumber.closest('tr').style.display = "none"
    })
})