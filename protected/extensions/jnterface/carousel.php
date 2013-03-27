<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');
class carousel extends JnterfaceWidget
{
    public $name;
    public $items = array();
    public $useThickBox = true;
    public $itemWidth = 100;
    public $itemHeight = 60;
    public $itemMinWidth = 45;
    public $rotationSpeed = 1.8;
    public $reflections = 0.5;
    public $slowOnHover = 'false';
    public $slowOnOut = 'false';

    public function init()
    {
        $this->setScriptFiles(array('interface.js'));
        $this->setCssFiles(array('carousel.css'));
        $this->setCustomScriptFile(
                    "$('#".$this->name."').Carousel(
			{
				itemWidth: ".$this->itemWidth.",
				itemHeight: ".$this->itemHeight.",
				itemMinWidth: ".$this->itemMinWidth.",
				items: 'a',
				reflections: ".$this->reflections.",
                                slowOnHover:  ".$this->slowOnHover.",
                                slowOnOut:  ".$this->slowOnOut.",
                                rotationSpeed: ".$this->rotationSpeed."
			})", CClientScript::POS_LOAD);
        $this->setViewName('carousel');
        $this->items = $this->normalizeUrl($this->items, 'link');
        $this->items = $this->normalizeUrl($this->items, 'image');
        $this->publishWidget($this->name, 'interface');
    }
}
?>
