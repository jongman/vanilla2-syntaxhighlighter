<?php if(!defined('APPLICATION')) die();

$PluginInfo['SyntaxHighlighter'] = array(
    'Name' => 'SyntaxHighlighter',
    'Description' => 'Enable SyntaxHighlighter syntax highlighter in all pages',
    'Version' => '1.0',
    'Author' => "JongMan Koo",
    'RequiredApplications' => array('Vanilla' => '>=2.0'),
);

class SyntaxHighlighterPlugIn extends Gdn_Plugin {

    protected $Brushes = Array("Python", "Cpp", "Java", "Css");
    public static $PrevFormatter = NULL;

    public function Format($Html) {
        $Html = preg_replace("/\[code ([a-z]+)\](.+)\[\/code\]/U", '<pre class="brush: $1"><code>$2</code></pre>', $Html);
        if(is_null(self::$PrevFormatter)) return Gdn_Format::Display($Html);
        return self::$PrevFormatter->Format($Html);
    }

    protected function InstallFormatter() {
        self::$PrevFormatter = Gdn::Factory("HtmlFormatter");
        Gdn::FactoryInstall("HtmlFormatter", "SyntaxHighlighterPlugIn", __FILE__, Gdn::FactorySingleton);
    }

    public function Base_Render_Before(&$Sender) {

        $Sender->AddJsFile($this->GetResource("vendor" . DS . "scripts" . DS . "shCore.js", FALSE, FALSE));
        $Sender->Head->AddCss($this->GetResource("vendor" . DS . "styles" . DS . "shCore.css", FALSE, FALSE));
        $Sender->Head->AddCss($this->GetResource("vendor" . DS . "styles" . DS . "shThemeDefault.css", FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource("SyntaxHighlighter.js", FALSE, FALSE));
        $Sender->Head->AddCss($this->GetResource("SyntaxHighlighter.css", FALSE, FALSE));

        $this->AddBrushes($Sender, $this->Brushes);
        $this->InstallFormatter();
    }
    protected function AddBrushes(&$Sender, $Languages) {
        foreach($Languages as $Lang) {
            $Sender->AddJsFile($this->GetResource("vendor" . DS . "scripts" .
                DS . "shBrush" . $Lang . ".js", FALSE, FALSE));
        }
    }
    public function Setup() {
    }
}
