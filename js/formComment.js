"use strict";

let form = document.querySelector('#formComment');
form.addEventListener('submit', addComment);

getComments();

// define la app Vue
let app = new Vue({
    el: "#templateVueComments",
    data: {
        isAdmin: document.querySelector('#esAdmin').value,
        comments: [],
        borrar: function(id_comentario){
            borrar(id_comentario);
        }
    }
});

function getComments() {
    let id_podcast = document.querySelector("#id_podcast").value;
    fetch("api/comentarios/" + id_podcast)
    .then(response => response.json())
    .then(comments => {
        app.comments = comments; //asignacion de variable comments para el templates
        calcularPromedio();
    }).catch(error => console.log(error));
}

function calcularPromedio(){
    let suma = 0;
    let promedio = 0;
    let comentarios = app.comments
    if (comentarios.length > 0){
        for (let comentario of comentarios){
            suma += parseInt(comentario.valoracion);
        }
        promedio = suma/comentarios.length;
    }
    document.querySelector(".promedio").innerHTML = promedio.toFixed(2);
}

function addComment(){
    event.preventDefault();
    let f = new Date;
    let today = (f.getFullYear()+ "-" + (f.getMonth() +1) + "-" + f.getDate());
    let detail = document.querySelector('#comentario').value;
    let valuation = document.querySelector('#valoracion').value;
    let podcast = document.querySelector('#id_podcast').value;
    let user = document.querySelector('#id_user').value;

    if (detail != ""){
        let comment = {
            "detalle" : detail ,
            "valoracion" : valuation,
            "fecha" : today ,
            "id_podcast_fk" : podcast,
            "id_usuario_fk" : user
        };
        
        fetch('api/comentario/', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},       
            body: JSON.stringify(comment) 
        }).then(response => {
            console.log(response);
        }).then(json => {
            getComments();
            document.querySelector('#msjError').innerHTML = "";
            document.querySelector('#comentario').value = "";
            
        }).catch(error => console.log(error));
    }else{
        document.querySelector('#msjError').innerHTML = "Debe ingresar un comentario antes de enviar";
    }

}

function borrar(id_comentario){
    
    fetch('api/comentario/' + id_comentario, {
        method: 'DELETE',
        headers: {'Content-Type': 'application/json'},       
    }).then(response => {
        console.log(response);
    }).then(json => {
        getComments();
    }).catch(error => console.log(error));
}
