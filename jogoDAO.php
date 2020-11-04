<?php
    include "conexao.php";

    class JogoDAO{
        

        public static function inserir($jogo){
            $con = Conexao::getConexao();
            $sql = $con->
                prepare("insert into jogos values (null,?,?,?,?,?,?,?)");
            
            $nome = $jogo->getNome();
            $descricao = $jogo->getDescricao();
            $genero = $jogo->getGenero();
            $desenvolvedor = $jogo->getDesenvolvedor();
            $nota = $jogo->getNota();
            $foto = $jogo->getFoto();
            $distribuidora = $jogo->getDistribuidora();
            
            $sql->bindParam(1, $nome);
            $sql->bindParam(2, $descricao);
            $sql->bindParam(3, $genero);
            $sql->bindParam(4, $desenvolvedor);
            $sql->bindParam(5, $nota);
            $sql->bindParam(6, $foto);
            $sql->bindParam(7, $distribuidora);
            
            $sql->execute();
        }

        public static function excluir($jogo){
            $con = Conexao::getConexao();
           
            $sql = null;
            if(is_numeric($jogo)){
                $sql=$con->prepare("delete from jogos where idjogo = ?");
                $sql->bindParam(1, $jogo);
            } else if(is_string($jogo)){
                $sql=$con->prepare("delete from jogos where nome = ?");
                $sql->bindParam(1, $jogo);
            } else {
                $nome = $jogo->getNome();
                $sql=$con->prepare("delete from jogos where nome = ?");
                $sql->bindParam(1, $nome);
            }
            $sql->execute();  
        }

        public static function atualizar($jogo){
            $con = Conexao::getConexao();

            $codigo = $jogo->getIdJogo();
            $nome = $jogo->getNome();
            $descricao = $jogo->getDescricao();
            $genero = $jogo->getGenero();
            $desenvolvedor = $jogo->getDesenvolvedor();
            $nota = $jogo->getNota();
            $foto = $jogo->getFoto();
            $distribuidora = $jogo->getDistribuidora();

            if($codigo>0){
                if($foto=="" || $foto==null){
                    $sql = $con->prepare("update jogos set nome=?, descricao=?, 
                    genero=?, desenvolvedor=?, nota=?, distribuidora=? where idjogo=?");
                    $sql->bindParam(6, $distribuidora);
                    $sql->bindParam(7, $codigo);
                } else {
                    $sql = $con->prepare("update jogos set nome=?, descricao=?, 
                    genero=?, desenvolvedor=?, nota=?, foto=?, distribuidora=? where idjogo=?");
                    $sql->bindParam(6, $foto);
                    $sql->bindParam(7, $distribuidora);
                    $sql->bindParam(8, $codigo);
                }
            } else {
                if($foto=="" || $foto==null){
                    $sql = $con->prepare("update jogos set nome=?, descricao=?, 
                    genero=?, desenvolvedor=?, nota=?, distribuidora=? where nome=?");
                    $sql->bindParam(6, $distribuidora);
                    $sql->bindParam(7, $nome);

                } else {
                    $sql = $con->prepare("update jogos set nome=?, descricao=?, 
                    genero=?, desenvolvedor=?, nota=?, foto=?, distribuidora=? where nome=?");
                    $sql->bindParam(6, $foto);
                    $sql->bindParam(7, $distribuidora);
                    $sql->bindParam(8, $nome);
                }
            }

            $sql->bindParam(1, $nome);
            $sql->bindParam(2, $descricao);
            $sql->bindParam(3, $genero);
            $sql->bindParam(4, $desenvolvedor);
            $sql->bindParam(5, $nota);
            
            

            $sql->execute();
            
        }

        public static function getJogo($identificacao){
            $con = Conexao::getConexao();
            $sql = null;

            if(is_numeric($identificacao)){
                $sql = $con->prepare("select * from jogos where idjogo=?");
                $sql->bindParam(1, $identificacao);
            } else {
                $sql = $con->prepare("select * from jogos where nome=?");
                $sql->bindParam(1, $identificacao);
            }

            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            $jogo = null;
            if($registro = $sql->fetch()){
                $jogo = new Jogo(
                    $registro["idjogo"],
                    $registro["nome"],
                    $registro["descricao"],
                    $registro["genero"],
                    $registro["desenvolvedor"],
                    $registro["nota"],
                    $registro["foto"],
                    $registro["distribuidora"]
                );
            }

            return $jogo;

        }

        public static function getJogos($campo, $ordem, $operador, $valor){
            $con = Conexao::getConexao();
            
            if($operador=="")
                 $sql = $con->prepare("select * from jogos order by $campo $ordem");
            else{
                $sql = $con->prepare("select * from jogos where 
                                        $campo $operador ? order by $campo $ordem");
                $sql->bindParam(1, $valor);
            }
            
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            $jogoLista = array();

            while($registro = $sql->fetch()){
                $jogo = new Jogo(
                    $registro["idjogo"],
                    $registro["nome"],
                    $registro["descricao"],
                    $registro["genero"],
                    $registro["desenvolvedor"],
                    $registro["nota"],
                    $registro["foto"],
                    $registro["distribuidora"]
                );
                $jogoLista[] = $jogo;
            }

            return $jogoLista;
            
        }



    }

?>