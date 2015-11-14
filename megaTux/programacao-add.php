<?php

include_once 'cabecalho.php';


if (isset($_POST['palestra'], $_POST['resumo'], $_POST['curriculo'], $_POST['horario'])) {


    $palestra = pg_escape_string($_POST['palestra']);
    $resumo = pg_escape_string($_POST['resumo']);
    $curriculo = pg_escape_string($_POST['curriculo']);
    $horario = pg_escape_string($_POST['horario']);
   
    
    
      $sqlbusca="select * from programacao where horario='$horario'";
     $retorno = pg_query($dbconn, $sqlbusca);
     
     if (pg_num_rows($retorno)>0) {
         
         $_SESSION['ordmsg']="<div class='alert alert-danger'>Esse horário já foi cadastrado. <button type='button' class='close' data-dismiss='alert'>×</button></div>";  
         
         
             } 
             
             else{
    
            $sql = "INSERT INTO programacao (palestra,resumo,curriculo,horario) "
                    . "VALUES ('$palestra','$resumo','$curriculo', '$horario')";

            pg_query($dbconn, $sql);

            if ($sql != NULL) {

                pg_close($dbconn);
                
                $_SESSION['ordmsg']="<div class='alert alert-success'>Palestra inserida com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao inserir palestra no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
            
             }
        
    }


?>

<h3>Cadastro de Palestra </h3>

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
        <label for="palestra"><h4>Titulo da Palestra</h4></label>
        <input type="text" name="palestra" id="nome" class="form-control"  required maxlength="100">
    </div>

    <div class="form-group">
        <label for="resumo"><h4>Resumo</h4></label>
       
        <textarea name="resumo" id="resumo" class="form-control"></textarea>
   
    </div>
    
    <div class="form-group">
        <label for="curriculo"><h4>Mini Currículo</h4></label>
       
        <textarea name="curriculo" id="curriculo" class="form-control"></textarea>
   
    </div>

    <div class="form-group">
        <label for="horario"><h4>Horário</h4></label> <br/> Favor inserir o horário no formato padrão como mostra o exemplo. <br/>
        <input type="Time" name="horario" id="horario" class="form-control" required> (ex: 09:00)
    </div> <br/>
    
    <button type="submit" class="btn btn-large btn-primary">Cadastrar</button>
  
</form>


<?php

include_once 'rodape.php';

?>
