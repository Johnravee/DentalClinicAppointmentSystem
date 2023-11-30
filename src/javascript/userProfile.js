const editBtn = document.querySelector('#editMode');
const inputs = document.querySelectorAll('.input');
const editModeIndicator = document.querySelector('#editModeIndicator');
console.log(editBtn);
console.log(editModeIndicator);


editBtn.addEventListener('click', ()=>{
    editModeIndicator.classList.toggle("displayEditMode");
    inputs.forEach(input =>{
        input.toggleAttribute('readonly');
    });

    
});