<?php

 class JogoView{

    public static function gerarCard($lista){
        foreach($lista as $jogo){

        $nomeJogo = $jogo->getNome();
        $descricaoJogo = $jogo->getDescricao();
        $generoJogo = $jogo->getGenero();
        $desenvolvedorJogo = $jogo->getDesenvolvedor();
        $notaJogo = $jogo->getNota();
        $fotoJogo = $jogo->getFoto();
        $destribuidoraJogo = $jogo->getDistribuidora();

        
        echo "
        <div class='row text-center' style='background-color: rgba(0,0,0,0.8); color: white; margin-top: 20px; border: 2px solid Grey;'>

            <div class='col-md-6'>

                <img style='width: 100%; margin-bottom: 10px; border: 2px solid white; margin-top: 20px;' src='img/$fotoJogo'>
                <h2 style='font-size: 1.6em;'>$nomeJogo</h2>

            </div>

            <div class='col-md-6'>

                <br>
                <p style='text-align: center; font-size:0.8em; margin-top: 2%;'>$descricaoJogo</p>

                <p>Genero: $generoJogo</p>
                <p>Nota: $notaJogo</p>
                <br>
                <p>Desenvolvedor: $desenvolvedorJogo </p>
                <p>Destribuidora: $destribuidoraJogo</p>

            </div>

    </div>
        
           ";

        }
        
    }

 }

?>