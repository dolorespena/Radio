{literal}
    <section id="templateVueComments">
    
        <li v-for="comment in comments">
            <h3>{{comment.username}}</h3>
            <span> {{comment.detalle}}  </span>
            <span> {{comment.fecha}}</span>
            <!--   
            <span v-if="task.finalizada == 0 && auth">
                    <a data-id="{{task.id}}" class="btn-eliminar" href="#">eliminar</a>
                    <a data-id="{{task.id}}" class="btn-completar" href="#">completar</a>
            </span> 
            -->
        </li> 
    </section>
{/literal}

        