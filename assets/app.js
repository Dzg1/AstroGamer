/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

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