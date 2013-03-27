<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class thickBoxGallery extends JnterfaceWidget
{
    public $imageDir;
    public $name;
    public $reduction = "40%";

    public function init()
    {
        $this->setViewName('thickBoxGallery');
        $this->setViewData($this->makeGallery());
        $this->imageDir = $this->normalizeUrl($this->imageDir);
        $this->forcePublished();
    }

    private function makeGallery()
    {
        $fileArray = array();
        if(!isset($this->imageDir)) throw new CHttpException(500,'Path to images must be set!');
        if ($handle = opendir($this->imageDir))
        {
            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != "..")
                {
                    $fileArray[] = $file;
                }
            }
            closedir($handle);
        }
        return array('images'=>$fileArray);
    }
}
?>
