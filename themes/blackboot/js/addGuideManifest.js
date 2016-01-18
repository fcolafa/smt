var indexguide=0;
function addRowItem()
{
    
    var tbl= document.getElementById('tblguide');
    var lastRow=tbl.rows.length;
    var i=lastRow;
    var row=tbl.insertRow(lastRow);
 
    var cellComponent=row.insertCell(0);
    var component= document.createElement('div');
    component.name='guide'+i;
    component.id='guide'+i;
     component.style.width ='100%';
    cellComponent.appendChild(component);
 
    var cellButton=row.insertCell(1);
    var btn=document.createElement('input');
    btn.name='btndlt'+i;
    btn.id='btndlt'+i;
    btn.type='button';
    btn.style.marginLeft="0px";
    btn.style.width ='100%';
    btn.value='eliminar';
    
    /**
     * se añade una funcion para eliminar cada componente
     * a cada uno de los botones
    **/
    btn.addEventListener('click',function(){
    var td = this.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
      
    //aqui se reasignan las claves e ids de cada fila para poder procesar mejor los datos
    var id=parseInt(btn.id.substring(6,100));
    var x = document.getElementById(name);
    
    x.remove(id);
    
   
    
    var size=tbl.rows.length;
    while (id<size){
       var nid=id+1;
       document.getElementById('guide'+(nid)).setAttribute('name','guide'+id);
       document.getElementById('guide'+(nid)).setAttribute('id','guide'+id);
       document.getElementById('btndlt'+(nid)).setAttribute('name','btndlt'+id);
       document.getElementById('btndlt'+(nid)).setAttribute('id','btndlt'+id);
       id=id+1;
       }
        indexguide=indexguide-1;
       }
    );
    cellButton.appendChild(btn);
    i++;
} 