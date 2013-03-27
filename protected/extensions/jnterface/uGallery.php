<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class uGallery extends JnterfaceWidget
{
    public $imageDir;

    public $width = 420;
    public $height = 310;
    public $thumbWidth = 80;
    public $thumbHeight = 50;
    public $displayAlt = false;
    public $thumbOpacity = 0.5;
    public $thumbHoverOpacity = 1;


    public function init()
    {
           $options = 'width: '.$this->width.',
                       height: '.$this->height.',
                       thumbWidth: '.$this->thumbWidth.',
                       thumbHeight: '.$this->thumbHeight.',
                       thumbOpacity: '.$this->thumbOpacity.',
                       thumbHoverOpacity: '.$this->thumbHoverOpacity.',
                       displayAlt: '.(int)$this->displayAlt.'';
        $this->setScriptFiles(array('uGallery.js',));
        //$this->setCssFiles(array('style.css'));
        $this->setCustomScriptFile('$(function($){$.uGallery({'.$options.'});});', CClientScript::POS_HEAD);
        $this->setViewName('ugallery');
        $this->setViewData($this->makeGallery());
        $this->imageDir = $this->normalizeUrl($this->imageDir);
        $this->publishWidget('uGallery', 'uGallery');
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
