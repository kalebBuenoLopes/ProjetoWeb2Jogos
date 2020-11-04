<?php
    class imagem{
        public static function uploadImagem($foto, $larguraMaxima, $alturaMaxima, $tamanhoMaximo, $caminho)
        {
            
            $error = array();
            
            if (!empty($foto["name"])) {

                if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $error[1] = "Isso não é uma imagem.";
                } 
            
                $dimensoes = getimagesize($foto["tmp_name"]);
            
                if($dimensoes[0] > $larguraMaxima) {
                    $error[2] = "A largura da imagem não deve ultrapassar ".$larguraMaxima." pixels";
                }
        
                if($dimensoes[1] > $alturaMaxima) {
                    $error[3] = "Altura da imagem não deve ultrapassar ".$alturaMaxima." pixels";
                }
                
                if($foto["size"] > ($tamanhoMaximo*1000)) {
                    $error[4] = "A imagem deve ter no máximo ".$tamanhoMaximo." bytes";
                }
        
                if (count($error) == 0) {
                
                    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        
                    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
        
                    $caminho_imagem = $caminho . $nome_imagem;
        
                    move_uploaded_file($foto["tmp_name"], $caminho_imagem);
                    return $nome_imagem;
                }
                else
                    return $error;
            
            }
            
        }
    
    }

?>