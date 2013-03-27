<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class accordion extends JnterfaceWidget
{
    public $name;
    public $panels = array();

    public $headerSelector = 'dt';
    public $panelSelector = 'dd';
    public $activeClass = 'myAccordionActive';
    public $hoverClass = 'myAccordionHover';
    public $panelHeight = 200;
    public $speed = 300;

    public function init()
    {
        $this->setScriptFiles(array('interface.js'));
        $this->setCssFiles(array('accordion.css'));
        $this->setCustomScriptFile("$('#".$this->name."').Accordion({
                                        headerSelector: '".$this->headerSelector."',
                                        panelSelector: '".$this->panelSelector."',
                                        activeClass: '".$this->activeClass."',
                                        hoverClass: '".$this->hoverClass."',
                                        panelHeight: ".$this->panelHeight.",
                                        speed: ".$this->speed."
                                        })",
                        CClientScript::POS_READY);

        $this->setViewName('accordion');
        $this->setViewData($this->panels);
        $this->publishWidget($this->name, 'interface');
    }
}
?>
