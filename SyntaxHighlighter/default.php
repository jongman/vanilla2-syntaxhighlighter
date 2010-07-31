<?php if(!defined('APPLICATION')) die();

$PluginInfo['SyntaxHighlighter'] = array(
    'Name' => 'SyntaxHighlighter',
    'Description' => 'Enable SyntaxHighlighter syntax highlighter in all pages',
    'Version' => '1.0',
    'Author' => "JongMan Koo",
    'RequiredApplications' => array('Vanilla' => '>=2.0'),
);

class SyntaxHighlighterPlugIn extends Gdn_Plugin {

    public function Base_Render_Before(&$Sender) {
        $Sender->AddJsFile($this->GetResource("vendor" . DS . "scripts" . DS . "shCore.js",
            FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource("vendor" . DS . "scripts" . DS . "shAutoLoader.js",
            FALSE, FALSE));

        $Sender->Head->AddCss($this->GetResource("vendor" . DS . "styles" . DS . "shCore.css",
            FALSE, FALSE));
        $Sender->Head->AddCss($this->GetResource("vendor" . DS . "styles" . DS . "shThemeDefault.css",
            FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource("SyntaxHighlighter.js", FALSE, FALSE));
        $Sender->Head->AddCss($this->GetResource("SyntaxHighlighter.css", FALSE, FALSE));
        $this->AddBrushes(Array("Python", "Cpp", "Java"), $Sender);
    }
    protected function AddBrushes($Languages, &$Sender) {
        foreach($Languages as $Lang) {
            $Sender->AddJsFile($this->GetResource("vendor" . DS . "scripts" .
                DS . "shBrush" . $Lang . ".js", FALSE, FALSE));
        }
    }
    public function Setup() {
    }
}
