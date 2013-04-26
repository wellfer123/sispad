<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegionaisController
 *
 * @author Albuquerque
 */
class RegionaisController extends SISPADBaseController {

    //put your code here
    public function accessRules() {
        return array(
        );
    }

    protected function getModelName() {
        return 'Regional';
    }

}

?>
