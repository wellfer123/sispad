<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class thickBox extends JnterfaceWidget
{
    public function init()
    {
        $this->setScriptFiles(array('thickbox-compressed.js',));
        $this->setCssFiles(array('thickbox.css'));
        $this->publishWidget('thickBox', 'thickBox');
    }
}
?>
