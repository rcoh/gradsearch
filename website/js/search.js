$(document).ready(function() {
  $(".close").click(function() {
    $(this.parentElement).slideUp();
  });
  $("li#saved").click(function() {
    $(this).toggleClass('active');
    $("li#starred").removeClass('active');
  });
  $("li#starred").click(function() {
    $(this).toggleClass('active');
    $("li#saved").removeClass('active');
    search = window.location.search;
    if(search.indexOf('starred=true') >= 0) {
      search = search.replace('&starred=true', '').replace('starred=true', '');
    } else {
      if (search.length > 0) {
        search += '&starred=true';
      } else {
        search += 'starred=true';
      }
    }
    window.history.pushState("some data", "Title", window.location.pathname + search);
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
    success : function(data) {
      $(document).ready(function() {
        $('span#filter').html(data); 
        $('[type=checkbox]').change(filterCheckChange);
      });
    },
    error : function(data) {
              alert('uhoh');
              //TODO: show alert [lost connection to the server]
    }
  });
}

reloadProfessors = function() {
  $.ajax({
    url:"get_professors.php",
    type:"GET",
    dataType: "json",
    data: window.location.search.replace('?', ''), 
    success : function(data) {
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
}
waitToBeReady = function (func) {
  return $(document).ready(function() {
    func();
  });
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

request_new_checkboxes();    
reloadProfessors();

