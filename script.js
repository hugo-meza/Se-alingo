const cards = document.querySelectorAll('.card');
const cardGif = document.querySelectorAll('.card.gif');
const cardOp = document.querySelectorAll('.card.op');
//console.log(cardGif);
//console.log(cards);
let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
var incorrecto = document.getElementById('incorrecto');
var correcto = document.getElementById('correcto');
var bien = 0;

function flipCard() {
    if (lockBoard) return;
    if (this === firstCard) return;
    this.classList.add('flip');
    if (!hasFlippedCard) {
        hasFlippedCard = true;
        firstCard = this;
        return;
    }
    secondCard = this;
    checkForMatch();
}

function checkForMatch() {    
    let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;
    if(isMatch){
        correcto.playbackRate = 1.7;
        //console.log("correcto >:");
        correcto.play();
        bien++;
        if(bien == 3){
            window.parent.habilitarbtnSig();
            console.log("bien :))");
        }
        disableCards();
    }else{
        incorrecto.playbackRate = 1.2;
        //console.log("incorrecto >:");
        incorrecto.play();
        unflipCards();
    }
}

function disableCards() {
    // Reproduce el sonido
    //console.log("correcto >:")
    correcto.play();
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);

    resetBoard();
}

function unflipCards() {
    lockBoard = true;
    // Reproduce el sonido
    //console.log("incorrecto >:")
    incorrecto.play();
    setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');
        resetBoard();
    }, 1000);
}


function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
}
let usadoGif = [];
let bandereGif = true;
let usadoOp = [];
let bandereOp = true;
function obtenerNumeroPar() {
    // Generar un número decimal aleatorio entre 0 y 3
    let numeroDecimal = Math.random() * 3;

    // Redondear hacia abajo y sumar 1 para obtener 0, 2 o 4
    let numeroFinal = Math.floor(numeroDecimal) * 2;

    return numeroFinal;
}
function obtenerNumeroImpar() {
   // Generar un número decimal aleatorio entre 0 y 2
   let numeroDecimal = Math.random() * 3;

   // Redondear hacia abajo y sumar 1 para obtener 1, 3 o 5
   let numeroFinal = Math.floor(numeroDecimal) * 2 + 1;

   return numeroFinal;
}
(function shuffle() {
    cardGif.forEach(card => {
        do{
            bandereGif = true;
            let randomPos = obtenerNumeroPar();
            //console.log("esta es la random pos "+randomPos);
            for(let i = 0; i < usadoGif.length; i++){
                //console.log("esto es lo q hay "+usadoGif[i]);
                if(usadoGif[i] == randomPos){
                    bandereGif = false;
                    //console.log("hay uno igual");
                    break;
                }
            }
            //console.log("ya salio");
            if(bandereGif == true){
                card.style.order = randomPos;
                usadoGif.push(randomPos);
            }
        }while(bandereGif == false);
        //console.log(usadoGif.length);
    })
    cardOp.forEach(card => {
        do{
            bandereOp = true;
            let randomPos =obtenerNumeroImpar();
            //console.log("esta es la random pos "+randomPos);
            for(let i = 0; i < usadoOp.length; i++){
                //console.log("esto es lo q hay "+usadoOp[i]);
                if(usadoOp[i] == randomPos){
                    bandereOp = false;
                    //console.log("hay uno igual");
                    break;
                }
            }
            //console.log("ya salio");
            if(bandereOp == true){
                card.style.order = randomPos;
                usadoOp.push(randomPos);
            }
        }while(bandereOp == false);
        //console.log(usadoOp.length);
    })
})();

cards.forEach(card => card.addEventListener('click', flipCard));
