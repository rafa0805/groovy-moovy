'use strict';
$(function() {

  $('#new_pad').on('click', 'img', function() {
     $(this).parent().addClass('active');
     $(this).children('input').addClass('active');
     $('#mask').addClass('show');
  });

  $('#mask').on('click', function() {
    if ($('#new_pad').hasClass('active')) {
      $('#new_pad').removeClass('active');
    }
    if ($('#abstract').hasClass('show')) {
      $('#abstract').removeClass('show');
    }
    $('#mask').removeClass('show');
  });

  $('#new_pad').on('click', 'img', function() {
    if ($('#new_pad').children('input').val() !== "") {
      let user_id = $('#user').data('id');
      let title = $('#new_pad').children('input').val();
      $('#new_pad').removeClass('active');
      $('#mask').removeClass('show');
      $('#new_pad').children('input').val('');

      $.post('./app/ajax.php', {
        user_id: user_id,
        title: title,
        mode: 'create_pad',
        token: $('#token').val()
      }).done(function(res) {
        let $ul = $('ul.template').clone();
        let $option = $('<option>').attr('value',res.id).text(res.title);

        $ul.removeClass('template').addClass('todo_list').attr('data-id', res.id);
        $ul.children('p').text(res.title);
        $ul.appendTo('#list_container').hide().fadeIn(200);

        $option.appendTo('#abstract select');

      });
    } else {
      return;
    };
    
  });

  $('#list_container').on('click', '.pad_del', function() {
    let $ul = $(this).parents('.todo_list');
    let pad_id = $ul.data('id');

    $.post('./app/ajax.php', {
      pad_id: pad_id,
      mode: 'delete_pad',
      token: $('#token').val()
    }).done(function(res) {
      $ul.remove();
    });
  });

  $('#list_container').on('click', '.post_new_todo', function() {
    let $ul = $(this).parents('.todo_list');
    let pad_id = $ul.data('id');
    let content = $ul.children('li:last').children('input').val();
    $ul.children('li:last').children('input').val('');

    if (!validate('todo', content)) {
      return;
    }
    
    $.post('./app/ajax.php', {
      pad_id: pad_id,
      content: content,
      mode: 'create_todo',
      token: $('#token').val()
    }).done(function(res) {
      let $li = $('li.template').clone();
      $li.removeClass('template').attr('data-id', res.id);
      $li.children('span').text(res.content);
      $ul.children('li:last').before($li);
    });
  });

  $('#list_container').on('click', '.del', function() {
    let todo_id = $(this).parent().data('id');
    let $li = $(this).parent();

    $.post('./app/ajax.php', {
      todo_id: todo_id,
      mode: 'delete_todo',
      token: $('#token').val()
    }).done(function(res) {
      $li.remove();
    });
  });

  $('#list_container').on('click', '.todo_list input[type=checkbox]', function() {
    let todo_id = $(this).parent().data('id');
    let $li = $(this).parent();

    $.post('./app/ajax.php', {
      todo_id: todo_id,
      mode: 'done_todo',
      token: $('#token').val()
    }).done(function() {
      if($li.children('input').prop('checked')) {
        $li.children('span').addClass('checked');
      } else {
        $li.children('span').removeClass('checked');
      }
    });
  });

  $('#movie_container').on('click', '.poster', function() {
    let url = $(this).attr('src');
    let title = $(this).attr('data-title');
    let release = $(this).attr('data-release');
    let overview = $(this).attr('data-overview');

    $('#mask').addClass('show');
    $('#abstract').find('.thumbnail').attr('src',url);
    $('#abstract').find('.title').text(title);
    $('#abstract').find('.release').text(release);
    $('#abstract').find('.overview').text(overview);
    $('#abstract').addClass('show');
  });

  $('#abstract').on('click', '.exit', function() {
    $('#mask').removeClass('show');
    $('#abstract').find('.title').text('');
    $('#abstract').find('.release').text('');
    $('#abstract').find('.overview').text('');
    $('#abstract').removeClass('show');
  });

  $('#abstract').on('click', '.add_to_list', function() {

    let pad_id = $('#abstract').find('select').val();
    let content = $('#abstract').find('.title').text();
    $('.add_to_list p').removeClass('d-none').fadeOut(700, function() {
      $('.add_to_list p').addClass('d-none').fadeIn(1);
    });
    
    $.post('./app/ajax.php', {
      pad_id: pad_id,
      content: content,
      mode: 'create_todo',
      token: $('#token').val()
    }).done(function(res) {
      let $li = $('li.template').clone();
      $li.removeClass('template').attr('data-id', res.id);
      $li.children('span').text(res.content);
      $('#list_container').find(`.todo_list[data-id=${pad_id}]`).children('li:has("button")').before($li);
    });
  });

  $('#find-movie').on('click', function() {
    if (!$('#movie_container').hasClass('show')) {
      $('#movie_container').addClass('show');
    } else {
      $('#movie_container').removeClass('show');
    }
  });

  $(window).on('resize', function() {
    if ($(window).width() > 768) {
      if ($('#movie_container').hasClass('show')) {
        $('#movie_container').removeClass('show');
      } else {
        return;
      }
    }
  });

  function validate(param, value) {
    switch (param) {
      case 'todo':
        return value.match(/.+/);
    }
    
  }
  
});


