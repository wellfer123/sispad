<?php
//include_once '../modules/rbac/models/User.php';

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

        private $_id;
        
        public function authenticate(){
            
            //pega o usuário no banco
            $record=User::model()->with('servidor')->findByAttributes(array('username'=>$this->username));
            if($record===null)
                //usuário não existe
                $this->errorCode=self::ERROR_USERNAME_INVALID;
                //compara as senhas
            else if(!($record->password===md5($this->password)))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else if($record->ativo!=1)
                $this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
            else
            {
                //está logado com sucesso
                $this->_id=$record->id;
                $this->setState('cpfservidor', $record->servidor->cpf);
                $this->errorCode=self::ERROR_NONE;
            }
        return !$this->errorCode;
        }
 
        public function getId()
        {
            return $this->_id;
        }
}