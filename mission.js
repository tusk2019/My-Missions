$(function() {
  'use strict';

  $('#new_mission').focus();

  // update
  $('#missions').on('click', '.update_mission', function() {
    // idを取得
    var id = $(this).parents('li').data('id');
    // ajax処理
    $.post('_ajax.php', {
      id: id,
      mode: 'update',
      token: $('#token').val()
    }, function(res) {
      if (res.state === '1') {
        $('#mission_' + id).find('.mission_title').addClass('accomplished');
      } else {
        $('#mission_' + id).find('.mission_title').removeClass('accomplished');
      }
    })
  });

   // delete
   $('#missions').on('click', '.delete_mission', function() {
    // idを取得
    var id = $(this).parents('li').data('id');
    // ajax処理
    if (confirm('Are you sure?')) {
      $.post('_ajax.php', {
        id: id,
        mode: 'delete',
        token: $('#token').val()
      }, function() {
        $('#mission_' + id).fadeOut(800);
      });
    }
  });

  // create
  $('#new_mission_form').on('submit', function() {
    // titleを取得
    var title = $('#new_mission').val();
    // ajax処理
    
    $.post('_ajax.php', {
      title: title,
      mode: 'create',
      token: $('#token').val()
    }, function(res) {
     // liを追加
     var $li = $('#mission_template').clone();
     $li
        .attr('id', 'mission_' + res.id)
        .data('id', res.id)
        .find('.mission_title').text(title);
        $('#missions').prepend($li.fadeIn());
      $('#new_mission').val('').focus();
    }); 
    return false;
  }); 

});