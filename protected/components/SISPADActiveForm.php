<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SISPADActiveForm
 *
 * @author Albuquerque
 */
class SISPADActiveForm extends CActiveForm{
    //put your code here
    
    public $uniform = array();
 
    public function init()
    {
        $this->widget('ext.pixelmatrix.EUniform', $this->uniform);
        parent::init();
    }
}

?>
