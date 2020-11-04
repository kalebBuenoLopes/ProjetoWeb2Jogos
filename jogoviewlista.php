<?php

class JogoListaView
{

    public static function geraLista($lista)
    {

        echo "<form action='cadastro.php' method='post'>";

        $cont = 0;
        foreach ($lista as $jogo) {

            $cont++;
            $cor = "#BBBBBB";
            if ($cont % 2 == 0) {
                $cor = "#929292";
            }

            $codigo = $jogo->getIdJogo();
            $nome = $jogo->getNome();
            $descricao = $jogo->getDescricao();
            $genero = $jogo->getGenero();
            $desenvolvedor = $jogo->getDesenvolvedor();
            $nota = $jogo->getNota();
            $distribuidora = $jogo->getDistribuidora();
            $foto = $jogo->getFoto();


            echo "
                    
                        <div class='row text-center' style='background-color: $cor; border: 1px solid #AAAAAA;'>

                            <div class = 'col-md-4'>
                            
                                <div class='col-md-12' style='padding-top: 5% ;padding-left: 0 !important; padding-right: 0 !important; '>
                                    <button class='btn' type='submit' name='selJogo' value= $codigo style='height:100%; width:100%; padding:0px!important;'>
                                        <img src= 'img/$foto' style='height:100%; width:100%;'>
                                    </button> 
                                </div>

                                <div class='col-md-12' style='display:flex; align-items:center; justify-content: center;'>
                                    $nome
                                </div>

                            </div>

                            <div class = 'col-md-4' style='padding-top: 2%;'>

                                <div class='col-md-12' style='display:flex; align-items:center;'>
                                    <p style= 'color: white;'>Código: <span style='color: black'>$codigo</span></p> 
                                </div>
                            
                                <div class='col-md-12' style='display:flex; align-items:center;'>
                                    <p style= 'color: white;'>Gênero: <span style='color: black'>$genero</span></p>
                                </div>
                                <div class='col-md-12' style='display:flex; align-items:center;'>
                                    <p style= 'color: white;'>Desenvolvedor: <span style='color: black'>$desenvolvedor</span></p>
                                </div>
                                <div class='col-md-12' style='display:flex; align-items:center;'>
                                    <p style= 'color: white;'>Nota: <span style='color: black'>$nota</span></p>
                                </div>
                                <div class='col-md-12' style='display:flex; align-items:center;'>
                                    <p style= 'color: white;'>Distribuidora: <span style='color: black'>$distribuidora</span></p>
                                </div>

                            </div>

                            <div class = 'col-md-4' style='padding-top: 3%;'>

                                <div class= 'col-md-12'>
                                <button class='btn' type='submit' name='delJogo' value= $codigo style='height:100%; background-color:transparent;'>
                                    <img src= 'img/delete.png' style='height:25%; width:25%;'>
                                </button> 
                                </div>

                                <div class= 'col-md-12'>
                                    <button class='btn' type='submit' name='selJogo' value= $codigo style='height:100%; background-color:transparent; margin-top: 5%; margin-left: 3%;'>
                                        <img src= 'img/edit.png' style='height:22%; width:22%;'>
                                    </button> 
                                </div>

                            </div>

                        </div>
                    ";
        }

        echo "</form>";
    }
}
