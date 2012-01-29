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


