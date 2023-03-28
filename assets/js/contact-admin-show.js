import "../styles/contact-admin-show.scss";
console.log("is app_contact_admin_show");


/*** scroll de containermail ***/
window.addEventListener('load', function() {
    let containerMail = document.querySelector('#container-mail');
    if (containerMail) {
      containerMail.scrollTo(0, containerMail.scrollHeight);
    }
  });
  



/***copy email ***/

let email = document.querySelector('#email');
let clickToCopy = document.querySelector('#click-to-copy');
let copied = document.querySelector('#copied')


clickToCopy.addEventListener('click', () => {
    navigator.clipboard.writeText(email.textContent.trim())
    .then(() => {
        copied.classList.add("is-copied")
    })    
    .catch((err) => {
        console.error("Failed to copy text: ", err);
    });    
   
});    


