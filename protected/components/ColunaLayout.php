<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ColunaLayout
 *
 * @author Albuquerque
 */
class ColunaLayout {
    //put your code here
    private $nome;
    private $tipo;
    private $tamanho;
    private $inicio;
    private $fim;
    
    function __construct($nome, $tipo, $tamanho, $inicio, $fim) {
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->tamanho = $tamanho;
        $this->inicio = $inicio;
        $this->fim = $fim;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getFim() {
        return $this->fim;
    }

    public function setFim($fim) {
        $this->fim = $fim;
    }



}

?>
