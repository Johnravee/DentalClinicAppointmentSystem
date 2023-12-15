const editBtn = document.querySelector('#editMode');
const inputs = document.querySelectorAll('.input');
const editModeIndicator = document.querySelector('#editModeIndicator');



editBtn.addEventListener('click', ()=>{
    editModeIndicator.classList.toggle("displayEditMode");
    inputs.forEach(input =>{
        input.toggleAttribute('readonly');
        inputs[0].focus();
    });

    
});

