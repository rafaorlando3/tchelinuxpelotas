<?php

include_once "cabecalho.php";

 $sql = "select count(*) from usuarios where admin=0 ";
            $total = pg_query($dbconn, $sql);
            $total=pg_fetch_row($total);
            $total=$total[0];
            

 ?>

<h3>Bem vindo ao Sistema do Site TCHÊ LINUX - PELOTAS 2015</h3> <br/>
<h1>Total de Inscritos até o momento</h1>
<h1 style="color:green; font-size: 100px;"><b><?php echo $total;?></b></h1><br/>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Mágica</a>
                        
                       
<?php

include_once "rodape.php";

 ?>

