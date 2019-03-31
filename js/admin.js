(function ($) {
  $(document).ready(function () {
    const fontUrl = 'https://fonts.googleapis.com/css?family='
    $('#family_name').change(function(){
      const fontName = $(this).val().split(' ').join('+');
      $('#font_family_url').val(fontUrl+fontName);
    })
  });
})(jQuery);
