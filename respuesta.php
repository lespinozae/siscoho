<?php
                    if (isset($_GET)) {
                        if (isset($_GET["r"]) and $_GET["r"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Bien hecho!</strong> Tu registro se guardo correctamente.
                            </div>
                            <?php
                        } elseif (isset($_GET["r"]) and $_GET["r"] == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu registro no se guardo. Contactese con su administrador si el error persiste
                            </div>
                            <?php
                        }
                        elseif (isset($_GET["r"]) and $_GET["r"] == 'p1') {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu registro no se agrego porque existe una periodo en el mismo A&ntilde;o lectivo y Semestre
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET)) {
                        if (isset($_GET["e"]) and $_GET["e"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Bien hecho!</strong> Tu registro se modifico correctamente.
                            </div>
                            <?php
                        } elseif (isset($_GET["e"]) and $_GET["e"] == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu registro no se modifico o posiblemente no realizo cambios. Contactese con su administrador si el error persiste
                            </div>
                            <?php
                        }
                    }
                    ?>

<?php
                    if (isset($_GET)) {
                        if (isset($_GET["ecp"]) and $_GET["ecp"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 100%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Bien hecho!</strong> Tu registro se modifico correctamente.
                            </div>
                            <?php
                        } elseif (isset($_GET["ecp"]) and $_GET["ecp"] == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 100%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu registro no se modifico o posiblemente no realizo cambios. Contactese con su administrador si el error persiste
                            </div>
                            <?php
                        }
                    }
                    ?>

<?php
                    if (isset($_GET)) {
                        if (isset($_GET["d"]) and $_GET["d"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Bien hecho!</strong> Tu registro se elimino correctamente.
                            </div>
                            <?php
                        } elseif (isset($_GET["d"]) and $_GET["d"] == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu registro no se elimino. Contactese con su administrador si el error persiste
                            </div>
                            <?php
                        }
                    }
                    ?>

<?php
                    if (isset($_GET)) {
                        if (isset($_GET["o"]) and $_GET["o"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Bien hecho!</strong> Tu per&iacute;odo se abrio correctamente.
                            </div>
                            <?php
                        } elseif (isset($_GET["o"]) and $_GET["o"] == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu per&iacute;odo no se abrio. Contactese con su administrador si el error persiste
                            </div>
                            <?php
                        }
                    }
                    ?>

<?php
                    if (isset($_GET)) {
                        if (isset($_GET["c"]) and $_GET["c"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Bien hecho!</strong> Tu per&iacute;odo se cerro correctamente.
                            </div>
                            <?php
                        } elseif (isset($_GET["c"]) and $_GET["c"] == 2) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert" style="width: 60%; margin: 0 auto; text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Tu per&iacute;odo no se cerro. Contactese con su administrador si el error persiste
                            </div>
                            <?php
                        }
                    }
                    ?>