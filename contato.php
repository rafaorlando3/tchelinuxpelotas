<?php  

if(isset($_POST['nome'],$_POST['email'],$_POST['subject'],$_POST['mensagem'])){
    
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $assunto=$_POST['subject'];
    $mensagem=$_POST['mensagem'];
    
    
    require("class/class.phpmailer.php");
                $mail = new PHPMailer();
                $mail->IsSMTP(); // Define que a mensagem será SMTP
                $mail->Host = "smtp.tchelinuxpelotas.com"; // Endereço do servidor SMTP
                $mail->SMTPAuth = true; // Autenticação
                $mail->Username = 'contato@tchelinuxpelotas.com'; // Usuário do servidor SMTP
                $mail->Password = 'tux2255'; // Senha da caixa postal utilizada
                $mail->From = "contato@tchelinuxpelotas.com"; 
                $mail->FromName = "TCHELINUX PELOTAS 2015";
                
                $mail->AddAddress($email, $nome);
                $mail->AddAddress($email);
                $mail->AddCC('contato@tchelinuxpelotas.com', 'Copia'); 
                $mail->AddBCC('contato@tchelinuxpelotas.com', 'Copia Oculta');
                $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
                
                $mail->Subject  = "Recebemos o seu email - TCHELINUX"; // Assunto da mensagem
                $mail->Body = 'Obrigado por entrar em contato com o <b>TCH&Ecirc;LINUX - PELOTAS 2015</b>, em breve entraremos em contato. <br/> <br/> <b>Observa&ccedil;&atilde;o:</b> N&atilde;o responda esse email, ele &eacute; autom&aacute;tico. ';
                $mail->AltBody = 'Obrigado por entrar em contato com o <b>TCH&Ecirc;&Ecirc;&Ecirc;&Ecirc;LINUX - PELOTAS 2015</b>, em breve entraremos em contato. <br/> <br/> <b>Observa&ccedil;&atilde;o:</b> N&atilde;o responda esse email, ele &eacute; autom&aacute;tico.';
                $enviado = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                if ($enviado) {
                    
                    $mail = new PHPMailer();
                $mail->IsSMTP(); // Define que a mensagem será SMTP
                $mail->Host = "smtp.tchelinuxpelotas.com"; // Endereço do servidor SMTP
                $mail->SMTPAuth = true; // Autenticação
                $mail->Username = 'contato@tchelinuxpelotas.com'; // Usuário do servidor SMTP
                $mail->Password = 'tux2255'; // Senha da caixa postal utilizada
                $mail->From = "contato@tchelinuxpelotas.com"; 
                $mail->FromName = "TCHELINUX PELOTAS 2015";
                
                $mail->AddCC('contato@tchelinuxpelotas.com', 'Copia'); 
                $mail->AddBCC('contato@tchelinuxpelotas.com', 'Copia Oculta');
                $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
                
                $mail->Subject  = "$assunto - Formulario de contato TCHELINUX"; // Assunto da mensagem
                $mail->Body = 'O usu&aacute;rio: <b> '.$nome.' </b> enviou a seguinte mensagem: <br/><br/> '.$mensagem.' <br/><br/> O email de contato do mesmo &eacute; <b>'.$email.'</b>  ';
                $mail->AltBody = 'O usu&aacute;rio: <b>'.$nome.'</b> enviou a seguinte mensagem: <br/><br/> '.$mensagem.' <br/><br/> O email de contato do mesmo &eacute; <b>'.$email.'</b> ';
                $enviado = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                if ($enviado) {
                    
                                 
               echo "<script language='javascript'> alert('Email enviado com Sucesso!'); document.location.href='http://tchelinuxpelotas.com'; </script>";

           
                    } else {

                    echo "Informações do erro: " . $mail->ErrorInfo;
                }
                    
                    
       
                    } else {

                    echo "Informações do erro: " . $mail->ErrorInfo;
                }
                
                
                
                

            }

?>