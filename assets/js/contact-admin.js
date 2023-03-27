import "../styles/contact-admin.scss";
console.log("is app_contact_admin");

/*** show  ***/

let contents = document.querySelectorAll(".contents");



contents.forEach((content) => {
content.addEventListener("click", ()=>{
  
})

});

/***copy email ***/

const email = document.getElementById('email');
const clickToCopy = document.getElementById('click-to-copy');


clickToCopy.addEventListener('click', () => {
    navigator.clipboard.writeText(email.textContent.trim())
    console.log("clicked")
    });