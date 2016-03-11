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
function addTableGuide(){
   
       
    var tbl= document.getElementById('tblguide');
    
    var size=tbl.rows.length;
   
    var row=tbl.insertRow(size); 
   
    //tabla de tablas de accesorios
    var guides=row.insertCell(0);
    var guide=document.createElement('table');
    guide.id='tbl'+size;
    guide.name='tbl'+size;
        guide.className='CSS_Table_Example responsive';
    guides.appendChild(guide);
    
    //subtabla
    var subtbl=document.getElementById('tbl'+size);
    var subsize=subtbl.rows.length;
    var subrow=subtbl.insertRow(subsize);
    
    var cellacc=subrow.insertCell(0);
    var acc=document.createElement('div');
    acc.id='guide'+size;
    acc.name='guide'+size;
   // acc.class='smtTable';

    acc.style.width ='100%';
    cellacc.appendChild(acc);
    
 
    //boton eliminar subcomponente
    var cellbtndlt=subrow.insertCell(1);
    var btndlt=document.createElement('input');
    btndlt.id='btndlt'+size;
    btndlt.name='btndlt'+size;
    btndlt.value='Eliminar Guia';
    btndlt.type='button';
        btndlt.addEventListener('click',function(){
        var celda = this.parentNode;
        var fila=celda.parentNode;
        var body=fila.parentNode;
        var table= body.parentNode;
        var acc=table.parentNode;
        var final=acc.parentNode;
        var tr=final.parentNode;
        tr.removeChild(final);
        
        var id=parseInt(btndlt.id.substring(7,100));
        var x = document.getElementById('Manifest__guides');
        $("#Manifest__weights option").each(function(){         
        var oid=$(this).attr("value").split("-");
        if(oid[0]==x.options[id].value){
             $(this).remove($(this).attr("id"));
        }});
   
    x.remove(id);
    
        var size=tbl.rows.length;
        while (id<size){
        var nid=id+1;
        document.getElementById('tbl'+(nid)).setAttribute('name','tbl'+id);
        document.getElementById('tbl'+(nid)).setAttribute('id','tbl'+id);
        document.getElementById('guide'+(nid)).setAttribute('name','guide'+id);
        document.getElementById('guide'+(nid)).setAttribute('id','guide'+id);
        document.getElementById('btndelt'+(nid)).setAttribute('name','btndelt'+id);
        document.getElementById('btndelt'+(nid)).setAttribute('id','btndelt'+id);
        id=id+1;
       }
       indexguide=indexguide-1;
    });
    cellbtndlt.appendChild(btndlt);
}
function addWeigth(index){
    //subtabla
       
        var subtbl=document.getElementById('tbl'+index);
        var lastrow=subtbl.rows.length;
        var subrow=subtbl.insertRow(lastrow); 
        
        var cellcomp=subrow.insertCell(0);
        var comp=document.createElement('div');
        comp.id="we"+index+lastrow;
        cellcomp.appendChild(comp);
        var cellvoid=subrow.insertCell(1);
        var cvoid=document.createElement('div');
        cvoid.id="blank"+index+lastrow;
        cellvoid.appendChild(cvoid);
 
}
