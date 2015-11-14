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
          echo "<script language='javascript'> document.location.href='http://tchelinuxpelotas.com/#inscricao'; </script>"; 
         
             } 
             
             else{

            $sql = "INSERT INTO usuarios (nome,telefone,cidade,estado,rg,email,senha,admin,presenca) "
                    . "VALUES ('$nome','$telefone','$cidade', '$estado', '$rg', '$email','$senha','$admin','$presenca')";

            pg_query($dbconn, $sql);

            if ($sql != NULL) {
                
            
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
                
                $mail->Subject  = "Inscricao realizada com sucesso - TCHELINUX"; // Assunto da mensagem
                $mail->Body = 'Voc&ecirc; se inscreveu no <b>TCH&Ecirc;LINUX - PELOTAS 2015</b>, obrigado por participar deste importante evento =D.  <br/> <b>Para mais informa&ccedil;&otilde;es, acesse:</b> <a href="http://tchelinuxpelotas.com" target="_blank">http://tchelinuxpelotas.com</a> ';
                $mail->AltBody = 'Voc&ecirc; se inscreveu no <b>TCH&Ecirc;LINUX - PELOTAS 2015</b>, obrigado por participar deste importante evento =D.  <br/> <b>Para mais informa&ccedil;&otilde;es, acesse:</b> <a href="http://tchelinuxpelotas.com" target="_blank">http://tchelinuxpelotas.com</a> ';
                $enviado = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                
                if ($enviado) {
                    
                   $_SESSION['ordmsg']="<div class='alert alert-success'>Usuário inscrito com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";
                   
                    echo "<script language='javascript'> document.location.href='http://tchelinuxpelotas.com/#inscricao'; </script>"; 
   
                    } else {

                    echo "Informações do erro: " . $mail->ErrorInfo;
                }

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao inscrever usuário no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
               echo "<script language='javascript'> document.location.href='http://tchelinuxpelotas.com/#inscricao'; </script>"; 
   
               
            }
            
             }
        
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tchê Linux - Pelotas RS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">
        

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<!-- Preloader -->
	<div id="preloader">
	  <div id="load"></div>
	</div>

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">
                    <h1>TCHÊLINUX</h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#intro">Início</a></li>
        <li><a href="#sobre">Sobre</a></li>
        <li><a href="#inscricao">Inscrição</a></li>
	<li><a href="#programacao">Programação</a></li>
        <li><a href="#organizacao">Organização</a></li>
        <li><a href="#" data-toggle="modal" data-target="#chamadas">Chamadas </a> </li>  
        <li><a href="#Contato">Contato</a></li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<!-- Section: intro -->
    <section id="intro" class="intro">
	
		<div class="slogan">
			<h2>BEM VINDO <span class="text_color">AO</span> </h2>
			<h2> TCHÊLINUX 2015 - PELOTAS RS</h2>
			<h2> 14 DE NOVEMBRO</h2>
		</div>
		<div class="page-scroll">
			<a href="#sobre" class="btn btn-circle">
				<i class="fa fa-angle-double-down animated"></i>
			</a>
		</div>
    </section><br/><br/>

    
    <!-- Modal: Chamadas -->
                        <div class="modal fade" id="chamadas" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						<div class="modal-dialog">
					    	<div class="modal-content">
						    	<div class="modal-header">
						        	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
						        	<h4 class="modal-title" id="modalLabel">Chamadas</h4>
						     	</div>
						      	<div class="modal-body" id="modalBody">
						      		<h3>Palestrantes</h3>
                                                                <p>
                                                                <form id="cadastros2" method="post" action="chamadas.php" >


                                                                    <div class="form-group">
                                                                        <label for="nome"><h4>Nome Completo*</h4></label>
                                                                        <input type="text" name="nome" id="nome2" class="form-control"  required maxlength="100">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="email"><h4>Email*</h4></label>
                                                                        <input type="email" name="email" id="email2" class="form-control"  required maxlength="60">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="telefone"><h4>Telefone*</h4></label>
                                                                        <input type="tel" name="telefone" id="telefone2" class="form-control" onkeydown="Mascara(this, Telefone);" onkeypress="Mascara(this, Telefone);" onkeyup="Mascara(this, Telefone);" required>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label for="estado"><h4>Eu quero ser:*</h4></label><br/>
                                                                        <select name="chamada" id="estado2">
                                                                            <option value="Palestrante">Palestrante</option>
                                                                        </select>

                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                            <label for="conteudo"><h4>Mensagem</h4></label>

                                                                            <textarea name="conteudo"  class="form-control" required=""></textarea>

                                                                        </div>

                                                                    <br/>
                                                                    Você receberá a confirmação que recebemos seu e-mail, após a confirmação, aguarde que entraremos em contato. <br/>
                                                                    (*) Campos Obrigatórios.

                                                                    <br/><br/>

                                                                    <button type="submit" class="btn btn-large btn-primary">Enviar</button>

                                                                </form>




                                                        </p>
								</div>
								<div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					      		</div>
					    	</div>
						</div>
					</div>
    
    <!-- /Modal: Chamadas -->
       
	<!-- Section: sobre -->
    <section id="sobre" class="Início-section text-center">
		<div class="heading-sobre">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Sobre</h2>
					<i class="fa fa-2x fa-angle-down"></i>

					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">

		
              <?php
                $sql3 = "Select * from conteudo where id=1 ";
                $listagem3 = pg_query($dbconn, $sql3);

                if ($listagem3 != NULL) {
                    while ($linha2 = pg_fetch_array($listagem3)) {
                        ?>
                        <?php echo $linha2['texto']; ?>                                                  


                    <?php
                }
                }
                ?>
                    
                    
		</div>
	</section><br/><br/>
	<!-- /Section: sobre -->
        
          <section id="inscricao" class="Início-section text-center">
		<div class="heading-inscricao">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Inscrição</h2>
					<i class="fa fa-2x fa-angle-down"></i>

					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?> </div>


<br/>
<form id="cadastros" method="post" >
   
    
    <p>A inscrição possui o custo de 2Kg de alimentos não perecíveis que serão doados a instituições de caridade.</p>
    
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

       <br/>
    (*) Campos Obrigatórios.
    
    <br/><br/>
    
    <button type="submit" class="btn btn-large btn-primary">Cadastrar</button>
  
</form>




		</div>
	</section> <br/><br/>
	<!-- /Section: inscricao -->
	

<section id="programacao" class="Início-section text-center">
		<div class="heading-programacao">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Programação</h2>
					<i class="fa fa-2x fa-angle-down"></i>

					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">

		
                     <table class="table table-striped" cellspacing="0"  >

        <thead>
            <tr>
                
                 <th style="text-align:center;">
                    <b>Horário</b>
                </th>
                
                <th style="text-align:center;">
                    <b>Palestra</b>
                </th>
               
                <th style="text-align:center;">
                    <b>Info.</b>
                </th>

            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from programacao order by horario ASC";
            $listagem = pg_query($dbconn, $sql);

            if (pg_num_rows($listagem) > 0) {

                while ($linha = pg_fetch_array($listagem)) {

                    $id_palestra = $linha['id'];
                    ?>

                    <tr>  

                        <td style="text-align:center;">

                             <?php echo $linha['horario']; ?>
                        </td>

                        <td style="text-align:center;">

                            <?php echo $linha['palestra']; ?>
                        </td>
                        <td style="text-align:center;" >
                        <a href="#" style="color:#D97655" data-toggle="modal" data-target="#<?php echo $id_palestra ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        
                        
                        
                        
                        <div class="modal fade" id="<?php echo $id_palestra ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						<div class="modal-dialog">
					    	<div class="modal-content">
						    	<div class="modal-header">
						        	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
						        	<h4 class="modal-title" id="modalLabel"><?php echo $linha['palestra']; ?></h4>
						     	</div>
						      	<div class="modal-body" id="modalBody">
						      		<h3>Resumo</h3>
						      		<p><?php echo $linha['resumo']; ?></p>
						      		<h3>Mini-currículo</h3>
						      		<p><?php echo $linha['curriculo']; ?> </p>
								</div>
								<div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					      		</div>
					    	</div>
						</div>
					</div>
                        
                        
                        
                        </td>


                    </tr> 
                    <?php
                }
            } else {
                ?>   

            <td style="text-align:center;">
               Disponível em breve.
            </td>
            <td style="text-align:center;">
                Disponível em breve.
            </td>
            <td style="text-align:center;">
                
            </td>
         



            <?php
        }
        ?>

        </tbody>
        <tfoot></tfoot>



    </table>
                    
                    
		</div>
	</section><br/><br/>
	<!-- /Section: programação -->
        
         <section id="organizacao" class="Início-section text-center">
		<div class="heading-organizacao">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Organização</h2>
					<i class="fa fa-2x fa-angle-down"></i>

					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">
                    
                    <h2>Coordenadores</h2>

		
                     <table class="table table-striped" cellspacing="0"   >

        <thead>
            <tr>
                <th style="text-align:center;">
                    <b>Nome</b>
                </th>

                <th style="text-align:center;" >
                    <b>Email</b>
                </th>


            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from organizacao where coordenacao=1 order by nome";
            $listagem = pg_query($dbconn, $sql);

            if ($listagem != NULL) {

                while ($linha = pg_fetch_array($listagem)) {

                    $id_organizacao = $linha['id'];
                    ?>

                    <tr>  

                        <td style="text-align:center;">

                            <?php echo $linha['nome']; ?>
                        </td>

                        <td style="text-align:center;">

                            <?php echo $linha['email']; ?>
                        </td>


                    </tr> 
                    <?php
                }
            } else {
                ?>   

            <td style="text-align:center;">
                Em breve.
            </td>
            <td style="text-align:center;">
                Em breve.
            </td>

            <?php
        }
        ?>

        </tbody>
        <tfoot></tfoot>



    </table> <br/><br/>
                    
                    
             <h2>Equipe Organizadora</h2>

		
                     <table class="table table-striped" cellspacing="0"   >

        <thead>
            <tr>
                <th style="text-align:center;" >
                    <b>Nome</b>
                </th>

                <th style="text-align:center;">
                    <b>Email</b>
                </th>


            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from organizacao where coordenacao=0 order by nome";
            $listagem = pg_query($dbconn, $sql);

            if ($listagem != NULL) {

                while ($linha = pg_fetch_array($listagem)) {

                    $id_organizacao = $linha['id'];
                    ?>

                    <tr>  

                        <td style="text-align:center;">

                            <?php echo $linha['nome']; ?>
                        </td>

                        <td style="text-align:center;">

                            <?php echo $linha['email']; ?>
                        </td>


                    </tr> 
                    <?php
                }
            } else {
                ?>   

            <td style="text-align:center;">
                Em breve.
            </td>
            <td style="text-align:center;">
                Em breve.
            </td>

            <?php
        }
        ?>

        </tbody>
        <tfoot></tfoot>



    </table>
                    
                    
                    
                    
                    
		</div>
	</section><br/><br/>
	<!-- /Section: organização -->
	

	

	<!-- Section: Contato -->
    <section id="Contato" class="Início-section text-center">
		<div class="heading-Contato">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Entre em Contato</h2>
					<i class="fa fa-2x fa-angle-down"></i>

					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">
                  

		<div class="row">
			<div class="col-lg-2 col-lg-offset-5">
				<hr class="marginbot-50">
			</div>
		</div>
    <div class="row">
        <div class="col-lg-8">
            <div class="boxed-grey">
                <form id="Contato-form" method="post" action="contato.php">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Nome</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="nome" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu Email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Assunto</label>
                            <select id="subject" class="form-control" name="subject" required="required">
                                <option value="na" selected="">Selecione</option>
                                <option value="Reclamacao">Reclamação</option>
                                <option value="Duvida">Dúvida</option>
                                <option value="Sugestao">Sugestão</option>
                                <option value="Outro">Outro</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Mensagem</label>
                            <textarea name="mensagem" id="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Digite sua Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-skin pull-right" id="btnContatoUs">
                            Enviar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
		
		<div class="col-lg-4">
			<div class="widget-Contato">
				<h5>Local</h5>
				<address>
				  <strong>Campus Anglo/Porto, Universidade Federal de Pelotas (UFPel) </strong><br>
				  Rua Gomes Carneiro, 1, 4º Andar - Porto - CEP 96010-61<br>
				  <abbr title="Phone"></abbr> 
				</address>

				<address>
				  <strong>Email</strong><br>
				  <a href="mailto:#">contato@tchelinuxpelotas.com</a>
				</address>	
				<address>
				  <strong>Redes sociais</strong><br>
                       	<ul class="company-social">
                            <li class="social-facebook"><a href="https://www.facebook.com/pelotastchelinux/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li class="social-twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="social-dribble"><a href="#" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                            <li class="social-google"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>	
				</address>					
			
			</div>	
		</div>
    </div>	

		</div>
	</section>
	<!-- /Section: Contato -->

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="wow shake" data-wow-delay="0.4s">
					<div class="page-scroll marginbot-30">
						<a href="#intro" id="totop" class="btn btn-circle">
							<i class="fa fa-angle-double-up animated"></i>
						</a>
					</div>
					</div>
					<p>GNU General Public License 2</p>
				</div>
			</div>	
		</div>
	</footer>

    <!-- Core JavaScript Files -->
      <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/validacao.js"></script>
     <script type="text/javascript" src="js/validacao2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>	
    <script src="js/jquery.scrollTo.js"></script>
    <script src="js/wow.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js"></script>

</body>

</html>
