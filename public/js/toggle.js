    $('.checkboxtoggle').bootstrapToggle({
      on: 'SI',
      off: 'NO'
    });
    $('.checkboxtoggle').change(function() {
        cb = $(this);
        cb.val(cb.prop('checked') ? 1 : 0 );
    })    
