$(window).bind("popstate", function(event) {
  request_new_checkboxes();
  reloadProfessors();
});
$(document).ready(function() {
  $(".close").click(function() {
    $(this.parentElement).slideUp();
  });
  $("li#saved").click(function() {
    $(this).toggleClass('active');
  });
  $("li#starred").click(function() {
    window.history.pushState("some data", "Title", window.location.pathname + '?starred=true');
    reloadProfessors();
    request_new_checkboxes();
  });
});

request_new_checkboxes = function() {
    $.ajax({
    url:"filter_options.php",
    type:"GET",
    dataType: "html",
    data: window.location.search.replace('?', ''), 
    success : loadNewCheckboxes,
    error : function(data) {
              alert('uhoh');
              //TODO: show alert [lost connection to the server]
    }
  });
}
loadNewCheckboxes = function(data) {
  $(document).ready(function() {
    $('span#filter').html(data); 
    $('[type=checkbox]').change(filterCheckChange);
  });
}
reloadProfessors = function() {
  $.ajax({
    url:"get_professors.php",
    type:"GET",
    dataType: "json",
    data: window.location.search.replace('?', ''), 
    success : loadNewProfData  
  });
}

loadNewProfData = function(data) {
      $(document).ready(function() {
        $('.prof_grid').html(data['html']);
        $('p#search_description').html(data['description']);
        $('.gray_star').click(function(){
          $(this).hide();
          $(this).prev().show();
          setStar(true, $(this).attr('id'));
          return false;
        });

        $('.gold_star').click(function(){
          $(this).hide();
          $(this).next().show();
          setStar(false, $(this).attr('id'));
          return false;
        });

      });
}
setStar = function(state, id) { 
  $.ajax({
    url:"set_star.php",
    type: "POST",
    dataType: "json",
    data: {
      'state': state,
      'id' : id
    },
    success : function(data) {
      //TODO: we should probably do something
    },
    error : function(data) {
    }
  });
  var currentCount = parseInt($('span#numstarred').html());
  if(state == true) {
    currentCount += 1;
  } else {
    currentCount -= 1;
  }
  $('span#numstarred').html(currentCount);
}

uncheckCategory = function(category) {
  var checkboxes = $('[value=' + category + ']');
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = false;
  }
  filterCheckChange();
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
  var query;
  if(getQueryVariable('q')) {
    query = '?q=' + getQueryVariable('q');
  } else {
    query = '?';
    new_url = new_url.substring(1);
  }
  var new_url = window.location.pathname + query + new_url
  window.history.pushState(getState(), "Title", new_url);
  request_new_checkboxes();
  reloadProfessors();
}

function getState() {
  return {url: window.location.search, 
          filter: $('span#filter').html(), 
          grid: {description: $('p#search_description').html(), 
          html: $('.prof_grid').html()}
         };
        
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

request_new_checkboxes();    
reloadProfessors();

