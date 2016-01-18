var indexguide=0;
function addTableGuide(){
   
    var tbl= document.getElementById('tbl_guide');
    var size=tbl.rows.length;
    var row=tbl.insertRow(size); 
    
    //tabla de tablas de accesorios
    var guides=row.insertCell(0);
    var guide=document.createElement('table');
    guide.id='tbl'+size;
    guide.name='tbl'+size;
    guides.appendChild(guide);
    
    //subtabla
    var subtbl=document.getElementById('tbl'+size);
    var subsize=subtbl.rows.length;
    var subrow=subtbl.insertRow(subsize);
    
    var cellacc=subrow.insertCell(0);
    var acc=document.createElement('div');
    acc.id='gui'+size;
    acc.name='gui'+size;
    acc.style.width ='100%';
    cellacc.appendChild(acc);
    
 
    //boton eliminar subcomponente
    var cellbtndlt=subrow.insertCell(1);
    var btndlt=document.createElement('input');
    btndlt.id='btndelt'+size;
    btndlt.name='btnedlt'+size;
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
        var x = document.getElementById('Reception__guides');
          $("#Reception__newAmount option").each(function(){
         
        var oi2=$(this).attr("value").split("-");
        if(oi2[0]==x.options[id].value){
             $(this).remove($(this).attr("id"));
        }
           
     });
     $("#Reception__weights option").each(function(){
         
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
        document.getElementById('gui'+(nid)).setAttribute('name','gui'+id);
        document.getElementById('gui'+(nid)).setAttribute('id','gui'+id);
        document.getElementById('btndelt'+(nid)).setAttribute('name','btndelt'+id);
        document.getElementById('btndelt'+(nid)).setAttribute('id','btndelt'+id);
        document.getElementById('btnadd'+(nid)).setAttribute('name','btnadd'+id);
        document.getElementById('btnadd'+(nid)).setAttribute('id','btnadd'+id);
        id=id+1;
       }
       indexguide=indexguide-1;
    });
    cellbtndlt.appendChild(btndlt);
}

function addWeigth(index){
    //subtabla
        var amount=document.getElementById('Reception__newAmount'); 
        var subtbl=document.getElementById('tbl'+index);
        var lastrow=subtbl.rows.length;
        var subrow=subtbl.insertRow(lastrow); 
        
        var cellcomp=subrow.insertCell(0);
        var comp=document.createElement('div');
        comp.id="we"+index+lastrow;
        cellcomp.appendChild(comp);
        
        var cellvalue=subrow.insertCell(1);
        var val=document.createElement('input');
        val.id='namount'+index+lastrow;
        val.type='number';
        val.step=0.1;
        val.min=0;
        val.addEventListener('click', function(){
            val.value='';
            var id=val.id.substring(7,100);
            var ch=document.getElementById('check'+id);
            ch.checked=false;
                    if(amount.options.length>0){
                           var ach=document.getElementById("we"+id);
                           for( i=0;i<amount.options.length;i++){
                              var wo=amount[i].text.split("-"); 
                               if(wo[0]+'-'+wo[1]==ach.className){
                                   amount.remove(i);
                                  
                               }
                   }
            }
            
        });
        cellvalue.appendChild(val);
        var cellcheck=subrow.insertCell(2);
        var check=document.createElement('input');
      
        check.id='check'+index+lastrow;
        check.type='checkbox';
        check.addEventListener('click',function(){
           var ch=document.getElementById('check'+index+lastrow);
           var ww=document.getElementById('we'+index+lastrow);
           if(ch.checked){
               var amountr=document.getElementById('namount'+index+lastrow);
               if(amountr.value==''){
                    ch.checked=false;
                    alert("La cantidad recibida no puede estar vacia");
                    amountr.value='';
                    return false;
                }
                   $("#Reception__newAmount").append(new Option(ww.className+"-"+amountr.value,ww.className+"-"+amountr.value, true, true));
                     indexamount=indexamount+1;
                
           }else if(!ch.checked && amount.options.length>0 ){
                   
                   var id=ch.id.substring(5,100);
                   var ach=document.getElementById("we"+id);
                   var nano=document.getElementById("namount"+id);
                   for( i=0;i<amount.options.length;i++){
                      var wo=amount[i].text.split("-"); 
                       if(wo[0]+'-'+wo[1]==ach.className){
                           amount.remove(i);
                           nano.value='';
                       }
           }
       }
        });
        cellcheck.appendChild(check);

    //boton eliminar subcomponente
//    var cellbtndlt=subrow.insertCell(1);
//    var btndlt=document.createElement('input');
//    btndlt.id='btndslt'+size;
//    btndlt.name='btnsdlt'+size;
//    btndlt.value='Eliminar Guia';
//    btndlt.type='button';
//        btndlt.addEventListener('click',function(){
//        var celda = this.parentNode;
//        var fila=celda.parentNode;
//        var body=fila.parentNode;
//        var table= body.parentNode;
//        var acc=table.parentNode;
//        var final=acc.parentNode;
//        var tr=final.parentNode;
//        tr.removeChild(final);
//        
//        var id=parseInt(btndlt.id.substring(7,100));
//        var x = document.getElementById(name);
//     $("#Reception__weights option").each(function(){
//        if($(this).attr("value")==x.options[id].value)
//            $(this).remove($(this).attr("id"));
//     });
//    x.remove(id);
//    
//        var size=tbl.rows.length;
//        while (id<size){
//        var nid=id+1;
//        document.getElementById('tbl'+(nid)).setAttribute('name','tbl'+id);
//        document.getElementById('tbl'+(nid)).setAttribute('id','tbl'+id);
//        document.getElementById('gui'+(nid)).setAttribute('name','gui'+id);
//        document.getElementById('gui'+(nid)).setAttribute('id','gui'+id);
//        document.getElementById('btndelt'+(nid)).setAttribute('name','btndelt'+id);
//        document.getElementById('btndelt'+(nid)).setAttribute('id','btndelt'+id);
//        document.getElementById('btnadd'+(nid)).setAttribute('name','btnadd'+id);
//        document.getElementById('btnadd'+(nid)).setAttribute('id','btnadd'+id);
//        id=id+1;
//       }
//       indexguide=indexguide-1;
//    });
//    cellbtndlt.appendChild(btndlt);
}
function orderSelect(){
     var weig=document.getElementById('Reception__weights');
     for( i=0;i<weight.options.length;i++){   
     }
}




