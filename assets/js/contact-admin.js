import "../styles/contact-admin.scss";
console.log("is app_contact_admin");

/*** troncage du content  ***/

let contents = document.querySelectorAll(".contents");

function truncateText(textContainer) {
  var maxWidth = textContainer.offsetWidth;
  var text = textContainer.textContent;

  while (textContainer.offsetWidth > maxWidth) {
    text = text.slice(0, -1);
    textContainer.textContent = text + "...";
    console.log("is truncate"); 
  }
}

contents.forEach((content) => {
    content.style.width = "100%";
  truncateText(content);

});
