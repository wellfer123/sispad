<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class slideshow extends JnterfaceWidget
{
                // REQUIRED
    //the HTML element's id that will contain the slideshow
    public $container;
    //an array of objects with 'src' and 'caption' for each image
    public $images = array();

                // OPTIONAL
    //the path to a image used as a preloader indicator
    public $loader = '../images/loading.gif';
    //the fade duration in miliseconds
    public $fadeDuration = 400;
    //the place for navigation links container - sting('top' or 'bottom')
    public $linksPosition = 'top';
    //links separator
    public $linksSeparator = ' | ';
    //the place for caption container - sting('top' or 'bottom')
    public $captionPosition = 'bottom';
    //if this is set the slideshow will autoplay slides with a pause in seconds defined by this option
    public $autoplay = 5;
    //random show images
    public $random = 'true';

                // DIV
    public $width = '300px';
    public $height = '300px';
    
                // CSS
    //the CSS class aplied to navigation links container
    public $linksClass = 'pagelinks';
    //active link CSS class name
    public $activeLinkClass = 'activeSlide';
    //CSS class aplied to next slide link
    public $nextslideClass = 'nextSlide';
    //CSS class aplied to prev slide link
    public $prevslideClass = 'prevSlide';
    //the CSS class aplied to caption container
    public $captionClass = 'slideCaption';

    public function init()
    {
        $this->setScriptFiles(array('interface.js'));
        $this->setCssFiles(array('slideshow.css'));
        $this->setCustomScriptFile(
            "$.slideshow(
	      {
		container : '".$this->container."',
		loader: '".$this->loader."',
		linksPosition: '".$this->linksPosition."',
		linksClass: '".$this->linksClass."',
		linksSeparator : '".$this->linksSeparator."',
		fadeDuration : ".$this->fadeDuration.",
		activeLinkClass: '".$this->activeLinkClass."',
		nextslideClass: '".$this->nextslideClass."',
		prevslideClass: '".$this->prevslideClass."',
		captionPosition: '".$this->captionPosition."',
		captionClass: '".$this->captionClass."',
		autoplay: ".$this->autoplay.",
		random: ".$this->random.",
                images : [ ".$this->makeImagesArray()."
                ]
            })", CClientScript::POS_READY);
        $this->setViewName('slideshow');
        $this->publishWidget($this->container, 'interface');
    }

    private function makeImagesArray()
    {
        $str = null;
        foreach($this->images as $img)
        {
            if(isset($str)) $str .= ', ';
           $str .= "
                    {
			src: '".$this->normalizeUrl($img['src'])."',
		        caption: '".$img['caption']."'
		    }";
        }
        return $str;
    }
}
?>
