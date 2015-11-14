<?php

include_once 'cabecalho.php';



if (isset($_POST['nome'], $_POST['telefone'], $_POST['estado'], $_POST['cidade'], $_POST['email'], $_POST['rg']
                ,$_POST['admin'],$_POST['id'],$_POST['presenca'])) {


    $nome = pg_escape_string($_POST['nome']);
    $telefone = pg_escape_string($_POST['telefone']);
    $cidade = pg_escape_string($_POST['cidade']);
    $estado = pg_escape_string($_POST['estado']);
    $rg = pg_escape_string($_POST['rg']);
    $email =pg_escape_string($_POST['email']);
    $senh = pg_escape_string($_POST['senha']);
    $senha=base64_encode($senh);
    $admin = pg_escape_string($_POST['admin']);
    $presenca=pg_escape_string($_POST['presenca']);
    $iduser=$_POST['id'];
            
         $sql = "UPDATE usuarios SET nome='$nome',telefone='$telefone', cidade='$cidade',estado='$estado',rg='$rg',email='$email', senha='$senha',admin='$admin',presenca='$presenca' where id='$iduser'";
         pg_query($dbconn, $sql);

            if ($sql != NULL) {

                $_SESSION['ordmsg']="<div class='alert alert-success'>Usuário atualizado com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao atualizar usuário no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
        
    }



?>

<h3>Atualização Inscritos / Usuários </h3>

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?></div>

<br/>
<form id="cadastros" method="post">
   
      <?php
            $sql3 = "Select * from usuarios where id='$iduser' ";
            $listagem3 = pg_query($dbconn, $sql3);

            if ($listagem3 != NULL) {
                while ($linha2 = pg_fetch_array($listagem3)) {
                    $id_usuario = isset($linha2['id']) ? $linha2['id'] : '';
                    ?>
    
    
    
    <div class="form-group">
        <label for="nome"><h4>Nome Completo*</h4></label>
        <input type="text" name="nome" id="nome" class="form-control"  value="<?php echo $linha2['nome']; ?>" required maxlength="100">
    </div>

    <div class="form-group">
        <label for="email"><h4>Email*</h4></label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $linha2['email']; ?>" required maxlength="60">
    </div>

    <div class="form-group">
        <label for="telefone"><h4>Telefone*</h4></label>
        <input type="tel" name="telefone" id="telefone" value="<?php echo $linha2['telefone']; ?>" class="form-control" onkeydown="Mascara(this, Telefone);" onkeypress="Mascara(this, Telefone);" onkeyup="Mascara(this, Telefone);" required>
    </div>

    <div class="form-group">
        <label for="cidade"><h4>Cidade*</h4></label>
        <input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo $linha2['cidade']; ?>"  maxlength="50">
    </div>

    <div class="form-group">
        <label for="estado"><h4>Estado*</h4></label><br/>
        <select name="estado" id="estado">
        <option value="AC" <?php if($linha2['estado']=="AC"){ echo "selected";} ?> >Acre</option>
	<option value="AL" <?php if($linha2['estado']=="AL"){ echo "selected";} ?> >Alagoas</option>
	<option value="AP" <?php if($linha2['estado']=="AP"){ echo "selected";} ?> >Amapá</option>
	<option value="AM" <?php if($linha2['estado']=="AM"){ echo "selected";} ?> >Amazonas</option>
	<option value="BA" <?php if($linha2['estado']=="BA"){ echo "selected";} ?> >Bahia</option>
	<option value="CE" <?php if($linha2['estado']=="CE"){ echo "selected";} ?> >Ceará</option>
	<option value="DF" <?php if($linha2['estado']=="DF"){ echo "selected";} ?> >Distrito Federal</option>
	<option value="ES" <?php if($linha2['estado']=="ES"){ echo "selected";} ?> >Espirito Santo</option>
	<option value="GO" <?php if($linha2['estado']=="GO"){ echo "selected";} ?> >Goiás</option>
	<option value="MA" <?php if($linha2['estado']=="MA"){ echo "selected";} ?> >Maranhão</option>
	<option value="MS" <?php if($linha2['estado']=="MS"){ echo "selected";} ?> >Mato Grosso do Sul</option>
	<option value="MT" <?php if($linha2['estado']=="MT"){ echo "selected";} ?> >Mato Grosso</option>
	<option value="MG" <?php if($linha2['estado']=="MG"){ echo "selected";} ?> >Minas Gerais</option>
	<option value="PA" <?php if($linha2['estado']=="PA"){ echo "selected";} ?> >Pará</option>
	<option value="PB" <?php if($linha2['estado']=="PB"){ echo "selected";} ?> >Paraíba</option>
	<option value="PR" <?php if($linha2['estado']=="PR"){ echo "selected";} ?> >Paraná</option>
	<option value="PE" <?php if($linha2['estado']=="PE"){ echo "selected";} ?> >Pernambuco</option>
	<option value="PI" <?php if($linha2['estado']=="PI"){ echo "selected";} ?> >Piauí</option>
	<option value="RJ" <?php if($linha2['estado']=="RJ"){ echo "selected";} ?> >Rio de Janeiro</option>
	<option value="RN" <?php if($linha2['estado']=="RN"){ echo "selected";} ?> >Rio Grande do Norte</option>
	<option value="RS" <?php if($linha2['estado']=="RS"){ echo "selected";} ?> >Rio Grande do Sul</option>
	<option value="RO" <?php if($linha2['estado']=="RO"){ echo "selected";} ?> >Rondônia</option>
	<option value="RR" <?php if($linha2['estado']=="RR"){ echo "selected";} ?> >Roraima</option>
	<option value="SC" <?php if($linha2['estado']=="SC"){ echo "selected";} ?> >Santa Catarina</option>
	<option value="SP" <?php if($linha2['estado']=="SP"){ echo "selected";} ?> >São Paulo</option>
	<option value="SE" <?php if($linha2['estado']=="SE"){ echo "selected";} ?> >Sergipe</option>
	<option value="TO" <?php if($linha2['estado']=="TO"){ echo "selected";} ?> >Tocantins</option>
    </select>
        
    </div>

    <div class="form-group">
        <label for="rg"><h4>RG*</h4></label>
        <input type="text" name="rg" id="rg" value="<?php echo $linha2['rg']; ?>" class="form-control"  required>
    </div>

  
        <div class="form-group">
            <label><h4>Administrador?</h4></label> <br/>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="admin" value="1" <?php if($linha2['admin']==1){ echo "checked";} ?>  autocomplete="off">Sim
                </label>
                <label class="btn btn-primary " >
                    <input type="radio" name="admin" value="0" autocomplete="off" <?php if($linha2['admin']==0){ echo "checked";} ?>  >Não
                </label>
            </div>
        </div>
    
    <input type="hidden" name="id" value="<?php echo $iduser; ?>"/>
    
    <div id="mostrasenha" class="form-group">
        
        <br/><label for='senha'><h4>Senha</h4></label><input type='password' name='senha' id='senha' value="<?php echo base64_decode($linha2['senha']); ?>" class='form-control'  title='Não Obrigatório para Inscritos.'/><br/>
        
        
            
            
       <div class="form-group">
           <label for="presenca"><h4>Presença</h4></label><br/>
         <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="presenca" value="1" <?php if($linha2['presenca']==1){ echo "checked";} ?>  autocomplete="off">Sim
                </label>
                <label class="btn btn-primary" >
                    <input type="radio" name="presenca" value="0" autocomplete="off" <?php if($linha2['presenca']==0){ echo "checked";} ?> >Não
                </label>
            </div>
        
    </div>     
        
            
       <?php
                }
            }
        ?>
    </div> <br/>
    
    <button type="submit" class="btn btn-large btn-primary">Atualizar</button>
  
</form>

<?php 

 include_once 'rodape.php';



     ?>

