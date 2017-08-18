<hr>
<table class="table">
    <tr>
        <th>
            Total de Imagenes
        </th>
        <td>
            {{$cantidad_imagenes[0]}} 
        </td>
    </tr>                   
    
    <tr>
        <th>
            Total de Recortes
        </th>
        <td>
            {{$cantidad_imagenes[5]}} 
        </td>
    </tr> 

    <tr>
        <th>
            Espacio Libre
        </th>
        <td>
            {{$cantidad_imagenes[3]}} GB                            
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="progress">
                <div class="progress-bar progress-bar-danger" style="width: {{$cantidad_imagenes[1]}}%">
                </div>
                <div class="progress-bar progress-bar-success" style="width: {{$cantidad_imagenes[2]}}%">
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <th>
            Espacio Total
        </th>
        <td>
            {{$cantidad_imagenes[4]}} GB
        </td>
    </tr>
</table>