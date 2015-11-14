 <?php
                                                                    $sql3 = "Select * from conteudo where id=2 ";
                                                                    $listagem3 = pg_query($dbconn, $sql3);

                                                                    if ($listagem3 != NULL) {
                                                                        while ($linha2 = pg_fetch_array($listagem3)) {
                                                                            ?>
                                                                            <?php echo $linha2['texto']; ?>                                                  


                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                    
                                                                </p>
						      		<h3>Para Voluntários</h3>
						      		<p>
                                                                
                                                                         <?php
                                                                    $sql3 = "Select * from conteudo where id=3 ";
                                                                    $listagem3 = pg_query($dbconn, $sql3);

                                                                    if ($listagem3 != NULL) {
                                                                        while ($linha2 = pg_fetch_array($listagem3)) {
                                                                            ?>
                                                                            <?php echo $linha2['texto']; ?>                                                  


                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                    