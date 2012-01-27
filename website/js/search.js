$(window).bind("popstate", function(event) {
  request_new_checkboxes();
  reloadProfessors();
});
$(document).ready(function() {

    $(document).bind('keyup.modal', function ( e ) {
      if ( e.which == 37 ) {
      modal_slide('prev')();
      }
      else if ( e.which == 39 ) {
      modal_slide('next')();
      }
      });

    $(".prof_modal_next").live("click", modal_slide('next'));
    $(".prof_modal_prev").live("click", modal_slide('prev'));

    $(".prof_box").click(function(){
      //to do: set up background
      var modal_id = $(this).attr("id") + "_modal";
      var this_modal = $("#" + modal_id);
      this_modal.addClass('current_modal');
      //var back = $('<div class="modal-backdrop animate" />')
      //.appendTo(document.body)
      this_modal.modal('show');
      });

    $('.prof_modal').bind('hide', function(){
        $('.prof_modal').hide();
        $('.prof_modal').removeClass("current_modal prev_modal next_modal");
        });

    $('.gray_star').click(function(){
        $(this).hide();
        $(this).prev().show();
        return false;
        });

    $('.gold_star').click(function(){
        $(this).hide();
        $(this).next().show();
        return false;
        });

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
);
modal_slide = function(move_direction){
  if(move_direction=="next"){
    var move_string='-50%';
    var div_offset = 1;
    var current_modal_becomes = "prev_modal";
  } else if(move_direction=="prev"){
    var move_string='150%';
    var div_offset = -1;
    var current_modal_becomes = "next_modal";
  } else {
    alert("not a valid direction");
  }
  inner = function() {
    var modal = $(".current_modal");
    var this_id = modal.attr("id");
    var next_id = this_id.replace(/(\d+)/g, function(s){
        return (parseInt(s) + div_offset).toString();
        });
    var next_div = $("#" + next_id);
    next_div.addClass(move_direction + "_modal"); 
    next_div.modal('show');
    modal.switchClass("current_modal", current_modal_becomes,500);
    next_div.switchClass(move_direction+"_modal", "current_modal",500);
  }
  return inner;
};

request_new_checkboxes = function() {
<<<<<<< HEAD
  $.ajax({
url:"filter_options.php",
type:"GET",
dataType: "html",
data: window.location.search.replace('?', ''), 
success : function(data) {
$(document).ready(function() {
  $('span#filter').html(data); 
  $('[type=checkbox]').change(filterCheckChange);
=======
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
>>>>>>> 4023742548928278647280574beaf9e3fe49eb61
  });
},
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
<<<<<<< HEAD
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
=======
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
>>>>>>> 4023742548928278647280574beaf9e3fe49eb61

  $('.gold_star').click(function(){
    $(this).hide();
    $(this).next().show();
    setStar(false, $(this).attr('id'));
    return false;
    });

<<<<<<< HEAD
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
=======
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
>>>>>>> 4023742548928278647280574beaf9e3fe49eb61
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
<<<<<<< HEAD
  new_url = window.location.pathname + '?q=' + getQueryVariable('q') + new_url
    window.history.pushState("object or string", "Title", new_url);
=======
  var query;
  if(getQueryVariable('q')) {
    query = '?q=' + getQueryVariable('q');
  } else {
    query = '?';
    new_url = new_url.substring(1);
  }
  var new_url = window.location.pathname + query + new_url
  window.history.pushState(getState(), "Title", new_url);
>>>>>>> 4023742548928278647280574beaf9e3fe49eb61
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

