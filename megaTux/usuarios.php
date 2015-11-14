<?php

include_once 'cabecalho.php';

if(isset($_POST['id'])){
    
    $iduser=$_POST['id'];
    
       $sql3 = "Select * from usuarios where id='$iduser' ";
            $listagem3 = pg_query($dbconn, $sql3);

            if ($listagem3 != NULL) {
                while ($linha2 = pg_fetch_array($listagem3)) {
                    $id_usuario = isset($linha2['id']) ? $linha2['id'] : '';
                    
    $nome = $linha2['nome'];;
    $telefone = $linha2['telefone'];
    $cidade = $linha2['cidade'];;
    $estado = $linha2['estado'];;
    $rg = $linha2['rg'];
    $email =$linha2['email'];
    $senha = $linha2['senha'];
    $admin= $linha2['admin'];
    $presenca=1;
    
     $sql = "UPDATE usuarios SET nome='$nome',telefone='$telefone', cidade='$cidade',estado='$estado',rg='$rg',email='$email', senha='$senha',admin='$admin',presenca='$presenca' where id='$iduser'";
         pg_query($dbconn, $sql);

            if ($sql != NULL) {

                $_SESSION['ordmsg']="<div class='alert alert-success'>Presença registrada com sucesso! <button type='button' class='close' data-dismiss='alert'>×</button></div>";

            } else {
               $_SESSION['ordmsg']= "<div class='alert alert-error'> Erro ao registrar presença, tente novamente mais tarde. <button type='button' class='close' data-dismiss='alert'>×</button></div>";
            }                
                }
            }
    
}

?>

<h3>Listando Usuários </h3> <br/>

<div id="mensagem"> <?php if (isset($_SESSION['ordmsg'])){ echo $_SESSION['ordmsg']; $_SESSION['ordmsg']=""; } ?></div>

 <table id="example" class="display" cellspacing="0"   >

        <thead>
            <tr>
                <th>
                    <b>Nome</b>
                </th>

                <th>
                    <b>RG</b>
                </th>

                <th>
                    <b>Email</b>
                </th>

                <th>
                    <b>Telefone</b>
                </th>
                
                <th>
                    <b>Presença</b>
                </th>

                <th>
                    <b>Ação</b>
                </th>

            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from usuarios where admin=0 order by nome";
            $listagem = pg_query($dbconn, $sql);

            if ($listagem != NULL) {

                while ($linha = pg_fetch_array($listagem)) {

                    $id_usuario = $linha['id'];
                    ?>

                    <tr>  

                        <td>

                            <?php echo $linha['nome']; ?>
                        </td>

                        <td>

                            <?php echo $linha['rg']; ?>
                        </td>

                        <td>

                            <?php echo $linha['email']; ?>
                        </td>

                        <td>

                            <?php echo $linha['telefone']; ?>
                        </td>
                        
                        <td>

                            <?php if($linha['presenca']==0){ echo "<span class='label label-danger' >Sem Presença</span>";} else{ echo '<span class="label label-success" >Presente</span>';}  ?>
                        </td>
                        
                        <td align="center" >
                            
                            <?php if($linha['presenca']==0){ echo ' <form  id="presenca" name="presenca" method="post" > <input type="hidden" name="id" value="'.$id_usuario.'"/>   <button type="submit" class="btn btn-success" > Presença </button>
                            </form>';} ?>
                            
                            <form id="usuarios" name="usuarios" method="post" action="edit-usuario.php" > <input type="hidden" name="id" value="<?php echo $id_usuario; ?>"/>   <button type="submit" class="btn btn-primary" > Editar <i class="icon-pencil icon-white"></i></button>
                            </form>
                            
                            

                        </td>


                    </tr> 
                    <?php
                }
            } else {
                ?>   

            <td>
                Sem Registro.
            </td>
            <td>
                Sem Registro.
            </td>
            <td>
                Sem Registro.
            </td>
            <td>
                Sem Registro.
            </td>



            <?php
        }
        ?>

        </tbody>
        <tfoot></tfoot>



    </table>



<?php

include_once 'rodape.php';

?>
