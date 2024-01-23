<div class="container">
    <div id="error" class="alert mt-4 alert-warning mt-3" role="alert">Se ha enviado un codigo a su correo electronico,
        para la activación de su cuenta.</div>
    <h2 class="mt-4 md-3">
        Confirmar correo
    </h2>

    <div>
        <form action="?controller=usuario&action=confirmation" method="post" class="mt-4">
            <div>

            </div>
            <div class="">
                <label for="acode">Ingrese el codigo de confirmación: </label>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <input type="text" name="acode" id="acode" class="text-center form-control" placeholder="_ _ _ _">
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success"><span class="p-2"><i
                            class="far fa-thumbs-up"></i></span>Confirmar</button>
            </div>
        </form>
    </div>
</div>