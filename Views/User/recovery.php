<div class="container">

    <div class="mt-3">
        <h3>Recuperar contraseña</h3>
    </div>
    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        <strong>Importante: </strong> SEAC enviará un código de verficación a su correo electronico para que pueda
        recuperar la contraseña.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div>
        <form action="?controller=usuario&action=RecEmailVerify" method="post">
            <div class="mt-3">
                <label for="email">Correo electronico:</label>
                <input type="text" class="form-control" name="email" id="email" required="true" autocomplete="off">
            </div>
            <!-- devonline -->
            <div class="g-recaptcha mt-3 d-flex justify-content-center"
                data-sitekey="6LeB3DMaAAAAANV87igPwsmbJFIk2dQrYTjNVOi0"></div>

            <!-- prod -->
            <!-- <div class="g-recaptcha mt-3 d-flex justify-content-center" data-sitekey="6LeB3DMaAAAAANV87igPwsmbJFIk2dQrYTjNVOi0"></div> -->

            <!-- devlocal -->
            <!-- <div class="g-recaptcha mt-3 d-flex justify-content-center" data-sitekey="6Le1qVEdAAAAAIfyXxddWFvKxRoiOsFz0cBeMJDp"></div> -->

            <div class="mt-2 d-flex justify-content-center">
                <button type="button" class="btn btn-success  mx-2"
                    onclick="location.href='?controller=usuario&action=showLogin'"><span class="p-1"><i
                            class="fas fa-undo-alt"></i></span>Volver</button>
                <button type="submit" class="btn btn-success  mx-2"><span class="p-1"><i
                            class="fas fa-envelope"></i></span>Enviar codigo</button>
                <button type="button" class="btn btn-success  mx-2"
                    onclick="location.href='?controller=usuario&action=recoverySms'" hidden><span class="p-1"><i
                            class="fas fa-mobile-alt"></i></span>SMS</button>
            </div>
        </form>
    </div>
</div>