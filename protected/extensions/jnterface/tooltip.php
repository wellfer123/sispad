<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class tooltip extends JnterfaceWidget
{
    // html-elem class 
    public $className = 'a';
    //css class for this tooltip
    public $cssName = 'linksTooltip';
    //tooltip position: top|left|bottom|right|mouse
    public $position = 'mouse';

    public function init()
    {
        $this->setScriptFiles(array('interface.js'));
        $this->setCssFiles(array('tooltip.css'));
        $this->setCustomScriptFile(
                "$('".$this->className."').ToolTip(
                     {
                        className: '".$this->cssName."',
                        position: '".$this->position."',
                     })", CClientScript::POS_READY);
        $this->publishWidget($this->className, 'interface');
    }
}
?>
