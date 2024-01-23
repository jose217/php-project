<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-seac rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://seac.motion.sv" style="color: rgba(255,255,255,.55);">
            <!-- <img src="Img/baa.png" alt="SEAC" width="35" height="45"> -->
            <span class="p-2"></span>SEAC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (($_SESSION['usuario_alias'] == "Administrador")) { ?>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Seguridad
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=usuario&action=showUsuarios">Usuarios</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=usuario&action=recovery">Restablecer Contraseña</a></li>
                        </ul>

                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catalogos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=catalogos&action=showTNegocio">Tipo de Negocio</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=catalogos&action=showEMedidor">Estado Medidor</a></li>
                            <hr>                            
                            <li><a class="dropdown-item" href="?controller=mesActivo&action=show">Mes Activo</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=catalogos&action=showMotivoInspeccion">Motivo de Inspección</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Estructura Residencial
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=residencia&action=show">Residencial</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=etapa&action=show">Etapa/Cluster/Quartier/Otro</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=poligono&action=show">Poligono</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=lote&action=show">Casa</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Toma de Lectura
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=evaluacionV&action=show">Lecturas</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=evaluacionV&action=showHistoCambios">Historial de cambios</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=evaluacionV&action=showGenerateReport">Generar Informe</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Inspecciones
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=InspeccionSolicitud&action=show">Solicitud de Inspección</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="?controller=Inspeccion&action=show">Inspección</a></li>
                        </ul>
                    </li>                    
                <?php }
                if (($_SESSION['usuario_alias'] == "Tecnico")) { ?>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Toma de Lectura
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=evaluacionV&action=showLecturaEMP">Lecturas</a></li>
                        </ul>
                    </li>
                    <?php   ?>
                <?php }
                if (($_SESSION['usuario_alias'] == "Atencion")) { ?>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Inspecciones
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?controller=evaluacionV&action=showLecturaEMP">Lecturas</a></li>
                        </ul>
                    </li>
                    <?php
                }
                if (($_SESSION['usuario_alias'] == NULL)) { ?>

                <?php  } ?>
            </ul>
            <?php if (isset($_SESSION['usuario'])) { ?>
                <?php
                $path = $_SERVER['DOCUMENT_ROOT'] . '/Controllers/resources/photos/';
                $file = 'default.png';
                $url = $path . $file;
                $image = base64_encode(file_get_contents($url));
                ?>
                <li class="dropdown list-unstyled">
                    <a class="nav-link text-decoration-none text-secondary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="data:image/x-icon;base64,<?= $image ?>" class="rounded" width="30" height="30" id="image">
                        <span class="p-2"><?php echo $_SESSION['usuario_nombres'] ." ". $_SESSION['usuario_apellidos'] . '(' . $_SESSION['usuario_alias'] . ')'; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="?controller=usuario&action=logout">
                                <span class="p-2">
                                    <i class="fas fa-sign-out-alt"></i>
                                </span>Cerrar Sesion
                            </a>
                        </li>
                    </ul>
                </li>

                <script type="text/javascript">
                    $(window).resize(function() {
                            // console.log('resize');
                            var width = $(window).width();
                            if (width < 960) {
                                $('ul').removeClass('dropdown-menu-end');
                            }
                        })
                        .resize();
                </script>
            <?php } else { ?>

                <li class="nav-item list-unstyled p-2">
                    <a class="text-decoration-none text-secondary" href="?controller=usuario&action=showLogin">
                        <i class="fas fa-sign-in-alt"></i>
                        Entrar
                    </a>
                </li>
            <?php } ?>
            <!-- </div> -->
        </div>
    </div>
</nav>