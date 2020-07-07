{literal}
    <section id="templateVueComments">
        <div class="total-valoracion">
            <p>Valoración promedio del Podcast: </p>
            <p class="promedio"></p>   
        </div>     
        <li v-for="comment in comments">
            <h3>{{comment.username}}</h3>
            <span> {{comment.detalle}}  </span>
            <div id="fecha-valor">
                <span> Fecha: {{comment.fecha}}</span>
                <span> Valoracion {{comment.valoracion}}</span>
            </div>
            <button v-if="isAdmin != 0" v-on:click="borrar(comment.id_comentario)">Eliminar</button>
        </li> 
    </section>
{/literal}

        