(function($)
{
  $(function()
  {
    $('.clickable').each(function() {
      $(this).click(function() {
        location.href = $(this).find('a:first').attr('href');
      }).hover(function() {
        $(this).addClass('hover');
      }, function() {
        $(this).removeClass('hover');
      });
    });

    $('span.contact_email').text(['diem', '.proj', 'ect@g', 'mail.', 'com'].join(''));

    if($submitArticleToggler = $('div.community_article_form a.toggler').orNot())
    {
      $form = $submitArticleToggler.parent().find('form');

      $submitArticleToggler.click(function()
      {
        $form.toggle(500);
      });

      if(!$form.find('input.has_error').length)
      {
        $form.hide();
      }
    }

    $('a.js_confirm, input.js_confirm').click(function(e)
    {
      e.stopPropagation();
      if (!confirm(($(this).attr('title') || 'Are you sure') + ' ?'))
      {
        return false;
      }

      return true;
    });

    if($dataTable = $('div.plugin_list table.data_table').orNot())
    {
      $dataTable.dataTable({
        bJQueryUI: true,
        sPaginationType: "full_numbers",
        aaSorting: [ [2, "desc"], [4, "desc"] ]
      });
    }

    if($cloneCommands = $('div.clone_commands').orNot())
    {
      $cloneCommands.hide();
      $('a.toggle_clone_commands').click(function() {
        $cloneCommands.toggle(300);
        return false;
      });
    }

    $('div.plugin_show div.tabs').each(function()
    {
      $(this).tabs({

      });
    });

  });
})(jQuery);