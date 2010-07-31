$(function() {
    $("code").each(function() {
    var $this = $(this);
        if($this.attr("lang") !== undefined) {
            $this.children("br").replaceWith("\n");
            var raw = $this.html();
            var lang = $this.attr("lang");
            $this.replaceWith('<pre class="brush: ' + lang + '">' + raw + '</pre>');
        }
    });
    SyntaxHighlighter.all();
});
