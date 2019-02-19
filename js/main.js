(function ($) {

    $(document).ready(function () {

        var ta = document.querySelector('.gfs_short_p textarea');

        autosize(ta);
        $(ta).attr('rows', '1');
        autosize.update(ta);

        $(document).on('focus', '.gfs_short_p textarea', function () {
            $(this).attr('rows', '1');
            autosize($(this));
        });

        /* - animation*/
        $(document).on('click', '.gform_wrapper input[type="radio"], .gform_wrapper input[type="checkbox"], .gform_wrapper input[type="radio"] + label, .gform_wrapper input[type="checkbox"] + label', function () {
            $(this).parent().addClass('isActive').delay(350).queue(function () {
                $(this).removeClass("isActive").dequeue();
            });
        });

        $('.gform_wrapper .ginput_container_radio input[type="text"]').before("<label class='other-label'></label>");

    });/* end of jQuery document ready */

})(jQuery);
