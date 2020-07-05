{literal}
    <section id="templateVueComments">
        <p>Valoración promedio del Podcast: </p>
        <p class="promedio"></p>
        <li v-for="comment in comments">
            <h3>{{comment.username}}</h3>
            <span> {{comment.detalle}}  </span>
            <span> {{comment.fecha}}</span>
            <span> Valoracion {{comment.valoracion}}</span>
            <button v-if="isAdmin != 0" v-on:click="borrar(comment.id_comentario)">Eliminar</button>
            
        </li> 
    </section>
{/literal}

        