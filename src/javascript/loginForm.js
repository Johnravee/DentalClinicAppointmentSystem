const pass = document.querySelector("#pass");
const showPass = document.querySelector("#showPass");

// CHECK IF THE SHOWPASS ELEMENT IS CHECKED 
showPass.addEventListener("click", ()=>{
   showPass.checked ? pass.type = 'text' : pass.type = 'password'
})
