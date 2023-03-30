import "../styles/contact-admin.scss";
console.log("is app_contact_admin");

/*** show  ***/

let contents = document.querySelectorAll(".contents");

contents.forEach((content) => {
  content.addEventListener("click", () => {});
});

/*** requête ajax is_read ***/

let contact = document.querySelectorAll(".line");

// Boucle sur tous les messages pour ajouter un écouteur de clic
contact.forEach((contact) => {
  contact.addEventListener("click", () => {
    // Récupération de l'ID du contact
    let contactId = contact.dataset.messageId;

    // Envoi d'une requête AJAX pour mettre à jour l'état de lecture
    fetch(`/contact/admin/${contactId}/mark-as-read`, { method: "POST" })
      .then((response) => response.json())
      .then((data) => {
        // Mettre à jour l'apparence du contact pour refléter l'état de lecture
        if (data.is_read) {
          contact.classList.add("read");
        } else {
          contact.classList.remove("read");
        }
      });
  });
});
