<?php  

if(isset($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['chamada'],$_POST['conteudo'])){
    
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $assunto=$_POST['chamada'];
    $telefone=$_POST['telefone'];
    $mensagem=$_POST['conteudo'];
    
    
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
                $mail->AddCC('tchelinux@getsitesolucoes.com.br', 'Copia'); 
                $mail->AddBCC('tchelinux@getsitesolucoes.com.br', 'Copia Oculta');
                $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
                
                $mail->Subject  = "Recebemos o seu email - TCHE LINUX"; // Assunto da mensagem
                $mail->Body = 'Obrigado por entrar em contato com o <b>TCHE LINUX - PELOTAS 2015</b>,em breve entraremos em contato a respeito de '.$assunto.'. <br/> <br/> <b>Observacao:</b> Nao responda esse email, ele e automatico. ';
                $mail->AltBody = 'Obrigado por entrar em contato com o <b>TCHE LINUX - PELOTAS 2015</b>,em breve entraremos em contato a respeito de '.$assunto.'. <br/> <br/> <b>Observacao:</b> Nao responda esse email, ele e automatico.';
                $enviado = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                if ($enviado) {
                    
                    $mail = new PHPMailer();
                $mail->IsSMTP(); // Define que a mensagem será SMTP
                $mail->Host = "smtp.getsitesolucoes.com.br"; // Endereço do servidor SMTP
                $mail->SMTPAuth = true; // Autenticação
                $mail->Username = 'tchelinux@getsitesolucoes.com.br'; // Usuário do servidor SMTP
                $mail->Password = 'tux2255'; // Senha da caixa postal utilizada
                $mail->From = "tchelinux@getsitesolucoes.com.br"; 
                $mail->FromName = "TCHE LINUX PELOTAS 2015";
                
                $mail->AddAddress("juniornd@yahoo.com.br", $nome);
                $mail->AddAddress("juniornd@yahoo.com.br");
                $mail->AddCC('tchelinux@getsitesolucoes.com.br', 'Copia'); 
                $mail->AddBCC('tchelinux@getsitesolucoes.com.br', 'Copia Oculta');
                $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
                
                $mail->Subject  = "$assunto - Formulario de Chamadas - TCHE LINUX"; // Assunto da mensagem
                $mail->Body = 'O usuario <b> '.$nome.' </b> enviou a seguinte mensagem: <br/><br/> '.$mensagem.' <br/><br/> O email de contato do mesmo é <b>'.$email.'</b> <br/><br/> Telefone: <b>'.$telefone.'</b>  ';
                $mail->AltBody = 'O usuario <b>'.$nome.'</b> enviou a seguinte mensagem: <br/><br/> '.$mensagem.' <br/><br/> O email de contato do mesmo é <b>'.$email.'</b> <br/><br/> Telefone: <b>'.$telefone.'</b> ';
                $enviado = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                if ($enviado) {
                    
                                 
               echo "<script language='javascript'> alert('Email enviado com Sucesso!'); document.location.href='http://tchelinux.getsitesolucoes.com.br'; </script>";

           
                    } else {

                    echo "Informações do erro: " . $mail->ErrorInfo;
                }
                    
                    
       
                    } else {

                    echo "Informações do erro: " . $mail->ErrorInfo;
                }
                
                
                
                

            }

            echo "<script language='javascript'> alert('Você não digitou os campos corretamente.'); document.location.href='http://tchelinux.getsitesolucoes.com.br'; </script>";
?>