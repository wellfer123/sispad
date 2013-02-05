<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SISPADBaseController
 *
 * @author Albuquerque
 */
Yii::import('application.modules.rbac.components.*');

abstract class SISPADBaseController extends Controller {

    //put your code here
    //gerencia as permissões
    protected $_RBAC;
    //arreio para mensagens
    private $messageErrors = array();
    private $messageWarnings = array();
    private $messageInfos = array();
    private $messageSuccess = array();

    public function __construct($id, $module = null) {
        $this->_RBAC = new RBACAccessVerifier();
        parent::__construct($id, $module);
    }

    public function renderMessages() {
        if (count($this->messageErrors))
            $this->renderPartial('/messages/_formErrors', array('messageErrors' => $this->messageErrors));
        if (count($this->messageWarnings))
            $this->renderPartial('/messages/_formWarnings', array('messageWarnings' => $this->messageWarnings));
        if (count($this->messageInfos))
            $this->renderPartial('/messages/_formInfos', array('messageInfos' => $this->messageInfos));
        if (count($this->messageSuccess))
            $this->renderPartial('/messages/_formSuccess', array('messageSuccess' => $this->messageSuccess));
    }

    protected function addMessageErro($message) {
        $this->messageErrors[] = $message;
    }

    protected function addMessageWarning($message) {
        $this->messageWarnings[] = $message;
    }

    protected function addMessageInfo($message) {
        $this->messageInfos[] = $message;
    }

    protected function addMessageSuccess($message) {
        $this->messageSuccess[] = $message;
    }

    /**
     * Deve retornar o nome a ser utilizado no método factoryActionName().
     */
    protected abstract function getModelName();

    /**
     * Devolve o noma da action mais o modelo para verificar o acesso.
     * Segue o seguinte padrão: id da action +  o nome fornecido pelo método getModelName()
     */
    protected function factoryActionName() {
        //$this->get
        return $this->getAction()->getId() . $this->getModelName();
    }

    /**
     * Verifica o acesso a action usando o métod factoryActionName().
     */
    protected function CheckAcessAction() {
        $this->_RBAC->checkAccess($this->factoryActionName(), true);
    }

    protected function _sendResponse($status = 200, $body = '', $content_type = 'text/html') {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
                <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                </head>
                <body>
                    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                    <p>' . $message . '</p>
                    <hr />
                    <address>' . $signature . '</address>
                </body>
                </html>';

            echo $body;
        }
        Yii::app()->end();
    }

    protected function _getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}

?>
