import "../styles/hangman-game.scss";
console.log("is app_hangman_game");

let wordToFind = document.querySelector("#word-to-find");
let pvEl = document.querySelector("#pv");
let find = document.querySelector("#find");
let toFind = document.querySelector("#tofind");
let victory = document.querySelector("#victory");
let gameOver = document.querySelector("#game-over");
let gOWord = document.querySelector("#gOWord");
let btnReload = document.querySelector("#btn-reload");
let img = document.querySelector("#img");
let game = document.querySelector("#game");
let gameText = document.querySelector("#game-text");
let used = document.querySelector("#used");
let keyContain= document.querySelector('#key-contain');

let tableToFind = [];
let keyTested = undefined;
let error = false;
let pv = 9;
let win = 0;
let itsALetter = false;
let imgNbr = 0;
let azerty = [
  "a",
  "b",
  "c",
  "d",
  "e",
  "f",
  "g",
  "h",
  "i",
  "j",
  "k",
  "l",
  "m",
  "n",
  "o",
  "p",
  "q",
  "r",
  "s",
  "t",
  "u",
  "v",
  "w",
  "x",
  "y",
  "z",
];

// ajax
var xhr = new XMLHttpRequest();
xhr.open("GET", "/hangman/game/word", true);
xhr.onload = function () {
  if (xhr.status === 200) {
    let response = JSON.parse(xhr.responseText);
    let word = response.word;
    let tableWord = word.split("");
    console.log(response.word); 

    function testingLetter(letterToTest, word) {
      let count = 0;
      for (let i = 0; i <= word.length; i++) {
        if (letterToTest === word[i] && letterToTest !== tableToFind[i]) {
          count++;
          tableToFind[i] = word[i];
          win++;
        }
      }
      if (count < 1 && imgNbr < 9) {
        error = true;
        pv--;
        imgNbr++;
      }
    }

    function gameLauncher() {
      for (let i = 0; i < tableWord.length; i++) {
        tableToFind[i] = "_";
        wordToFind.innerHTML = tableToFind.join(" ");
        azerty.forEach((letter) => {
          let key = document.createElement("div");
          key.innerHTML = letter;
         keyContain.appendChild(key);
        });
      }
    }
    gameLauncher();

    window.addEventListener("keydown", (event) => {
      keyTested = event.key;
        azerty.forEach((letter) => {
        if (letter === keyTested) {
          return (itsALetter = true);
        }
      });
      if (itsALetter === true) {
        testingLetter(keyTested, tableWord);
        wordToFind.innerHTML = tableToFind.join(" ");
        img.src = `../images/hangman/hang${imgNbr}.png`;
      }
      if (pv === 0) {
        gameOver.style.display = "block";
        btnReload.style.display = "block";
        gOWord.innerHTML = word;
        gameText.style.display = "none";
      }
      if (win === word.length) {
        victory.style.display = "block";
        btnReload.style.display = "block";
        gameText.style.display = "none";
      }
    });

    btnReload.addEventListener("click", () => {
      location.reload();
    });
  } else {
    console.log("Erreur de chargement de la page.");
  }
};
xhr.send();
