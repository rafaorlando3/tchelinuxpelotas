<?php
include_once '../BD/conecta.php';
date_default_timezone_set('America/Sao_Paulo');

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

session_start();

$iduser = isset($_SESSION['iduser']) ? $_SESSION['iduser'] : '';
$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';


if ($nome != NULL && $admin == 1) {
    
} else {
    echo "<script>javascript:history.back(-1)</script>";
}
?>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administração Tchê Linux</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/datatablecss/jquery.dataTables.css">
        <script type="text/javascript" language="javascript" src="js/datatablejs/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="js/datatablejs/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/datatablejs/demo.js"></script>
        
         <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/validacao.js"></script>
        
         <script type="text/javascript" language="javascript" class="init">
            var $$$ = jQuery.noConflict();
            $$$(document).ready(function () {
                $$$('#example').DataTable();
            });
            function oculta() {
                document.getElementById('mensagem').innerHTML = "";
            }
        </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="inicio.php">
                        Administração Tchê Linux
                    </a>
                    
                    
                </li>
                <li>
                    <a href="usuario-add.php">Inscrever Usuário</a>
                </li>
                <li>
                    <a href="programacao-add.php">Cadastrar Programação</a>
                </li>
                <li>
                    <a href="organizacao-add.php">Cadastrar Organização</a>
                </li>
                
                 <li class="dropdown">
    <a class="dropdown-toggle"
       data-toggle="dropdown"
       href="#">
        Conteúdos
        <b class="caret"></b>
      </a>
                     <ul class="dropdown-menu" style=" background-color: black;">
      <a href="conteudo.php?id=1">Sobre o Tchê Linux</a>
      <a href="conteudo.php?id=2">Trabalhadores</a>
      <a href="conteudo.php?id=3">Voluntários</a>
    </ul>
  </li>
                
                <li>
                    <a href="usuarios.php">Inscritos / Usuários</a>
                </li>
                <li>
                    <a href="programacao.php">Lista Programação</a>
                </li>
                <li>
                    <a href="organizacao.php">Lista Organização</a>
                </li>
                <li>
                    <a href="presentes.php">Lista Presentes </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <center>
                        
 Olá, <?php echo $nome; ?><br/> 
                     
 <a href="usuarionow.php"> Editar  </a> | <a href="logout.php"> Sair[->]</a> <hr/>