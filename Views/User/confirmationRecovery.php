<div class="container">
    <div id="error" class="alert mt-4 alert-warning mt-3" role="alert">Para restablecer su contrase&ntilde;a es
        necesario ingresar el código de verificación enviado a su correo electronico. Revise su bandeja de correo
        electronico, secci&oacute;n spam(correo no deseado).</div>
    <h2 class="mt-4 md-3">
        Confirmar correo
    </h2>

    <div>
        <form action="?controller=usuario&action=confRecovery" method="post" class="mt-4" id="form" name="form"
            autocomplete="off">
            <div class="row g-3 align-items-center">
                <label for="acode">Ingrese el c&oacute;digo de confirmaci&oacute;n: </label>
                <div class="col-auto form-group">
                    <input type="text" name="acode" id="acode" class="text-center form-control" placeholder=""
                        maxlength="6" autocomplete="off" spellcheck="false">
                </div>
                <div class="col-auto form-group">
                    <button type="button" class="btn btn-primary " id="sig" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop" disabled>Siguiente</button>
                </div>
            </div>


            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="alert alert-danger" id="alerta" role="alert" hidden>
                                Contraseñas no coinciden !!
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <label for="pwd">Nueva contrase&ntilde;a:</label>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <input type="password" name="pwd" id="pwd" class="text-center form-control"
                                    autocomplete="off" spellcheck="false">
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <label for="pwd2">Confirmar contrase&ntilde;a:</label>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <input type="password" name="pwd2" id="pwd2" class="text-center form-control"
                                    autocomplete="off" spellcheck="false">
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-success" id="submit"><span class="p-2"><i
                                            class="far fa-thumbs-up"></i></span>Finalizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var code = document.getElementById('acode');
    var boton = document.getElementById('sig');

    code.addEventListener('keyup', function () {
        if (this.value.length === 6) {
            boton.disabled = false;
        } else {
            boton.disabled = true;
        }
    })
</script>