$(function(){

    $("#search").autocomplete({
        source: "search_autocomplete.php",
        minLength: 2
    });

});
