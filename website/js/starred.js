$(document).ready(function() {
    $.ajax({
      url:"saved_searches.php",
      type:"GET",
      dataType: "html",
      data: window.location.search.replace('?', ''), 
      success : function(data) {
        $('#main_search').html(data);
        $('.saved_search').click(function() {
        });
        $('.gray_star').click(function(){
          $(this).hide();
          $(this).prev().show();
          if($(this).hasClass('search_star')) {
            searchStar(true, $(this.parentElement.parentElement).attr('id'), $(this.parentElement.parentElement).attr('desc'));
          } else {
            setStar(true, $(this.parentElement.parentElement).attr('id'));
          }
            return false;
          });

        $('.gold_star').click(function(){
          $(this).hide();
          $(this).next().show();
          if($(this).hasClass('search_star')) {
            searchStar(false, $(this.parentElement.parentElement).attr('id'), $(this.parentElement.parentElement).attr('desc'));
          } else {
            setStar(false, $(this.parentElement.parentElement).attr('id'));
          }
          return false;
        });
      },
      error : function(data) {
      }
  });
});
searchStar = function(state, url, desc) { 
  $.ajax({
      url:"star_search.php",
      type: "POST",
      dataType: "json",
      data: {
      'state': state,
      'url' : url,
      'desc' : desc, 
      },
  success : function(data) {
      //TODO: we should probably do something
  },
  error : function(data) {
      //somethign here?
  }
});
}
