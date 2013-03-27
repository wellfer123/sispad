<?php

/**
 * Description of fisheye
 *
 * @author Sergei
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class fisheye extends JnterfaceWidget
{
    public $name;
    // menu array: ('link'=>link, 'image'=>image, 'title'=>menu caption)
    public $menu = array();
    public $maxWidth = 70;
    public $itemWidth = 30;
    public $hAlign = 'center';
    public $proximity = 90;

    public function init()
    {
        $this->setScriptFiles(array('interface.js',));
        $this->setCssFiles(array('fisheye.css'));
        $this->setCustomScriptFile("$('#".$this->name."').Fisheye(
                                {
                                    maxWidth: ".$this->maxWidth.",
                                    items: 'a',
                                    itemsText: 'span',
                                    container: '.fisheyeContainter',
                                    itemWidth: ".$this->itemWidth.",
                                    proximity: ".$this->proximity.",
                                    halign : '".$this->hAlign."'
                                })",
                        CClientScript::POS_READY);

        $this->setViewName('fisheye');
        $this->setViewData($this->menu);
        $this->menu = $this->normalizeUrl($this->menu, 'link');
        $this->menu = $this->normalizeUrl($this->menu, 'image');
        $this->publishWidget($this->name, 'interface');
    }
}
?>
