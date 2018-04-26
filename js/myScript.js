var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex-1].style.display = "block";
}

$(document).ready(function(){
    var id = 1;
    $("#moreImg").click(function(){
        var showId = ++id;
        if(showId <=10)
        {
            $(".input-files").append('<input type="file" name="image_upload-'+showId+'">');
        }
    });
});

// $("#searchBar .dropdown-menu li a"). click(function(){
//     var selText = $(this).text();
//     $(this).parents('#searchBar .btn-group').find('#searchBar .dropdown-toggle').html(selText);
// });

// $(".dropdown button").click(function(){
//     var selText = $(this).text();
//     $(this).parents('.dropdown-menu').find('.dropdown-item').html(selText);
// });

