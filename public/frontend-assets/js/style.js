$(document).ready(function(){
  // Toggle right and down arrow icon on show hide of collapse element
  $('.card-header').click(function() {
    var id = $(this).attr("id");  

    if ($('#'+id+' img').attr("src") == "image/uparrow.png") {
      $('#'+id+' img').attr('src', 'image/downarrow.png');
    } else {
      $('#'+id+' img').attr("src", "image/uparrow.png");
    }
  });  
});