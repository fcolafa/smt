  $(document).ready(function(){

  var droplist = $('#Users_role');
  var company = $('#Users_id_company');
  if(droplist.val()!='Cliente')
       $('#divcompany').hide();
  
  droplist.change(function(e){
    if (droplist.val() == 'Cliente') {
      $('#divcompany').show();
    }
    else {
      $('#divcompany').hide();
      company.val('Seleccione Empresa');
    }
  })
});