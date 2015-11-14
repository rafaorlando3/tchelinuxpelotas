<?php

include_once 'cabecalho.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

if (isset($_POST['nome'], $_POST['email'], $_POST['coordenador'],$_POST['id'])) {


    $nome = pg_escape_string($_POST['nome']);
    $email = pg_escape_string($_POST['email']);
    $coordenador = pg_escape_string($_POST['coordenador']);
    $idcoordenador=$_POST['id'];
            
         $sql = "UPDATE organizacao SET nome='$nome',email='$email', coordenacao='$coordenador' where id='$idcoordenador'";
         pg_query($dbconn, $sql);

            if ($sql != NULL) {

                $_SESSION['ordmsg']="<div class='alert alert-success'>Organizador atualizado com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao atualizar organizador no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
        
    }



?>

<h3>Atualização Organização  </h3>

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?></div>

<script language="Javascript">
        function confirmacao() {
            var resposta = confirm("Você realmente deseja excluir esse organizador?");
            if (resposta == true) {
                document.excluir.submit();
            }
            else{
                
            }
        }
    </script>
  
    <form id="excluir" name="excluir" method="post" action="organizacao-del.php" > <input type="hidden" name="id" value="<?php echo $id; ?>"/>   <button onclick="confirmacao();" class="btn btn-large btn-danger" >Excluir</button> 
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
            $sql3 = "Select * from organizacao where id='$id' ";
            $listagem3 = pg_query($dbconn, $sql3);

            if ($listagem3 != NULL) {
                while ($linha2 = pg_fetch_array($listagem3)) {
                    $id_organizador = isset($linha2['id']) ? $linha2['id'] : '';
                    
                    
                    ?>

   
    <div class="form-group">
        <label for="nome"><h4>Nome</h4></label>
        <input type="text" name="nome" id="nome" value="<?php echo $linha2['nome']; ?>" class="form-control"  required maxlength="100">
    </div>


    <div class="form-group">
        <label for="email"><h4>Email</h4></label>
        <input type="email" name="email" id="horario" value="<?php echo $linha2['email']; ?>" class="form-control" required>
    </div> <br/>
    
<input type="hidden" name="id" value="<?php echo $id_organizador; ?>"/>

 <div class="form-group">
            <label><h4>Coordenador?</h4></label> <br/>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="coordenador" value="1" <?php if($linha2['coordenacao']==1){ echo "checked";} ?>  autocomplete="off">Sim
                </label>
                <label class="btn btn-primary " >
                    <input type="radio" name="coordenador" value="0" autocomplete="off"  <?php if($linha2['coordenacao']==0){ echo "checked";} ?> >Não
                </label>
            </div>
        </div>
        
            
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

