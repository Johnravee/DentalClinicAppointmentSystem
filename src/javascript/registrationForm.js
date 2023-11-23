
const pass = document.querySelector("#pass");
const confirmPass = document.querySelector('#cpass');
const empID = document.querySelector("#empID");
const Acctypes = document.querySelectorAll(".Acctype");



confirmPass.addEventListener('input', checkMatchedPassword);

//Check if password is matched 
function checkMatchedPassword(){

    pass.value.length > 0 ? 
    (
        pass.value === confirmPass.value ?
            (
            confirmPass.style.borderColor  = "#14A44D",
            document.querySelector('small').innerText = "Password matched!",
            document.querySelector('small').style.color  = '#14A44D'
            ) 
             :
             (
            confirmPass.style.borderColor  = "#DC4C64",
            document.querySelector('small').innerText = "Password not matched!",
            document.querySelector('small').style.color  = '#DC4C64 '
            )
    ) 
        : 
    (
        confirmPass.style.borderColor  = null,
        document.querySelector('small').innerText = null,
        document.querySelector('small').style.color  = null
    )
}


Acctypes.forEach(Acctype => {
    Acctype.addEventListener('change', function() {
        let selectedValue;
        this.checked && ( selectedValue = this.value);
        
        selectedValue === "admin" ? (
            empID.style.display = "block",
            empID.setAttribute("required", "true")
        ) : (
            empID.style.display = "none",
            empID.removeAttribute("required")
            );
    });
});