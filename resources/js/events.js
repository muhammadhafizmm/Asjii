{/* multi upload jquery */}
$(document).ready(function() {
$(".btn-success").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});
$("body").on("click",".btn-danger",function(){ 
    $(this).parents(".control-group").remove();
});
});

{/* date picker jquery */}
$('#event_date').datepicker({
format: 'dd-mm-yyyy'
});

{/* CKEditor jquery */}
CKEDITOR.replace( 'event_description' );