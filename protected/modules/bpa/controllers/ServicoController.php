<?php

class ServicoController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        
        public function actions(){
                    
            return array(
            'main'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'ProcedimentoRealizado'=>'ProcedimentoRealizado',
                    'UsuarioDesktop'=>'UsuarioDesktop',
                    'MessageWebService'=>'MessageWebService',
                ),
                ),
            );
        
        }
        /**
         *
         * @param ProcedimentoRealizado[] $procedimentoRealizado
         * @param UsuarioDesktop $usuario
         * @return MessageWebService[]
         * @soap
         */
        public function sendProcedimentoRealizadoEPaciente($procedimentoRealizado, $usuario){
               
            return array(new MessageWebService());
        }

}