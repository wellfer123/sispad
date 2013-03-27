<?php
/**
 * Description of popeye
 *
 * @author Sergei
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class popeye extends JnterfaceWidget
{
    // name for html-elem
    public $name = 'popeye';
    // path to images - REQUIRED!!!
    public $imageDir;
    // override width of compact image stage (e.g. '200px')
    public $stageW = "240px";
    // override height of compact image stage (e.g. '200px')
    public $stageH = "200px";
    // direction that popeye-box opens, can be 'left' or 'right'
    public $direction = 'left';
    // duration of transitional effect when enlarging or closing the box
    public $duration = 300;
    // easing type, can be 'swing', 'linear'
    public $easing = 'linear';
    // label for next button
    public $nlabel = 'next';
    // label for previous button
    public $plabel = 'previous';
    // label for image count text (e.g. 1 of 14)
    public $oflabel = 'of';
    // label for enlarge button
    public $blabel = 'enlarge';
    // tooltip on enlarged image (click image to close)
    public $clabel = 'Click to close';

    public function init()
    {
        $this->setScriptFiles(array('jquery.popeye-0.2.1.js',));
        $this->setCssFiles(array('jquery.popeye.css', 'styling.css'));
        $options = "direction: '".$this->direction."', ";
        $options .= "stageW: '".$this->stageW."', ";
        $options .= "stageH: '".$this->stageH."', ";
        $options .= "duration: ".$this->duration.", ";
        $options .= "easing: '".$this->easing."', ";
        $options .= "nlabel: '".$this->nlabel."', ";
        $options .= "plabel: '".$this->plabel."', ";
        $options .= "oflabel: '".$this->oflabel."', ";
        $options .= "blabel: '".$this->blabel."', ";
        $options .= "clabel: '".$this->clabel."'";
        $this->setCustomScriptFile("$('#".$this->name."').popeye({".$options."})",
                        CClientScript::POS_READY);

        $this->setViewName('popeye');
        $this->setViewData($this->makeGallery());
        $this->imageDir = $this->normalizeUrl($this->imageDir);
        $this->publishWidget($this->name, 'popeye');
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
