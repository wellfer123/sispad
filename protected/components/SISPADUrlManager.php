<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SISPADUrlManager
 *
 * @author César Albuquerque
 */
class SISPADUrlManager extends CUrlManager {
	public function parsePathInfo($pathInfo) {
		$get = $_GET;
		$request = $_REQUEST;
		parent::parsePathInfo($pathInfo);
		$_GET = CMap::mergeArray($_GET, $get);
		$_REQUEST = CMap::mergeArray($_REQUEST, $request);
	}
}

?>
