$(function() {
    $("pre").each(function() {
        if($(this).hasClass("brush:")) {
            //$(this).children("br").replaceWith("\n");
            var $this = $(this);
            var $code = $this.children("code");
            $code.children("br").replaceWith("\n");
            $this.text($code.text());
        }
    });
    SyntaxHighlighter.all();
});
