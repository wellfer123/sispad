<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'JnterfaceWidget.php');

class datepicker extends JnterfaceWidget
{
    // html-elem name
    public $name;

    // date format
    public $format = 'd/m/Y';

    //['top'|'left'|'right'|'bottom']
    //Date picker's position relative to the trigegr element
    //(non flat mode only).
    public $position = 'bottom';
    
    //Number of calendars to render inside the date picker.
    public $calendars = 1;

    //The day week start. Default 1 (monday)
    public $starts = 1;
    
    public function init()
    {
        $this->setScriptFiles(array('datepicker.js',));
        $this->setCssFiles(array('datepicker.css'));
        $this->setCustomScriptFile(
                    "$('#".$this->name."').DatePicker({
                            format:'".$this->format."',
                            date: $('#".$this->name."').val(),
                            current: $('#".$this->name."').val(),
                            position: '".$this->position."',
                            calendars: ".$this->calendars.",
                            starts: ".$this->starts.",
                            onBeforeShow: function(){
                                    $('#".$this->name."').DatePickerSetDate($('#".$this->name."').val(), true);
                            },
                            onChange: function(formated, dates){
                                    $('#".$this->name."').val(formated);
                            }
                    })", CClientScript::POS_READY);
        //$this->setViewName('datepicker');
        $this->publishWidget($this->name, 'datepicker');
    }
}
?>
