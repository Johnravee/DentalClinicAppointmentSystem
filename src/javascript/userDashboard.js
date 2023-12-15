const mails = document.querySelector('.mails');
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
    document.querySelector('.messages').classList.toggle("toggleMessages");

})

document.querySelector('#closeMessageModal').addEventListener('click', (e)=>{
  document.querySelector('.messages').classList.remove("toggleMessages");
})

console.log(mails.children.length );

//function to count messages 
function getMessageLength(){
  if(mails.children.length >= 1){
            notification.style.display = "inline";
            notification.innerHTML = mails.children.length;
            document.querySelector("#noMessageText").style.display = 'none';
            document.querySelector("#deleteMessages").style.display = 'block';
      }else{
        document.querySelector("#noMessageText").style.display = 'block';
        document.querySelector("#deleteMessages").style.display = 'none';
      }
}




  
});

document.querySelector('#deleteMessages').addEventListener('click', ()=> {
    document.querySelector('.deleteForm').submit();
});











 




