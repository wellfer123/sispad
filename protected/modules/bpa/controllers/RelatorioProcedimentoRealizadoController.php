<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RelatorioProcedimentoRealizado
 *
 * @author Albuquerque
 */
class RelatorioProcedimentoRealizadoController extends SISPADBaseController{
    
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    
    //put your code here
    protected function getModelName() {
        
    }
    
    public function actionBuscar(){
        $model= new RelatorioProcedimentoRealizado;
        
        
        if(isset($_POST['RelatorioProcedimentoRealizado'])){
            //busca o usuário logado
            $user=User::model()->find('username=:username',array(':username'=>Yii::app()->user->name));
            if ($user != null){
                $model->user=$user->username;
                $model->password=$user->password;
            }
            $model->attributes=$_POST['RelatorioProcedimentoRealizado'];
            if($model->validate()){  
                //monta os parâmetros
                $parametros=null;
                $contador=0;
                foreach ($model->getAttributes() as $key=>$value){
                    //verifica se o atributo está preenchido
                    //e se está mapeado
                    if (!empty ($value) && isset(RelatorioProcedimentoRealizado::$DE_ATRIBUTO_PARA_PARAMETRO[$key])){
                        $key=RelatorioProcedimentoRealizado::$DE_ATRIBUTO_PARA_PARAMETRO[$key];
                        //verifica se é a primeira vez
                        if ( $contador === 0 ){
                            $parametros=$key.'='.$value;
                        }//fim do if
                        else{
                            $parametros=$parametros.'&'.$key.'='.$value;
                        }//fim do else
                        //incrementa o contador de parâmetros passados
                        $contador++;
                    }//fim do if
                }//fim do for
                //pega a URL do relatório
                $curl= curl_init(Yii::app()->params['urlReport']);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: application/x-www-form-urlencoded'));
                curl_setopt($curl, CURLOPT_POST, count($post));
                curl_setopt($curl, CURLOPT_POSTFIELDS, $parametros);

                $resultado=curl_exec($curl);
                curl_close($curl);
                //manda o arquivo para o download
                $name=RelatorioProcedimentoRealizado::$TIPOS_RELATORIOS[$model->relatorio];
                $name=$name.' - '.Date('d:m:Y h:i:s');
                $this->printFileDownload($resultado, $name);
            }//fim do if
                            
        }//fim do if
                
        $this->render('relatorio', array('model'=>$model,));
    }
    
    public function actionArquivo(){
        $teste = new FileModel('tb_procedimento.txt', 'tb_procedimento_layout.txt', 'ProcedimentoAmbulatorial');
        $teste->popularModels(ProcedimentoAmbulatorial::$MAPEAMENTO_CAMPO_ARQUIVO);
    }
    
    public function actionTeste(){
        
        

        //echo print_r(curl_getinfo($curl));
    }
    
    private function printFileDownload($fileFormatString,$nameReport='relatório'){
                
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Content-Description: File Transfer');
        header('Content-length: '.strlen($fileFormatString));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$nameReport.'.pdf');
        //die($resposta);
        ob_clean(); 
        flush(); 
        echo $fileFormatString; 
        flush(); 
    }
}

?>
