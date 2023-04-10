import '../styles/hangman-game.scss';
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
let used = document.querySelector("#used");

let word = database[random(database.length)];
let tableWord = word.split("");
let tableToFind = [];
let keyTested = undefined;
let error = false;
let pv = 9;
let win = 0;
let itsALetter = false;
let imgNbr= 0;


function random(max) {
return Math.floor(Math.random() * max );
}

function testingLetter(letterToTest, word) {
  let count = 0;
  for (let i = 0; i <= word.length; i++) {
    if (letterToTest === word[i] && letterToTest !== tableToFind[i]) {
      count++;
      tableToFind[i] = word[i];
      win++
      
    }
}
if ((count < 1 && imgNbr < 9)) {
    error = true;
    pv--
    imgNbr++

 
}
}

function gameLauncher() {
    for (let i = 0; i < tableWord.length; i++){
        tableToFind[i] = "_";
        wordToFind.innerHTML = tableToFind; 
        find.innerHTML = "0";
        toFind.innerHTML = word.length;
    } 
}
gameLauncher();

window.addEventListener("keydown", (event) => {
    keyTested = event.key;
    used.innerText += keyTested;
    
    azerty.forEach(letter => {
        if (letter === keyTested){
            return itsALetter=true;
        }
    });
    if (itsALetter = true) {
        testingLetter(keyTested, tableWord);
        wordToFind.innerHTML = tableToFind;
        img.src=`./assets/pendu${imgNbr}.png`
        pvEl.innerHTML =  pv;
        find.innerHTML = win;
        toFind.innerHTML = word.length;
    }
    if (pv === 0){
       gameOver.style.display = "block";
       btnReload.style.display = "block";
       gOWord.innerHTML = word;
       game.style.display="none";
       
    }
    if(win === word.length ){
        victory.style.display = "block";
        btnReload.style.display = "block";
        game.style.display="none";

    }

});

btnReload.addEventListener("click", () => {
    location.reload();
})
