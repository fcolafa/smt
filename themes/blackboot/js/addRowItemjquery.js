 $(function(){
//clic en el boton para agregar columnas
    $('#btnAgregarColumna').on('click',function(){
        //tomamos la tabla con la que vamos a trabajar
        var $objTable=$('#tblTabla'),
        //contamos la cantidad de columnas que tiene la tabla
        totalRow=$('#tblTabla tr').length;
        $('#tblTabla tbody tr:last').after('\
          <tr>\n\
            <td><input type="text" size="4"></td>\n\
            <td><input type="text" size="4"></td>\n\
            <td><input type="text" size="4"></td>\n\
            <td><input type="text" size="4"></td>\n\
            <td><a href="" class="clsEliminar">Eliminar</a></td>\n\
           </tr>'
            ); 
    });
//clic en el enlace para eliminar la columna
    $('.clsEliminar').live('click',function(e){
        //prevenimos el comportamiento predeterminado del enlace
        e.preventDefault();
        //id de la tabla con la que estamos trabajando
        var $objTabla=$('#tblTabla'),
        totalRow=$('#tblTabla tbody tr').length;
        //obtenemos el indice de la columna que se va a eliminar (padre del link)
        deleteRow=$(this).parents('tr').prevAll().length,
        //guardamos en una variable la cantidad de filas que tiene la tabla
        //con 'eq' especificamos el indice o la posicion del elemento
        //es como decir: eliminar el elemento TD/TH que este en el indice 4 (por ejemplo)
         $(this).find('tr:eq('+deleteRow+')').remove();

    });
});