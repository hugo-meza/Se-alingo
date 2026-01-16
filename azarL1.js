var gif = ["A","B", "C","D", "E", "F", "G","H","I","J","K","L","LL","M","N","Ñ","O", "P","Q","R","RR","S","T","U","V","W","X","Y","Z"];
const otraOp = ["A","B", "C","D", "E", "F", "G","H","I","J","K","L","LL","M","N","Ñ","O", "P","Q","R","RR","S","T","U","V","W","X","Y","Z"];
var noAct = 1;
var aux = 1;
var aciertos = 0;
var noLuc = 5;
function resultados(){
    let inner = document.querySelector(".act-inner");
    var mvinner = "" + inner.style.transform;
    if(mvinner == "translateX(-5000px)"){
        var data = {
            Nv : "ptsL1",
            pts : aciertos
        };
        $.ajax({
            url: "puntaje.php",
            type: "POST",
            data: data,
            success: function(response) {
              document.write(response);
            },
            error: function(xhr, status, error) {
              console.log("Error en la solicitud AJAX: " + error);
            }
          });
        console.log("teoricamente esta correcto asu");
    }
}


function mostrar(){
    for(; noAct <= 5; noAct++){
        gif = azar(gif);
        console.log("esto mide el array " + gif.length);
        console.log("activided " + noAct);
    }
}

function quitarJ(a){
    let j = "#j" + a;
    let jarron = document.querySelector(j);
    jarron.style.zIndex = '1';
}
function Luciernagas(){
    let lu = "#l" + noLuc;
    console.log(lu);
    let luciernaga = document.querySelector(lu);
    luciernaga.style.transform = 'scale(0)';
    noLuc--;
    if(noLuc > 0){
        lu = "#l" + noLuc;
        console.log(lu);
        let luciernaga2 = document.querySelector(lu);
        luciernaga2.style.transform = 'scale(1)';
    }
}

function mostrarJ(a){
    let j = "#j" + a;
    let jarron = document.querySelector(j);
    jarron.style.zIndex = '2';
}

function incorrecto(){
    let inner = document.querySelector(".act-inner"); // agarro el inner para poder mover las actividades
    var a = "act" + aux;
    let ancho = document.getElementById(a).clientWidth; //obtengo el ancho del div de actividad para moverlo
    ancho = ancho * aux; //obtengo el total de que se debe de desplazar el inner
    inner.style.transform = 'translateX(' + -ancho + 'px)'; //desplazo el inner con el translateX
    Luciernagas();
    let aux2 = "#act" + (aux);
    aux++;
    let aux3 = "#act" + aux;
    let quitar = document.querySelector(aux2); //id de la actividad que quiero desaparecer
    let poner = document.querySelector(aux3); //id de la actividad que quiero aparecer
    quitar.classList.remove("mostrar"); //le quitamos la clase mostrar al div que queremos desaparecer
    if(aux < 6){ //para q no intente hacer algo con un act6 pq no existe
        poner.classList.add("mostrar"); //le ponemos la clase mostrar al div q queremos aparecer
    }   

    console.log("incorrecto");   
    console.log(aciertos); 
    resultados();
}

function correcto(){
    let inner = document.querySelector(".act-inner"); // agarro el inner para poder mover las actividades
    let ancho = document.getElementById("act1").clientWidth; //obtengo el ancho del div de actividad para moverlo
    ancho = ancho * aux; //obtengo el total de que se debe de desplazar el inner
    inner.style.transform = 'translateX(' + -ancho + 'px)'; //desplazo el inner con el translateX
    quitarJ(aciertos);
    aciertos++;
    mostrarJ(aciertos);
    Luciernagas();
    let aux2 = "#act" + (aux);
    aux++;
    let aux3 = "#act" + aux;
    let quitar = document.querySelector(aux2); //id de la actividad que quiero desaparecer
    let poner = document.querySelector(aux3); //id de la actividad que quiero aparecer
    quitar.classList.remove("mostrar"); //le quitamos la clase mostrar al div que queremos desaparecer
    if(aux < 6){ //para q no intente hacer algo con un act6 pq no existe
        poner.classList.add("mostrar"); //le ponemos la clase mostrar al div q queremos aparecer
    }    
    console.log("aciertos: " + aciertos);
    resultados();
}
mostrar();
function azar(gif){
    var usado = [];
    var no = parseInt(Math.random()*(gif.length) + 1);
    console.log(no);
    var letra = gif[no - 1];
    var n = "L1_" + letra + ".gif";
    console.log(n);
    console.log(letra);
    if(noAct == 1){
        document.write("<div id = 'act" + noAct +"' class = 'mostrar'>");
    }else{
        document.write("<div id = 'act" + noAct +"'>");
    }
    var body = document.body - 66;
    var miDiv = document.getElementById("act" + noAct);
    miDiv.style.width = body.offsetWidth + "px";
    document.write("<img src='Lecciones/Abecedario/Gifs/L1/"+ n +"' alt='Letra" + letra +"' class='abajo'></img>");
    var btnC = parseInt(Math.random()*4 + 1);
    console.log(btnC);

    function otros(){
        let oLetra;
        do{
            var b = true;
            let o = parseInt(Math.random()*(otraOp.length) + 1);
            oLetra = otraOp[o - 1];
            if(oLetra == letra){
                b = false
            }
            for(let i = 0; i < 3; i++){
                if(oLetra == usado[i]){
                    b = false;
                    break;
                }
            }
        }while(b == false);
        return oLetra;
    }
    document.write("<div class = 'btn-cont'>");
    for(let i = 1; i <= 4; i++){
        if(i == 1 || i == 3){
            document.write("<div class = 'grupo-btn'>")
        }
        if(btnC == i){
            document.write("<form action='javascript:void(0)' onclick = 'correcto()' method='post'><input name='ap"+ i +"' type='text' value='1' hidden><button type='submit' class = 'btn-op' id = 'true'>" + letra + "</button></form>");
            usado.push(letra);
            gif.splice(no-1,1);
        }else{
            var otro = otros();
            document.write("<form action='javascript:void(0)' onclick = 'incorrecto()' method='post'><input name='ap"+ i +"' type='text' value='-1' hidden><button type='submit' class = 'btn-op' id = 'true'>" + otro + "</button></form>");
            usado.push(otro);
            //incorrecto();
        }
        if(i == 2 || i == 4){
            document.write("</div>");
        }
        
    }
    document.write("</div>");
    document.write("</div>");
    
    return gif;
}