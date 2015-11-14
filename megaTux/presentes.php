<?php

include_once 'cabecalho.php';

?>

<div id="imprimir">
      
<h3>Lista dos Presentes - Tchê Linux Pelotas 2015</h3> <br/>

 <table  class="table table-striped" cellspacing="0"   >

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

            </tr>
        </thead>
        <tbody>


            <?php
            
            $sql = "Select * from usuarios where presenca=1 order by nome";
            $listagem = pg_query($dbconn, $sql);

            if ($listagem != NULL) {

                while ($linha = pg_fetch_array($listagem)) {

                   
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

</div>

<?php

include_once 'rodape.php';

?>
