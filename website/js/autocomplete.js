$(function(){
    $("input#search").autocomplete({
        source: "search_autocomplete.php",
        minLength: 2,
        delay: 0,
        select: function(event, ui) { 
          $("input#search").val(ui.item.label);
          $("form#search").submit(); 
        }
      
    });
});
