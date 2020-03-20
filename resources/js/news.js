// loadMore
$( document ).ready(function () {
    $(".news-item").slice(0, 3).show();
    if($(".news-item:hidden").length != 0) {
        $("#loadMore").show();
    }   
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".news-item:hidden").slice(0, 3).slideDown();
        if ($(".news-item:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
    });
});
// CKEDITOR
CKEDITOR.replace('news_body');
