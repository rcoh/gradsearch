$(function(){

    $("#search").autocomplete({
        source: "search_autocomplete.php",
        minLength: 2
    });

});

$(document).ready(function() {
  $(".close").click(function() {
    $(this.parentElement).slideUp();
  });
});
