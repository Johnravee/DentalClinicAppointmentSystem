const messages = document.querySelector('.messages');
const notification = document.querySelector('#notification');
const email = document.querySelector("#email");
const messageBtns = document.querySelectorAll('.subject');
const messageBodys = document.querySelectorAll('.messageBody');
const subjectTittles = document.querySelectorAll(".subjectTittle");
const envelops = document.querySelectorAll('#envelop');


// RUN THIS BLOCK OF CODE WHEN CONTENT IS LOADED
document.addEventListener("DOMContentLoaded", ()=>{
  getMessageLength()

   // CHECK THE TEXT OF THE BOX
messageBtns.forEach((messageBtn, index) => {

  subjectTittles.forEach(subjectTittle =>{
  subjectTittle.innerHTML === "REJECTED" ? 
    subjectTittle.style.color = "#d9534f" :  subjectTittle.style.color = "#5cb85c";
})


messageBtn.addEventListener('click', ()=>{
    messageBodys.forEach((messageBody, messageBodyIndex) =>{
      index === messageBodyIndex ? 
        messageBody.classList.toggle("messageBodyToggler")
       : 
        messageBody.classList.remove('messageBodyToggler')
      

      
    })
  });
})


//Toggle notification box
email.addEventListener('click', ()=>{
    messages.classList.toggle("toggleMessages");
})

//function to count messages 
function getMessageLength(){
  if(messages.children.length > 1){
            notification.style.display = "inline";
            notification.innerHTML = messages.children.length - 1;
        
      }
}



  // SHOW FULL DETAILS OF MESSAGE IF CLICK THE BOX
  
});










 




