<?php

    class Jogo{

        private $idJogo;
        private $nome;
        private $descricao;
        private $genero;
        private $desenvolvedor;
        private $nota;
        private $foto;
        private $distribuidora;

        public function __construct($idJogo, $nome, $descricao, $genero, $desenvolvedor, $nota, $foto, $distribuidora){
            $this->idJogo = $idJogo;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->genero = $genero;
            $this->desenvolvedor = $desenvolvedor;
            $this->nota = $nota;
            $this->foto = $foto;
            $this->distribuidora = $distribuidora;
        }
        
        public function getIdJogo(){
            return $this->idJogo;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($novoNome){
            $this->nome = $novoNome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($novaDescricao){
            $this->descricao = $novaDescricao;
        }

        public function getGenero(){
            return  $this->genero;
        }

        public function setGenero($novoGenero){
            $this->genero = $novoGenero;
        }

        public function getDesenvolvedor(){
            return $this->desenvolvedor;
        }

        public function setDesenvolvedor($novoDesenvolvedor){
            $this->desenvolvedor = $novoDesenvolvedor;
        }

        public function getNota(){
            return $this->nota;
        }

        public function setNota($novaNota){
            $this->nota = $novaNota;
        }

        public function getFoto(){
            return $this->foto;
        }

        public function setFoto($novaFoto){
            $this->foto = $novaFoto;
        }

        public function getDistribuidora(){
            return $this->distribuidora;
        }

        public function setDistribuidora($novaDistribuidora){
            $this->distribuidora = $novaDistribuidora;
        }

        public function __toString(){
            $texto = "";
            $texto = "Nome: ".$this->nome."<br>";
            $texto = "".$this->descricao."<br>";
            $texto = "".$this->genero."<br>";
            $texto = "".$this->desenvolvedor."<br>";
            $texto = "".$this->nota."<br>";
            $texto = "".$this->distribuidora."<br>";
            return $texto;
        }
        
    }

?>