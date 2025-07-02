jQuery(function($) {
    var headers = $('#adminmenu li[class*="-ame-styler-header"]');
    var contents = $('#adminmenu li[class*="-ame-styler-content"]');

    // Collapse all on load
    contents.hide();

    headers.on('click', function() {
        var $header = $(this);
        var $content = $header.nextAll('li[class*="-ame-styler-content"]').first();

        // Accordion: close all others
        contents.not($content).slideUp(200);
        $content.slideToggle(200);
    });
});
