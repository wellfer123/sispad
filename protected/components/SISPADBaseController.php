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

abstract class SISPADBaseController extends Controller{
    
        
    //put your code here
    
    //gerencia as permissões
    protected $_RBAC;
    
    //arreio para mensagens
    private $messageErrors=array();
    private $messageWarnings=array();
    private $messageInfos=array();
    private $messageSuccess=array();
    
        
        public function __construct($id, $module = null) {
            $this->_RBAC= new RBACAccessVerifier();
            parent::__construct($id, $module);
        }
     
     public function renderMessages()
	{
		if(count($this->messageErrors))
			$this->renderPartial('/messages/_formErrors', array('messageErrors'=>$this->messageErrors));
		if(count($this->messageWarnings))
			$this->renderPartial('/messages/_formWarnings', array('messageWarnings'=>$this->messageWarnings));
		if(count($this->messageInfos))
			$this->renderPartial('/messages/_formInfos', array('messageInfos'=>$this->messageInfos));
		if(count($this->messageSuccess))
			$this->renderPartial('/messages/_formSuccess', array('messageSuccess'=>$this->messageSuccess));
	}
        
        
     protected function addMessageErro($message){
         $this->messageErrors[]=$message;
     }
     
     protected function addMessageWarning($message){
         $this->messageWarnings[]=$message;
     }
     
     protected function addMessageInfo($message){
         $this->messageInfos[]=$message;
     }
     
     protected function addMessageSuccess($message){
         $this->messageSuccess[]=$message;
     }
     
     /**
	 * Deve retornar o nome a ser utilizado no método factoryActionName().
	 */
     protected abstract function getModelName();
     
     /**
	 * Devolve o noma da action mais o modelo para verificar o acesso.
	 * Segue o seguinte padrão: id da action +  o nome fornecido pelo método getModelName()
	 */
     protected function factoryActionName(){
         //$this->get
         return $this->getAction()->getId().$this->getModelName();
     }
     
     /**
	 * Verifica o acesso a action usando o métod factoryActionName().
	 */
     protected function CheckAcessAction(){
         $this->_RBAC->checkAccess($this->factoryActionName(),true);
     }
}

?>
