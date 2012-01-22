$(function(){
    $("input#search").autocomplete({
        source: "search_autocomplete.php",
        select: function(event, ui) { 
          $("input#search").val(ui.item.label);
          $("form#search").submit(); 
        }
      
    });
});
