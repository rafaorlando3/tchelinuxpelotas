<?php

include_once 'cabecalho.php';


if (isset($_POST['nome'], $_POST['telefone'], $_POST['estado'], $_POST['cidade'], $_POST['email'], $_POST['rg']
                ,$_POST['admin'])) {


    $nome = pg_escape_string($_POST['nome']);
    $telefone = pg_escape_string($_POST['telefone']);
    $cidade = pg_escape_string($_POST['cidade']);
    $estado = pg_escape_string($_POST['estado']);
    $rg = pg_escape_string($_POST['rg']);
    $email = pg_escape_string($_POST['email']);
    $senh = pg_escape_string($_POST['senha']);
    $senha=  base64_encode($senh);
    $admin = pg_escape_string($_POST['admin']);
    $presenca=0;
    
    
      $sqlbusca="select * from usuarios where email='$email' or rg='$rg' or telefone='$telefone' ";
     $retorno = pg_query($dbconn, $sqlbusca);
     
     if (pg_num_rows($retorno)>0) {
         
         $_SESSION['ordmsg']="<div class='alert alert-danger'>Esse usuário já foi inscrito. <button type='button' class='close' data-dismiss='alert'>×</button></div>";  
         
         
             } 
             
             else{

            $sql = "INSERT INTO usuarios (nome,telefone,cidade,estado,rg,email,senha,admin,presenca) "
                    . "VALUES ('$nome','$telefone','$cidade', '$estado', '$rg', '$email','$senha','$admin','$presenca')";

            pg_query($dbconn, $sql);

            if ($sql != NULL) {

                pg_close($dbconn);
                
                
                
                require("../class/class.phpmailer.php");
                $mail = new PHPMailer();
                $mail->IsSMTP(); // Define que a mensagem será SMTP
                $mail->Host = "smtp.getsitesolucoes.com.br"; // Endereço do servidor SMTP
                $mail->SMTPAuth = true; // Autenticação
                $mail->Username = 'tchelinux@getsitesolucoes.com.br'; // Usuário do servidor SMTP
                $mail->Password = 'tux2255'; // Senha da caixa postal utilizada
                $mail->From = "tchelinux@getsitesolucoes.com.br"; 
                $mail->FromName = "TCHE LINUX PELOTAS 2015";
                
                $mail->AddAddress($email, $nome);
                $mail->AddAddress($email);
                $mail->AddCC('manutche@getsitesolucoes.com.br', 'Copia'); 
                $mail->AddBCC('manutche@getsitesolucoes.com.br', 'Copia Oculta');
                $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
                
                $mail->Subject  = "Inscricao realizada com sucesso - TCHE LINUX"; // Assunto da mensagem
                $mail->Body = 'Você se inscreveu no <b>TCHÊ LINUX - PELOTAS 2015</b>, obrigado por participar deste importante evento =D.  <br/> <b>Para mais informações, acesse:</b> <a href="http://tchelinux.getsitesolucoes.com.br" target="_blank">http://tchelinux.getsitesolucoes.com.br</a> ';
                $mail->AltBody = 'Você se inscreveu no <b>TCHÊ LINUX - PELOTAS 2015</b>, obrigado por participar deste importante evento =D.  <br/> <b>Para mais informações, acesse:</b> <a href="http://tchelinux.getsitesolucoes.com.br" target="_blank">http://tchelinux.getsitesolucoes.com.br</a> ';
                $enviado = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                if ($enviado) {
                    
                   $_SESSION['ordmsg']="<div class='alert alert-success'>Usuário inscrito com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";
                    
                    } else {

                    echo "Informações do erro: " . $mail->ErrorInfo;
                }

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao inscrever usuário no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
            
             }
        
    }


?>

<h3>Cadastro de Inscritos / Usuários </h3>

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?></div>


<br/>
<form id="cadastros" method="post">
   
    <div class="form-group">
        <label for="nome"><h4>Nome Completo*</h4></label>
        <input type="text" name="nome" id="nome" class="form-control"  required maxlength="100">
    </div>

    <div class="form-group">
        <label for="email"><h4>Email*</h4></label>
        <input type="email" name="email" id="email" class="form-control"  required maxlength="60">
    </div>

    <div class="form-group">
        <label for="telefone"><h4>Telefone*</h4></label>
        <input type="tel" name="telefone" id="telefone" class="form-control" onkeydown="Mascara(this, Telefone);" onkeypress="Mascara(this, Telefone);" onkeyup="Mascara(this, Telefone);" required>
    </div>

    <div class="form-group">
        <label for="cidade"> <h4>Cidade*</h4></label>
        <input type="text" name="cidade" id="cidade" class="form-control"  maxlength="50">
    </div>

    <div class="form-group">
        <label for="estado"><h4>Estado*</h4></label><br/>
        <select name="estado" id="estado">
	
	<option value="AC">Acre</option>
	<option value="AL">Alagoas</option>
	<option value="AP">Amapá</option>
	<option value="AM">Amazonas</option>
	<option value="BA">Bahia</option>
	<option value="CE">Ceará</option>
	<option value="DF">Distrito Federal</option>
	<option value="ES">Espirito Santo</option>
	<option value="GO">Goiás</option>
	<option value="MA">Maranhão</option>
	<option value="MS">Mato Grosso do Sul</option>
	<option value="MT">Mato Grosso</option>
	<option value="MG">Minas Gerais</option>
	<option value="PA">Pará</option>
	<option value="PB">Paraíba</option>
	<option value="PR">Paraná</option>
	<option value="PE">Pernambuco</option>
	<option value="PI">Piauí</option>
	<option value="RJ">Rio de Janeiro</option>
	<option value="RN">Rio Grande do Norte</option>
        <option value="RS" selected="">Rio Grande do Sul</option>
	<option value="RO">Rondônia</option>
	<option value="RR">Roraima</option>
	<option value="SC">Santa Catarina</option>
	<option value="SP">São Paulo</option>
	<option value="SE">Sergipe</option>
	<option value="TO">Tocantins</option>
    </select>
        
    </div>

    <div class="form-group">
        <label for="rg"><h4>RG*</h4></label>
        <input type="text" name="rg" id="rg" class="form-control"  required>
    </div>

  
        <div class="form-group">
            <label><h4>Administrador?</h4></label> <br/>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="admin" value="1" onclick="mostra();" autocomplete="off">Sim
                </label>
                <label class="btn btn-primary active" id="js-btnNaoAluno">
                    <input type="radio" name="admin" value="0" autocomplete="off" onclick="esconde();" checked>Não
                </label>
            </div>
        </div>
    
    <div id="mostrasenha" class="form-group">
        
        <br/><label for='senha'><h4>Senha</h4></label><input type='password' name='senha' id='senha' class='form-control'  title='Não Obrigatório para Inscritos.'>
        
        
    </div>
       <br/>
    (*) Campos Obrigatórios.
    
    <br/><br/>
    
    <button type="submit" class="btn btn-large btn-primary">Cadastrar</button>
  
</form>


<?php

include_once 'rodape.php';

?>
