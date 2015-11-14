<?php

include_once 'cabecalho.php';


if (isset($_POST['id'])) {
    
    $id=$_POST['id'];
  
        $sql = "DELETE FROM programacao where id='$id'";
        $pg = pg_query($dbconn, $sql);

        if ($pg != NULL) {
           

           echo $_SESSION['ordmsg'] = "<div class='alert alert-success'>Palestra excluída com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            
            echo "<a href='programacao.php'><button class='btn btn-large btn-danger' >Voltar</button></a>";
        
           
        } else {
           echo  $_SESSION['ordmsg'] = "<div class='alert alert-error'> Erro ao excluir palestra do sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
          echo "<a href='programacao.php'><button class='btn btn-large btn-danger' >Voltar</button></a>";
            
        }
    
}


include_once 'rodape.php';