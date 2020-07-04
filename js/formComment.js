"use strict";

let form = document.querySelector('#formComment');
form.addEventListener('submit', addComment);

function addComment(){
    event.preventDefault();
    let f = new Date;
    let today = (f.getFullYear()+ "-" + (f.getMonth() +1) + "-" + f.getDate());
    let detail = document.querySelector('#comentario').value;
    let valuation = document.querySelector('#valoracion').value;
    let podcast = document.querySelector('#id_podcast').value;
    let user = document.querySelector('#id_user').value;

    let comment = {
        "detalle" : detail ,
        "valoracion" : valuation,
        "fecha" : today ,
        "id_podcast_fk" : podcast,
        "id_usuario_fk" : user
    };

    console.log(comment);
    
    fetch('http://localhost:80/radio/api/comentario/', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},       
        body: JSON.stringify(comment) 
     })
     .then(response => {
         console.log(response);
     })
     .catch(error => console.log(error));
}





