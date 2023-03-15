/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/app.scss';
console.log("is app");
// start the Stimulus application
// import './bootstrap';
// import 'bootstrap/dist/js/bootstrap';
 

/***animation navigationBubble ***/

let list = document.querySelectorAll(".nav-list");

function activeBubble(event){
    list.forEach(function (item) {
        event.preventDefault();
        item.classList.remove('active');
        event.currentTarget.classList.add('active');
    })
}
list.forEach((item) => {
    item.addEventListener('click',activeBubble);
});


/***close btn ***/

let closeBtns = document.querySelectorAll('.close')

closeBtns.forEach( function (closeBtn){
    closeBtn.addEventListener('click',function(event) {
        event.target.parentElement.style.display ="none";
    });
});

/*** open nav settings ***/
let settings = document.querySelector('#settings');
let settingsMenu = document.querySelector('#settings-menu');

    settings.addEventListener('click', () =>{
        settingsMenu.style.display = "flex";
    });
    

/*** open nav compte ***/
let accountBtns = document.querySelectorAll('.account');
let userMenu = document.querySelector('#user-menu');

accountBtns.forEach(function (accountBtn){

    accountBtn.addEventListener('click', () =>{
        userMenu.style.display = "flex";
    });
    
});