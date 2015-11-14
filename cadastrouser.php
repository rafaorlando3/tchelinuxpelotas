<?php

include_once 'BD/conecta.php';


if (isset($_POST['nome'], $_POST['telefone'], $_POST['estado'], $_POST['cidade'], $_POST['email'], $_POST['rg'])) {


    $nome = pg_escape_string($_POST['nome']);
    $telefone = pg_escape_string($_POST['telefone']);
    $cidade = pg_escape_string($_POST['cidade']);
    $estado = pg_escape_string($_POST['estado']);
    $rg = pg_escape_string($_POST['rg']);
    $email = pg_escape_string($_POST['email']);
    $senh = pg_escape_string('p4dr40');
    $senha=  base64_encode($senh);
    $admin = 0;
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
                
                
                
                require("class/class.phpmailer.php");
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
                $mail->Body = 'Você se inscreveu no <b>TCHÊ LINUX - PELOTAS 2015</b>, obrigado por participar deste importante evento =D.  <br/> <b>Para mais informações, acesse:</b> http://tchelinux.getsitesolucoes.com.br ';
                $mail->AltBody = 'Você se inscreveu no <b>TCHÊ LINUX - PELOTAS 2015</b>, obrigado por participar deste importante evento =D.  <br/> <b>Para mais informações, acesse:</b> http://tchelinux.getsitesolucoes.com.br ';
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