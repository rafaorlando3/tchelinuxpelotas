<?php

include_once 'cabecalho.php';

?>

<h3>Listando Organizadores </h3> <br/>

 <table id="example" class="display" cellspacing="0"   >

        <thead>
            <tr>
                <th>
                    <b>Nome</b>
                </th>

                <th>
                    <b>Email</b>
                </th>

                <th>
                    <b>Coordenador?</b>
                </th>

                <th>
                    <b>Ação</b>
                </th>

            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from organizacao order by nome";
            $listagem = pg_query($dbconn, $sql);

            if ($listagem != NULL) {

                while ($linha = pg_fetch_array($listagem)) {

                    $id_organizacao = $linha['id'];
                    ?>

                    <tr>  

                        <td>

                            <?php echo $linha['nome']; ?>
                        </td>

                        <td>

                            <?php echo $linha['email']; ?>
                        </td>

                        <td>

                           <?php if($linha['coordenacao']==0){ echo "<span class='label label-danger' >Não</span>";} else{ echo '<span class="label label-success" >Sim</span>';}  ?>
                        </td>
                        
                      
                        
                        <td align="center" >
                   
                            <form id="organizacao" name="organizacao" method="post" action="edit-organizacao.php" > <input type="hidden" name="id" value="<?php echo $id_organizacao; ?>"/>   <button type="submit" class="btn btn-primary" > Editar <i class="icon-pencil icon-white"></i></button>
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
