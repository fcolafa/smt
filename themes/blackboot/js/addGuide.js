
function addRowItem()
{
    //se toma la tabla tblComponent que esta contenida dentro del sitio
    var tbl= document.getElementById('tblWeight');
    var lastRow=tbl.rows.length;
    var i=lastRow;
    var row=tbl.insertRow(lastRow);
    //Componente select
    var cellComponent=row.insertCell(0);
    var component= document.createElement('input');
    component.name='provider'+i;
    component.id='provider'+i;
    component.style.width ='100%';
    component.type='text';//remover en caso de volver a los select 
   
//    for(key in providerid ) {
//          opt =document.createElement('option');
//          opt.value = key;
//          opt.innerHTML = providerid [key];
//          component.appendChild(opt);
//    }
    var num=0;
    $('#tblWeight tr').each(function(){
      if(num%2==0 )
        $(this).addClass("even");
      else
        $(this).addClass("odd");
        num++;
      });
    cellComponent.appendChild(component);
    
    var cellWtype=row.insertCell(1);
    var wtype=document.createElement('input');
    wtype.name='wtype'+i;
    wtype.id='wtype'+i;
    wtype.style.width ='100%';
     wtype.type='text';//remover en caso de volver a los select 
  
//    for(key in typeweight){
//        opt =document.createElement('option');
//        opt.value = key;
//        opt.innerHTML = typeweight [key];
//        wtype.appendChild(opt);
//    }
    cellWtype.appendChild(wtype);
    
    var cellAmount=row.insertCell(2);
    var amount=document.createElement('input');
    amount.name='amount'+i;
    amount.id='amount'+i;
    amount.type='number';
    amount.style.width ='100%';
    amount.min=0;
    cellAmount.appendChild(amount);
    
    var cellUnit=row.insertCell(3);
    var unit=document.createElement('select');
    unit.name='unit'+i;
    unit.id='unit'+i;
    unit.style.width ='100%';
    
    
    for(key in units ) {
          opt =document.createElement('option');
          opt.value = key;
          opt.innerHTML = units[key];
          unit.appendChild(opt);
    }
    cellUnit.appendChild(unit);

    var cellButton=row.insertCell(4);
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
    var size=tbl.rows.length;
    while (id<size){
       var nid=id+1;
       document.getElementById('provider'+(nid)).setAttribute('name','provider'+id);
       document.getElementById('provider'+(nid)).setAttribute('id','provider'+id);
       document.getElementById('wtype'+(nid)).setAttribute('name','wtype'+id);
       document.getElementById('wtype'+(nid)).setAttribute('id','wtype'+id);
       document.getElementById('amount'+(nid)).setAttribute('name','amount'+id);
       document.getElementById('amount'+(nid)).setAttribute('id','amount'+id);
       document.getElementById('unit'+(nid)).setAttribute('name','amount'+id);
       document.getElementById('unit'+(nid)).setAttribute('id','amount'+id);
       document.getElementById('btndlt'+(nid)).setAttribute('name','btndlt'+id);
       document.getElementById('btndlt'+(nid)).setAttribute('id','btndlt'+id);
       id=id+1;
        }
       }
    );
    cellButton.appendChild(btn);
    i++;
} 

function saveGuide(){
    
var tbl= document.getElementById('tblWeight');
var size = tbl.rows.length;

var guide = new Array();
var weight = new Array();
var istext = /^([a-z]|[A-Z]|[0-9]|á|é|í|ó|ú|ñ|ü|\s|\.|-)+$/;
var validation='';

guide.push($('#Guide_num_guide').val());
guide.push($('#Guide_pdf_guide').val());
guide.push($('#Guide_id_user').val());
if(guide[0] =='')
    validation=validation+'-Numero de Guia no puede ser nulo \n';
if(size<1)
    validation=validation+'-Debe Existir al menos un tipo de carga asociado a la guia \n';
if(guide[2]==0)
    validation=validation+'-Usuario no puede ser nulo \n';

  for(gi in guides ) {
         //alert(gi +"-"+ guides[gi]);
        
         if(guide[0]==gi && company==guides[gi]){
             validation=validation+'- El numero de guia: '+gi+' ya ha sido tomado \n'
             break;
         }
    }
    
    for(var i=0;i<size; i++){
    if($('#amount'+i).val()==''|| $('#provider'+i).val()==''||$('#wtype'+i).val()==''){
        validation=validation+'-Todos los campos de las cargas asociadas deben ser completados \n';
    }
    weight.push([$('#provider'+i).val() ,$('#wtype'+i).val(),$('#amount'+i).val(),$('#unit'+i).val()]);
}
if(validation!=''){
    alert(validation);
    return false;
    }
  


var dir = window.location.origin;
  if(dir.indexOf("local")>-1)
      dir=dir+'/smt';

    $.ajax({
        type:"POST",
        url: urladdress,
                 data:{ guide: guide, 
                        weight: weight, 
                        newguide: newguide
                        },
                 success:function(data){
                    document.location.href=dir+'/guide/view/'+data;
                 },
                 error: function(data) { // if error occured
                         //alert("Error occured ".data);
                         },
                 dataType:'html'
   });
}