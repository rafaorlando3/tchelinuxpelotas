<?php

include_once 'cabecalho.php';


if (isset($_POST['nome'], $_POST['email'], $_POST['coordenador'])) {


    $nome = pg_escape_string($_POST['nome']);
    $email = pg_escape_string($_POST['email']);
    $coordenador = pg_escape_string($_POST['coordenador']);
   
    
    
      $sqlbusca="select * from organizacao where email='$email'";
     $retorno = pg_query($dbconn, $sqlbusca);
     
     if (pg_num_rows($retorno)>0) {
         
         $_SESSION['ordmsg']="<div class='alert alert-danger'>Esse organizador já foi cadastrado. <button type='button' class='close' data-dismiss='alert'>×</button></div>";  
         
         
             } 
             
             else{
    
            $sql = "INSERT INTO organizacao (nome,email,coordenacao) "
                    . "VALUES ('$nome','$email','$coordenador')";

            pg_query($dbconn, $sql);

            if ($sql != NULL) {

                pg_close($dbconn);
                
                $_SESSION['ordmsg']="<div class='alert alert-success'>Organizador inserido com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao inserir organizador no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
            
             }
        
    }


?>

<h3>Cadastro de Organização </h3>

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?></div>

<style>
#form-inscricao {
    max-width: 750px;
    margin: 0 auto;
}
</style>

<br/>
<form id="inscriajax" method="post">
   
    <div class="form-group">
        <label for="nome"><h4>Nome</h4></label>
        <input type="text" name="nome" id="nome" class="form-control"  required maxlength="100">
    </div>


    <div class="form-group">
        <label for="email"><h4>Email</h4></label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div> <br/>
    
     <div class="form-group">
            <label><h4>Coordenador?</h4></label> <br/>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="coordenador" value="1"  autocomplete="off">Sim
                </label>
                <label class="btn btn-primary active" id="js-btnNaoAluno">
                    <input type="radio" name="coordenador" value="0" autocomplete="off"  checked>Não
                </label>
            </div>
        </div>
    
    <button type="submit" class="btn btn-large btn-primary">Cadastrar</button>
  
</form>


<?php

include_once 'rodape.php';

?>
