$(document).ready(function() {
  request_new_checkboxes();    
});


request_new_checkboxes = function() {
    $.ajax({
    url:"filter_options.php",
    type:"GET",
    dataType: "html",
    data: window.location.search.replace('?', ''), 
    success : function(data) {
      $('form#filter').html(data); 
      $('[type=checkbox]').change(filterCheckChange);
    },
    error : function(data) {
              alert('uhoh');
    }
  });
}

reloadProfessors = function() {
  $.ajax({
    url:"get_professors.php",
    type:"GET",
    dataType: "html",
    data: window.location.search.replace('?', ''), 
    success : function(data) {
      $('.prof_grid').html(data);
    }
  });
}

filterCheckChange = function() { 
  var new_url = '';
  var checkboxes = $('[type=checkbox]');
  var params = new Array();
  for (var i = 0; i < checkboxes.length; i++) {
    var box_cat = checkboxes[i].value;
    if(params[box_cat] == undefined) {
      params[box_cat] = [];
    }
    if (checkboxes[i].checked) {
      params[box_cat].push(checkboxes[i].name);
    }
  }
  for(key in params) {
    if(params[key].length > 0) {
      new_url += '&' + key + '=' + escape(params[key].join(','));
    }
  }
  new_url = window.location.pathname + '?q=' + getQueryVariable('q') + new_url
  window.history.pushState("object or string", "Title", new_url);
  request_new_checkboxes();
  reloadProfessors();
}

function getQueryVariable(variable) { 
  var query = window.location.search.substring(1); 
  var vars = query.split("&"); 
  for (var i=0;i<vars.length;i++) { 
    var pair = vars[i].split("="); 
    if (pair[0] == variable) { 
      return pair[1]; 
    } 
  } 
  return null;
} 

