<?php

include_once 'cabecalho.php';


if (isset($_POST['id'])) {
    
    $id=$_POST['id'];
    if ($id == 1) {
        $_SESSION['ordmsg'] = "<center><span id='mensagem'><div class='falha' >Esse Usuário não pode ser excluído.<a href='#' title='Fechar' onclick='oculta();' style='margin:0 20px 10px 0; float:right; color:red;'>X</a></div></span> </center>";
    } else {
        $sql = "DELETE FROM usuarios where id='$id'";
        $pg = pg_query($dbconn, $sql);

        if ($pg != NULL) {
           

           echo $_SESSION['ordmsg'] = "<div class='alert alert-success'>Usuário excluído com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            
            echo "<a href='usuarios.php'><button class='btn btn-large btn-danger' >Voltar</button></a>";
        
           
        } else {
           echo  $_SESSION['ordmsg'] = "<div class='alert alert-error'> Erro ao excluir usuário no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
           echo "<a href='usuarios.php'><button class='btn btn-large btn-danger' >Voltar</button></a>";
            
        }
    }
}


include_once 'rodape.php';