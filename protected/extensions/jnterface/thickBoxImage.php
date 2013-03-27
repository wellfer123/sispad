<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class thickBoxImage extends JnterfaceWidget
{
    public $imageName;
    public $title = '';
    public $reduction = "50%";

    public function init()
    {
        $this->setViewName('thickBoxImage');
        $this->imageName = $this->normalizeUrl($this->imageName);
        $this->forcePublished();
    }
}
?>
