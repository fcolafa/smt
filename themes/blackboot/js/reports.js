  $(document).ready(function(){

  var droplist = $('#Reports__type');

  if(droplist.val()!='2')
      $('#range').hide();
  if(droplist.val()!='1')
       $('#frame').hide();
   
  droplist.change(function(e){
    if (droplist.val() == '1') {
      $('#frame').show();
    }
    else {
      $('#frame').hide();
    }
    if (droplist.val() == '2') {
      $('#range').show();
    }
    else {
      $('#range').hide();
    }
  })
  
  
  
});