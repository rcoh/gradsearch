$(window).bind("popstate", function(event) {
    numProfs = 0; //RESET
    request_new_checkboxes();
    reloadProfessors();
    });
$(document).ready(function() {

    $(document).bind('keyup', function ( e ) {
      if ( e.which == 37 ) {
      modal_slide_prev();
      }
      else if ( e.which == 39 ) {
      modal_slide_next();
      }
      else if (e.which == 27 ) {
      hide_modals();
      }
      });

    $(".prof_modal_next").live("click", modal_slide_next);
    $(".prof_modal_prev").live("click", modal_slide_prev);

    $(".prof_box").click(prof_box_click);
    $('.prof_modal').bind('hide', hide_modals);

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
    $("li#starred").click(function() {
        window.history.pushState("some data", "Title", window.location.pathname + '?starred=true');
        numProfs = 0; //RESET
        reloadProfessors();
        request_new_checkboxes();
        });
});

display_modal = function(this_modal_id, prof_id, css_classes, callback){
  var modal = $("#m"+this_modal_id);
  if (modal.length == 0){
    $.ajax({
    url:"prof_modal.php",
    type:"GET",
    dataType: "html",
    data: {'id':prof_id, 'modal_id':this_modal_id, 'classes':css_classes}, 
    success : function(result) {
      $(document.body).append(result);
      modal = $("#m"+this_modal_id);
         $('#gray' + prof_id).click(function(){
        $(this).hide();
        $(this).prev().show();
        setStar(true, $(this).attr('id').substring(4));
        return false;
        });

      $('#gold' + prof_id).click(function(){
        $(this).hide();
        $(this).next().show();
        setStar(false, $(this).attr('id').substring(4));
        return false;
        });
    modal.modal('show');
    },
    error : function(result) {
      alert('modal failed to load');
    },
    complete : callback
    });
  }
  else{
    modal.addClass(css_classes);
    modal.modal('show');
    if (callback){
    callback();
    }
  }
}

prof_box_click = function(){
  hide_modals();
  var modal_id = $(this).attr("id");
  var next_num = modal_id.replace(/(\d+)/g, function(s){
      return (parseInt(s) + 1).toString();
      });
  var prev_num = modal_id.replace(/(\d+)/g, function(s){
      return (parseInt(s) -1).toString();
      });
  var this_prof_id = $("#"+modal_id).attr("prof_id");
  var next_prof_id = $("#"+next_num).attr("prof_id");
  var prev_prof_id = $("#"+prev_num).attr("prof_id");
  $('<div class="modal-backdrop animate" />').appendTo(document.body)
  display_modal(modal_id, this_prof_id, 'current_modal fade'); 
  display_modal(next_num, next_prof_id, 'next_modal fade');
  display_modal(prev_num, prev_prof_id, 'prev_modal fade');
}
modal_slide_next = function(){
  var move_string='-50%';
  var modal = $(".current_modal");
  var next_modal = $(".next_modal");
  var prev_modal = $(".prev_modal");
  var this_id = modal.attr("id");
  var incoming_id = this_id.replace(/(\d+)/g, function(s){
      return (parseInt(s) + 2).toString();
      });
  var incoming_num = incoming_id.substring(1);
  var prof_id = $("#"+incoming_num).attr("prof_id");
  display_modal(incoming_num, prof_id, 'right_modal', function(){ 
  var incoming_modal = $("#" + incoming_id);
  prev_modal.switchClass("prev_modal", "left_modal", 350);
  modal.switchClass("current_modal", "prev_modal", 350);
  next_modal.switchClass("next_modal", "current_modal", 350);
  incoming_modal.switchClass("right_modal", "next_modal", 350);
  });
};

modal_slide_prev = function(){
  var move_string='150%';
  var modal = $(".current_modal");
  var next_modal = $(".next_modal");
  var prev_modal = $(".prev_modal");
  var this_id = modal.attr("id");
  var incoming_id = this_id.replace(/(\d+)/g, function(s){
      return (parseInt(s) - 2).toString();
      });
  var incoming_num = incoming_id.substring(1);
  var prof_id = $("#"+incoming_num).attr("prof_id");
  display_modal(incoming_num, prof_id, 'left_modal', function(){ 
  var incoming_modal = $("#" + incoming_id);
  next_modal.switchClass("next_modal","right_modal",350);
  modal.switchClass("current_modal", "next_modal", 350);
  prev_modal.switchClass("prev_modal", "current_modal",350);
  incoming_modal.switchClass("left_modal", "prev_modal", 350);
  });
};

hide_modals = function(){
  $('.prof_modal').hide();
  $('.modal-backdrop').remove();
  $('.prof_modal').removeClass("current_modal prev_modal next_modal right_modal left_modal fade in");
  $('.modal-header').show();
}
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
      $('a.clearall').click(uncheckButton);
  });
}
reloadProfessors = function() {
  $.ajax({
url:"get_professors.php",
type:"GET",
dataType: "json",
data: window.location.search.replace('?', '') + '&start=' + numProfs + '&limit=' + rowLimit, 
success : loadNewProfData  
});
}

numProfs = 0;
rowLimit = 50;
blockLoading = false;
loadNewProfData = function(data) {
  $(document).ready(function() {
      blockLoading = true;
      if(numProfs == 0) {
      $('.prof_grid').html(data['html']);
      } else {
      $('.prof_grid').append(data['html']);
      }
      numProfs += data['num_returned'];
      $('span#search_description').html(data['description']);
      $('.gray_star').click(function(){
        $(this).hide();
        $(this).prev().show();
        if($(this).hasClass('search_star')) {
          searchStar(true);
        } else {
          setStar(true, $(this).attr('id'));
        }
          return false;
        });

      $('.gold_star').click(function(){
        $(this).hide();
        $(this).next().show();
        if($(this).hasClass('search_star')) {
          searchStar(false);
        } else {
          setStar(false, $(this).attr('id'));
        }
        return false;
      });

      if(data['num_returned'] == rowLimit) {
        blockLoading = false;
      }

      $(".prof_box").click(prof_box_click);
  });
      $(window).scroll(function() {
        if($(window).scrollTop()+$(window).height() + 300 > $('.prof_content').height()) {
          if(!blockLoading) {
            blockLoading = true;
            reloadProfessors();
          }
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
    'id' : id,
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

searchStar = function(state) { 
  $.ajax({
      url:"star_search.php",
      type: "POST",
      dataType: "json",
      data: {
      'state': state,
      'url' : window.location.search,
      'desc' : $('span#search_description').html(), 
      },
  success : function(data) {
      //TODO: we should probably do something
  },
  error : function(data) {
      //somethign here?
  }
});
}

uncheckButton = function() {
  uncheckCategory($(this).attr('id'));
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
  numProfs = 0; //RESET
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
    grid: {description: $('span#search_description').html(), 
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

