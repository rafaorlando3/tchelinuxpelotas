<?php

include_once 'cabecalho.php';

?>

<h3>Listando Programação </h3> <br/>

 <table id="example" class="display" cellspacing="0"  >

        <thead>
            <tr>
                <th>
                    <b>Palestra</b>
                </th>

                <th>
                    <b>Resumo</b>
                </th>

                <th>
                    <b>Horário</b>
                </th>

                <th>
                    <b>Ação</b>
                </th>

            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from programacao order by palestra";
            $listagem = pg_query($dbconn, $sql);

            if ($listagem != NULL) {

                while ($linha = pg_fetch_array($listagem)) {

                    $id_palestra = $linha['id'];
                    ?>

                    <tr>  

                        <td>

                            <?php echo $linha['palestra']; ?>
                        </td>

                        <td>

                            <?php echo $linha['resumo']; ?>
                        </td>

                        <td>

                            <?php echo $linha['horario']; ?>
                        </td>
                        
                      
                        
                        <td align="center" >
                   
                            <form id="usuarios" name="usuarios" method="post" action="edit-palestra.php" > <input type="hidden" name="id" value="<?php echo $id_palestra; ?>"/>   <button type="submit" class="btn btn-primary" > Editar <i class="icon-pencil icon-white"></i></button>
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
