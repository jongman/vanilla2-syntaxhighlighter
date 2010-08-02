$(function() {
    $("code").each(function() {
        var $this = $(this);
        var $lang = $this.attr("lang");
        if($lang !== undefined && $lang != "") {
            $this.children("br").each(function() { $(this).replaceWith("\n"); });
            var raw = $this.html();
            var lang = $this.attr("lang");
            $this.replaceWith('<pre class="brush: ' + lang + '">' + raw + '</pre>');
        }
    });
    SyntaxHighlighter.all();
});
