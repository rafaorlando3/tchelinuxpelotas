<?php

include_once 'cabecalho.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

if (isset($_POST['palestra'], $_POST['curriculo'], $_POST['resumo'], $_POST['horario'],$_POST['id'])) {


    $palestra = pg_escape_string($_POST['palestra']);
    $curriculo = pg_escape_string($_POST['curriculo']);
    $resumo = pg_escape_string($_POST['resumo']);
    $horario = pg_escape_string($_POST['horario']);
    $idprogramacao=$_POST['id'];
            
         $sql = "UPDATE programacao SET palestra='$palestra',curriculo='$curriculo', resumo='$resumo',horario='$horario' where id='$idprogramacao'";
         pg_query($dbconn, $sql);

            if ($sql != NULL) {

                $_SESSION['ordmsg']="<div class='alert alert-success'>Palestra atualizada com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao atualizar palestra no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
        
    }



?>

<h3>Atualização Palestra  </h3>

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?></div>

<script language="Javascript">
        function confirmacao() {
            var resposta = confirm("Você realmente deseja excluir essa paletra?");
            if (resposta == true) {
                document.excluir.submit();
            }
            else{
                
            }
        }
    </script>
  
    <form id="excluir" name="excluir" method="post" action="programacao-del.php" > <input type="hidden" name="id" value="<?php echo $id; ?>"/>   <button onclick="confirmacao();" class="btn btn-large btn-danger" >Excluir</button> 
     </form>
  
    <hr/> 

    
    <style>
#form-inscricao {
    max-width: 750px;
    margin: 0 auto;
}
</style>

<br/>
<form id="inscriajax" method="post">
   
      <?php
            $sql3 = "Select * from programacao where id='$id' ";
            $listagem3 = pg_query($dbconn, $sql3);

            if ($listagem3 != NULL) {
                while ($linha2 = pg_fetch_array($listagem3)) {
                    $id_palestra = isset($linha2['id']) ? $linha2['id'] : '';
                    
                    
                    ?>

   
    <div class="form-group">
        <label for="palestra"><h4>Titulo da Palestra</h4></label>
        <input type="text" name="palestra" id="nome" value="<?php echo $linha2['palestra']; ?>" class="form-control"  required maxlength="100">
    </div>

    <div class="form-group">
        <label for="resumo"><h4>Resumo</h4></label>
       
        <textarea name="resumo" id="resumo" class="form-control"><?php echo $linha2['resumo']; ?></textarea>
   
    </div>
    
    <div class="form-group">
        <label for="curriculo"><h4>Mini Currículo</h4></label>
       
        <textarea name="curriculo" id="curriculo" class="form-control"><?php echo $linha2['curriculo']; ?></textarea>
   
    </div>

    <div class="form-group">
        <label for="horario"><h4>Horário</h4></label>
        <input type="Time" name="horario" id="horario" value="<?php echo $linha2['horario']; ?>" class="form-control" required>
    </div> <br/>
    
<input type="hidden" name="id" value="<?php echo $id_palestra; ?>"/>
        
            
       <?php
                }
            }
        ?>
    <br/>
    
    <button type="submit" class="btn btn-large btn-primary">Atualizar</button>  
</form>

<?php 

 include_once 'rodape.php';



     ?>

