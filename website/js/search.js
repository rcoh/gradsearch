$(function(){

    /*$('#search').autocomplete(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], {
        width: 200,
        max: 3
    });*/
    $("#search").autocomplete({
        source: "search_autocomplete.php",
        minLength: 2
    });
    /*$('#search').autocomplete('search_autocomplete.php', {
        width: 200,
        max: 5
    });

    $('#country').autocomplete('data.php?mode=sql', {
        width: 200,
        max: 5
    });*/

});
