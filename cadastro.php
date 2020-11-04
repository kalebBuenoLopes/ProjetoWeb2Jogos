<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--Tags básicas do head-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de jogos</title>
    <!--Link dos nossos arquivos CSS e JS padrão-->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/scripts.js"></script>
    <!--Link dos arquivos CSS e JS do Bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

    <?php
    include_once "jogo.php";
    include_once "jogoDAO.php";
    include_once "imagem.php";
    include_once "usuarioDAO.php";

    session_start();

    if (isset($_SESSION["logado"])) {
        if ($_SESSION["logado"] == false) {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }

    if (!isset($_SESSION["modo"])) {
        $_SESSION["modo"] = 1;
    }

    $codigo = "";
    $nome = "";
    $descricao = "";
    $genero = "";
    $desenvolvedor = "";
    $nota = "";
    $distribuidora = "";
    $foto = "";

    if (isset($_POST["botaoAcao"])) {
        if ($_POST["botaoAcao"] == "Gravar") {

            $codigo = null;
            $nome = $_POST["nome"];
            $descricao = $_POST["descricao"];
            $genero = $_POST["genero"];
            $desenvolvedor = $_POST["desenvolvedor"];
            $nota = $_POST["nota"];
            $distribuidora = $_POST["distribuidora"];
            $arquivo = $_FILES["fileFoto"];
            if ($arquivo != "" && $arquivo != null)
                $foto = Imagem::uploadImagem($arquivo, 2000, 2000, 5000, "img/");
            else
                $foto = "";

            $jAux = new Jogo(
                $codigo,
                $nome,
                $descricao,
                $genero,
                $desenvolvedor,
                $nota,
                $foto,
                $distribuidora

            );
            if ($_SESSION["modo"] == 1)
                JogoDAO::inserir($jAux);
            else
                JogoDAO::atualizar($jAux);
            $jogoAux = JogoDAO::getJogo($nome);
            $foto = $jogoAux->getFoto();
        } else if ($_POST["botaoAcao"] == "Excluir") {
            JogoDAO::excluir($_POST["nome"]);
        }

        if (isset($_POST["botaoAcao"])) {
            if ($_POST["botaoAcao"] == "Excluir" || $_POST["botaoAcao"] == "Limpar") {
                $_SESSION["modo"] = 1;
            } else if ($_POST["botaoAcao"] == "inicio") {
                header("Location: index.php");
            } else if ($_POST["botaoAcao"] == "Cancelar") {
                header("Location: listagem.php");
            } else {
                $_SESSION["modo"] = 2;
            }
        }
    }

    if (isset($_POST["selJogo"])) {

        $_SESSION["modo"] = 2;
        $jogo = JogoDAO::getJogo($_POST["selJogo"]);
        $nome = $jogo->getNome();
        $descricao = $jogo->getDescricao();
        $genero = $jogo->getGenero();
        $desenvolvedor = $jogo->getDesenvolvedor();
        $nota = $jogo->getNota();
        $distribuidora = $jogo->getDistribuidora();
        $foto = $jogo->getFoto();
    } else {
        $_SESSION["modo"] = 1;
    }
    ?>


    <div class="container">
        <div class="row text-center">
            <div class="col-md-12" style="color:white">
                <h1>Cadastro de Jogos</h1>
            </div>
        </div>

        <form method="post" action="cadastro.php" enctype="multipart/form-data">

            <div class="row text-center">
                <div class="col-md-2 offset-1">
                    <input type="submit" name="botaoAcao" value="Limpar" class="btn btn-primary" />
                </div>
                <div class="col-md-2">
                    <input type="submit" name="botaoAcao" value="Gravar" class="btn btn-success" />
                </div>
                <div class="col-md-2">
                    <input type="submit" name="botaoAcao" value="Excluir" class="btn btn-danger" />
                </div>
                <div class="col-md-2">
                    <input type="submit" name="botaoAcao" value="Cancelar" class="btn btn-warning" />
                </div>
                <div class="col-md-2 ">
                    <input type="submit" name="botaoAcao" value="inicio" class="btn btn-dark" />
                </div>

            </div>

            <br><br>

            <div class="row" id="areaCadastro" style="background-color: rgba(0, 0, 0, 0.6); color: white;">

                <div class="col-md-6">

                    <img src="img/<?php echo $foto; ?>" style="width:100%; height:100%; padding: 5%;">

                    <input type="file" name="fileFoto">

                </div>

                <div class="col-md-6">

                    <div class="col-md-12">

                        <strong><label for="nome">Nome</label></strong>
                        <input type="text" name="nome" style="width: 100%;" value="<?php echo $nome; ?>">

                    </div>
                    <div class="col-md-12">
                        <strong><label for="descricao">Descrição</label></strong>
                        <textarea rows="3" wrap="hard" name="descricao" style="width: 100%;"><?php echo $descricao; ?></textarea>
                    </div>
                    <div class="col-md-12">
                        <strong><label for="genero ">Genero</label></strong>
                        <input type="text" name="genero" style="width: 100%;" value="<?php echo "$genero"; ?>">
                    </div>

                    <div class="col-md-12">
                        <strong><label for="desenvolvedor">Desenvolvedor</label></strong>
                        <input type="text" name="desenvolvedor" style="width: 100%;" value="<?php echo "$desenvolvedor"; ?>">
                    </div>
                    <div class="col-md-12">
                        <strong><label for="nota">Nota</label></strong>
                        <input type="text" name="nota" style="width: 100%;" value="<?php echo $nota; ?>">
                    </div>
                    <div class="col-md-12">
                        <strong><label for="distribuidora">Distribuidora</label></strong>
                        <input type="text" name="distribuidora" style="width: 100%;" value="<?php echo "$distribuidora"; ?>">
                    </div>

                </div>

            </div>


</body>