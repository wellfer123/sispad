<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autenticacao
 *
 * @author Albuquerque
 */
class Autenticacao {
    //put your code here
    
    /**
     * Faz autenticação usando o protocollo http
     * com os dados do banco.
     * @return string token
     */
    public function loginViaHttp(){
        $usuario = $this->getAuthUser();
        $senha = $this->getAuthPassword();
        //verifica se existem valores e não são vazios
        if ( ($usuario != null ? !empty($usuario): false) && ($senha != null ? !empty($senha) : false) ){
            Yii::log("if 1 ");
            $user=User::model()->find("username=:user and password=:senha", array(':user'=>$usuario,':senha'=> md5($senha)));
            
            if($user != null){
                Yii::log("if 2 ");
                //gera o token
                $token=md5($user->id.$user->username.$user->servidor_cpf);
                $logged= UserLogado::model()->find('token=:token',array(':token'=>$token));
                //o usuário não está loggado
                if($logged == null){
                    Yii::log("if 3 ");
                    $user_logged=new UserLogado();
                    
                    $user_logged->user_username=$user->username;
                    $user_logged->user_id=$user->id;
                    $user_logged->token=$token;
                    //loga o usuário
                    if ($user_logged->save()){
                        Yii::log("if 4 ");
                        return $token;
                    }//fim do if
                }//fim 
                else{
                    //verifica se o token ainda é válido
                    Yii::log("if 5 ");
                    if ( !$user_logged->isValideToken()){
                        $user_logged=new UserLogado();
                    Yii::log("if 6 ");
                        $user_logged->user_username=$user->username;
                        $user_logged->user_id=$user->id;
                        $user_logged->token=$token;
                        //loga o usuário
                        if ($user_logged->save()){
                        
                            return $token;
                        }//fim do if
                    }//fim do fi
                }//fim do else
            }//fim do if
        }//fim do if
        return null;
    }
    public function getAuthUser(){
       return $_SERVER['PHP_AUTH_USER'] ;
    }
    
    public function getAuthPassword(){
       return $_SERVER['PHP_AUTH_PW'];
    }

    /**
     * @param string $usuario
     * @return boolean se e somente se o token é válido e o usuário está logado via http 
     */
    public function isLogged($usuario){
        
        
    }
    
    /**
     * Realiza o logout do usuário via http
     * @param string $token 
     */
    public function logout($usuario){
        
    }
}

?>
