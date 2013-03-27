<?php

/**
 * Description of imgPreview
 *
 * @author Sergei
 */

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class imgPreview extends JnterfaceWidget
{
    //non-required parameters
    public $elementName;        // name of html-elem to apply effect
    public $width = 0;          // if width = 0, real width applied
    public $useFading = true;   // use fading effect
    public $showTitle = false;  // show link text as image caption

    public function init()
    {
        $this->setScriptFiles(array('imgpreview.min.0.22.jquery.js',));
        $scr = "$('";
        if(isset($this->elementName)) $this->elementName .= " a";
            else $this->elementName = "a";
        $scr .=$this->elementName."').imgPreview({
                    containerID: 'imgPreviewWithStyles',";
        if($this->width > 0) $scr .= "imgCSS: { height: ".$this->width." },";
        if($this->useFading || $this->showTitle)
        {
            $this->setCssFiles(array('imgpreview.css'));
            $scr .= "onShow: function(link){";
            if($this->useFading) $scr .="$(link).stop().animate({opacity:0.4}); $('img', this).stop().css({opacity:0});";
            if($this->showTitle) $scr .="$('<span>' + $(link).text() + '</span>').appendTo(this);";
            $scr .=" }, onLoad: function(){ ";
            if($this->useFading) $scr .= "$(this).animate({opacity:1}, 300);";
            $scr .=" }, onHide: function(link){ ";
            if($this->useFading) $scr .="$(link).stop().animate({opacity:1});";
            if($this->showTitle) $scr .="$('span', this).remove();";
            $scr .= " }";
        }
        $scr .= " })";
        $this->setCustomScriptFile($scr, CClientScript::POS_READY);

        $this->publishWidget($this->elementName, 'interface');
    }
}
?>
