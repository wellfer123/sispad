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
        
        
        if(isset($_POST['RelatorioProcedimentoRealizado']))
		{
			$model->attributes=$_POST['RelatorioProcedimentoRealizado'];
			if($model->validate()){  
                            
                            $parametros=null;
                            $contador=0;
                            foreach ($model->getAttributes() as $key=>$value){
                                //verifica se o atributo está preenchido
                                //e se está mapeado
                                if (!empty ($value) && isset(RelatorioProcedimentoRealizado::$DE_ATRIBUTO_PARA_PARAMETRO[$key])){
                                    $key=RelatorioProcedimentoRealizado::$DE_ATRIBUTO_PARA_PARAMETRO[$key];
                                    //verifica se é a primeira vez
                                    if ( $contador === 0 ){
                                        $parametros='?'.$key.'='.$value;
                                    }
                                    else{
                                        $parametros=$parametros.'&'.$key.'='.$value;
                                    }
                                    
                                    $contador++;
                                }
                            }
                            $this->redirect('http://localhost:8080/sispadreport/teste4'.$parametros);
                        }
                            
				//$this->redirect(array('view','id'=>$model->cns));
		}
                
        $this->render('relatorio', array('model'=>$model,));
    }
    
    public function actionArquivo(){
        $teste = new FileModel('tb_cid.txt', 'tb_cid_layout.txt', 'Cid');
        $teste->popularModels(Cid::$MAPEAMENTO_CAMPO_ARQUIVO);
    }
}

?>
