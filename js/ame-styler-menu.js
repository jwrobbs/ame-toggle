jQuery(function($) {
    var headers = $('[class$="-ame-styler-header"]');
    var contents = $('[class$="-ame-styler-content"]');

    // Collapse all on load
    contents.hide();

    headers.on('click', function() {
        var $header = $(this);
        var headerClass = $header.attr('class').split(' ').find(function(c) {
            return c.endsWith('-ame-styler-header');
        });
        var contentClass = headerClass.replace('-header', '-content');
        var $content = $('.' + contentClass);

        // Accordion: close all others
        contents.not($content).slideUp(200);
        $content.slideToggle(200);
    });
});
