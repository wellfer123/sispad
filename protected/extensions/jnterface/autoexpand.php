<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class autoexpand extends JnterfaceWidget
{
    // html elem name
    public $name;
    // the limit in pixels. if it is array the first index defines the width and the second the height.
    public $wlimit = 100;
    public $hlimit = 0;

    public function init()
    {
        $this->setScriptFiles(array('interface.js'));
        $str = ($this->hlimit > 0) ? "[".$this->wlimit.",".$this->hlimit."]" : $this->wlimit;
        $this->setCustomScriptFile("$('#".$this->name."').Autoexpand(".$str.")", CClientScript::POS_READY);
        $this->publishWidget($this->name, 'interface');
    }
}
?>
