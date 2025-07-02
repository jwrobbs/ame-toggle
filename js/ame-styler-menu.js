jQuery(function($) {
    var headers = $('[class$="-ame-styler-header"]');
    var contents = $('[class$="-ame-styler-content"]');

    // Collapse all on load
    contents.hide();

    headers.on('click', function() {
        var $header = $(this);
        // Find the next sibling that is a content section
        var $content = $header.nextAll('[class$="-ame-styler-content"]').first();

        // Accordion: close all others
        contents.not($content).slideUp(200);
        $content.slideToggle(200);
    });
});
