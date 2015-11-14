<?php
include_once 'cabecalho.php';

if ($_GET) {
    if ($_GET['id'] >= 1 && $_GET['id'] <= 3) {

        $escolha = isset($_GET['id']) ? $_GET['id'] : '';

        if ($escolha == 1) {
            $nome = "Atualização 'Sobre o Site'";
        } elseif ($escolha == 2) {
            $nome = "Atualização 'Chamada de Palestrantes'";
        } else {
            $nome = "Atualização 'Chamada de Voluntários'";
        }


        if (isset($_POST['id'], $_POST['texto'])) {


            $texto = pg_escape_string($_POST['texto']);
            $id_conteudo = $_POST['id'];

            $sql = "UPDATE conteudo SET texto='$texto' where id='$id_conteudo'";
            pg_query($dbconn, $sql);

            if ($sql != NULL) {

                $_SESSION['ordmsg'] = "<div class='alert alert-success'>Conteúdo atualizado com Sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            } else {
                $_SESSION['ordmsg'] = "<div class='alert alert-error'> Erro ao atualizar Conteúdo no sistema, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }
        }
        ?>

        <h3><?php echo $nome; ?></h3>
        
  
        <div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])) {echo $_SESSION['ordmsg']; $_SESSION['ordmsg'] = "";} ?></div>

        <hr/> 
        
  <p> Olá, você pode estilizar o conteúdo utilizando tags html. Preferencialmente use os padrões do Bootstrap para melhor customização. ATENÇÃO use com cuidado! ;)</p> </p>


        <form id="inscriajax" method="post">

        <?php
        $sql3 = "Select * from conteudo where id='$escolha' ";
        $listagem3 = pg_query($dbconn, $sql3);

        if ($listagem3 != NULL) {
            while ($linha2 = pg_fetch_array($listagem3)) {
                $id_conteudo = isset($linha2['id']) ? $linha2['id'] : '';
                ?>


                      <div class="form-group">
        <label for="texto"><h4>Texto</h4></label>
       
        <textarea name="texto" id="resumo" class="form-control"><?php echo $linha2['texto']; ?></textarea>
   
    </div>

                    <input type="hidden" name="id" value="<?php echo $id_conteudo; ?>"/>




                <?php
            }
        }
        ?>
            <br/>

            <button type="submit" class="btn btn-large btn-primary">Atualizar</button>  
        </form>

        <?php
    } else {
        echo "<script language='javascript'> window.history.go(-1); </script>";
    }
} else {
    echo "<script language='javascript'> window.history.go(-1); </script>";
}

include_once 'rodape.php';
?>
