//Disable the past dates
function disabledPastDates(){
    const dateObj = new Date();
    const formattedCurrentDate = dateObj.toISOString().split("T")[0];
    document.querySelector('#DATE').setAttribute('min', formattedCurrentDate);
}

disabledPastDates();

//function to generate transaction no.
function transactionNumberGenerator(){
     let transacNumber = '';
          const charSet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          
          for(let i = 0 ; i <= 10 ; i++){
           transacNumber += charSet.charAt(Math.floor(Math.random() * charSet.length))
          }

          return transacNumber;
}


const bookBtn = document.querySelector("#save");
bookBtn.addEventListener("click", ()=>{
    const selectedTimeRadio = document.querySelector('input[name="scheduledTime"]:checked');
    const DATE = document.querySelector('#DATE').value;
    const appointmentType = document.querySelector('#type').value;
    const consultant = document.querySelector('#consultants').value;

    
    
    // Transaction Number 
    const transactionNumber = transactionNumberGenerator();
    
   

     if(selectedTimeRadio === false || DATE === '' ||  appointmentType === '' || consultant === '' ){
        alert("There's an empty field");
        return;
     }else{
        // MODAL SCREEN SHOW WHEN THE CONDITION IS FALSE
        document.querySelector('.modalScreen').style.display = "block";
        document.querySelector("#appointedTime").value = selectedTimeRadio.value;
        document.querySelector("#appointedDate").value = DATE;
        document.querySelector("#consult").value = consultant;
        document.querySelector("#appointmentTypeModal").value = appointmentType;
        document.querySelector("#transactionNumber").value = transactionNumber;
     }

   

    
    
})

    //  CLOSE MODAL WHEN CLICK TO BUTTON
    document.querySelector(".modalClose").addEventListener("click", ()=>{
        // MODAL SCREEN
     document.querySelector('.modalScreen').style.display = "none";
    })


  