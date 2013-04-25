<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProducaoMensalEspecialidadeGrupoModel
 *
 * @author Júnior Pires
 */
class ProducaoMensalEspecialidadeGrupoModel extends CFormModel {

    public $unidade;
    public $grupo;
    public $especialidade;
    public $jan;
    public $fev;
    public $mar;
    public $abr;
    public $mai;
    public $jun;
    public $jul;
    public $ago;
    public $set;
    public $out;
    public $nov;
    public $dez;
    public $primaryKey;
    public $id;
    public $ano;
    
    public $anual;
    

    public function attributeNames() {
        return array('jan', 'fev', 'unidade', 'grupo');
    }
    
    public function rules() {
        return array(
                    array('grupo, unidade,especialidade, ano', 'safe', 'on'=>'search'),
        );
    }

        public function attributeLabels() {
        return array(
            'jan' => 'Janeiro',
            'fev' => 'Fevereiro',
            'mar' => 'Março',
            'abr' => 'Abril',
            'unidade' => 'Unidade',
            'grupo' => 'Grupo',
            'especialidade' => 'Especialidade',
        );
    }

    /**
     * Preenche todos os meses que não contém valores preenchidos.
     */
    public function fillAttributes() {
        $this->fev = isset($this->fev) ? $this->fev : 0;
        $this->jan = isset($this->jan) ? $this->jan : 0;
        $this->mar = isset($this->mar) ? $this->mar : 0;
        $this->abr = isset($this->abr) ? $this->abr : 0;

        $this->mai = isset($this->mai) ? $this->mai : 0;
        $this->jun = isset($this->jun) ? $this->jun : 0;
        $this->jul = isset($this->jul) ? $this->jul : 0;
        $this->ago = isset($this->ago) ? $this->ago : 0;

        $this->set = isset($this->set) ? $this->set : 0;
        $this->out = isset($this->out) ? $this->out : 0;
        $this->nov = isset($this->nov) ? $this->nov : 0;
        $this->dez = isset($this->dez) ? $this->dez : 0;
        
        $this->anual=$this->jan+$this->fev+$this->mar+$this->abr+$this->mai+$this->jun+$this->jul+$this->ago+$this->set+$this->out+$this->nov+$this->dez;
    }

    public function setMes($mes, $quantidade) {
        switch ((int) $mes) {
            case 1:
                $this->jan = $quantidade;
                break;
            case 2:
                $this->fev = $quantidade;
                break;
            case 3:
                $this->mar = $quantidade;
                break;
            case 4:
                $this->abr = $quantidade;
                break;
            case 5:
                $this->mai = $quantidade;
                break;
            case 6:
                $this->jun = $quantidade;
                break;
            case 7:
                $this->jul = $quantidade;
                break;
            case 8:
                $this->ago = $quantidade;
                break;
            case 9:
                $this->set = $quantidade;
                break;
            case 10:
                $this->out = $quantidade;
                break;
            case 11:
                $this->nov = $quantidade;
                break;
            case 12:
                $this->dez = $quantidade;
                break;
        }
    }

    public function search() {
        //monta o where da consulta
        $where= null;
        //atributo unidade
        if ($this->unidade != null){
            $where= " WHERE pd.unidade_cnes='".$this->unidade."'"; 
        }
        
        //filtro de especialidade
        if ($this->especialidade != null){
            
            if ($where != null){
                $where=$where." AND pd.profissao_codigo='".$this->especialidade."'";
            }
            else{
               $where=" WHERE pd.profissao_codigo='".$this->especialidade."'"; 
            }
        }
        
        
        //filtro de ano
        if ($this->ano != null){
            
            if ($where != null){
                $where=$where." AND YEAR(data)='".$this->ano."'";
            }
            else{
               $where=" WHERE YEAR(data)='".$this->ano."'"; 
            }
        }
        
        
        $query = "SELECT pd.unidade_cnes AS 'cnes', gr.codigo AS grupo_cod, gr.nome AS grupo,prof.nome as especialidade,pd.profissao_codigo As especialidade_codigo, month(data) AS mes, SUM(quantidade) AS quantidade FROM producao_diaria pd ";
        $query = $query . ' INNER JOIN grupo gr ON gr.codigo=pd.grupo_codigo ';
        $query = $query . ' INNER JOIN profissao prof ON prof.codigo=pd.profissao_codigo';
        //$query = $query . ' INNER JOIN unidade uni ON uni.cnes=pd.unidade_cnes';
        //clausula where
        if ($where != NULL){
            $query=$query.$where;
        }
        
        $query = $query . ' GROUP BY  especialidade_codigo,grupo_codigo,month(data) ';
        $query = $query . ' ORDER BY prof.nome,gr.nome, month(data) ';

        $rows = Yii::app()->db->createCommand($query)->queryAll(); 
        $mes = null;
        $especialidade = null;
        $grupo = null;
        $list = array();
        $producaoMensal = null;
        $primeiraVez = true;
        
        foreach ($rows as $key => $row) {

            //variáveis locais
            $prod = new ProducaoMensalEspecialidadeGrupoModel;
            $prod->especialidade = $row['especialidade_codigo'];
            $prod->grupo = $row['grupo_cod'];
            $m = $row['mes'];

            //mudou de grupo ou de especialidade, então é um novo registro
            if ( $especialidade != $prod->especialidade  || $grupo!=$prod->grupo) {
                //um novo modelo deve ser instanciado e o antigo deve ser armazenado no vetor
                if (!$primeiraVez) {
                    $producaoMensal->fillAttributes();
                    $list[] = $producaoMensal;
                }
                //popula o model
                $producaoMensal = new ProducaoMensalespecialidadeGrupoModel();
                $producaoMensal->grupo = $row['grupo'];
                $producaoMensal->especialidade = $row['especialidade'];

                //guarda os valores atuais  
                $especialidade = $prod->especialidade;
                $grupo = $prod->grupo;
            }

            $producaoMensal->setMes($m, $row['quantidade']);
            $mes = $m;
            $primeiraVez = false;
        }
        //adiciona o ultimo registro
        if (!$primeiraVez) {
            $producaoMensal->fillAttributes();
            $list[] = $producaoMensal;
        }
        $dataProvider = new CArrayDataProvider($list, array(
            'id' => 'producaoMensalEspecialidadeGrupoModel',
            'pagination' => array(
                 'pageSize' => 30,
            ),
        ));

        return $dataProvider;
    }

}

?>
