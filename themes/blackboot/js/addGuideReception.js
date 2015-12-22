var indexguide=0;
function addRowItem()
{
    //se toma la tabla tblComponent que esta contenida dentro del sitio
    var tbl= document.getElementById('tblguide');
    var lastRow=tbl.rows.length;
    var i=lastRow;
    var row=tbl.insertRow(lastRow);
    //Componente select
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
    var x = document.getElementById("Reception__guides");
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
if(guide[2]=='')
    validation=validation+'-Usuario no puede ser nulo \n';
if(validation!=''){
    alert(validation);
    return false;
    }

for(var i=0;i<size; i++){
    if($('#amount'+i).val()==''){
        alert('La cantidad asociada a una carga no puede ser nula');
    return false;
    }
    weight.push([$('#provider'+i).val() ,$('#wtype'+i).val(),$('#amount'+i).val(),$('#unit'+i).val()]);
}
    $.ajax({
        type:"POST",
        url: urladdress,
                 data:{ guide: guide, 
                        weight: weight, 
                        newguide: newguide
                        },
                 success:function(data){
                    document.location.href=window.location.origin+'/smt/guide/view/'+data;
                 },
                 error: function(data) { // if error occured
                         //alert("Error occured ".data);
                         },
                 dataType:'html'
   });
}