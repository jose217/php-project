<div class="container">
    <form action="?controller=usuario&action=newPwd" method="post" class="mt-4">
        
        <div class="d-flex justify-content-center mt-2">
            <label for="pwd">Nueva contrase&ntilde;a:</label>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <input type="text" name="pwd" id="pwd" class="text-center form-control">
        </div>
        <div class="d-flex justify-content-center mt-2">
            <label for="pwd2">Confirmar contrase&ntilde;a:</label>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <input type="text" name="pwd2" id="pwd2" class="text-center form-control">
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-success"><span class="p-2"><i class="far fa-thumbs-up"></i></span>Confirmar</button>
        </div>

        <script>
            $("#form").validate({rules:{pwd:{minlength:4,maxlength:25,},pwd2:{equalTo:"#pwd",minlength:4,maxlength:25}},
            messages:{pwd:{minlength:"<div class='mt-3 alert alert-danger' role='alert'>La contraseña no puede ser menor de 4 caracteres</div>",maxlength:"<div class='alert alert-danger' role='alert'>La contraseña no puede ser mayor de 25 caracteres</div>" },
            pwd2:{equalTo:"<div class='mt-3 alert alert-danger' role='danger'>La contraseña debe ser igual a la anterior",minlength:"<div class='mt-3 alert alert-danger' role='alert'>La contraseña no puede ser menor de 4 caracteres</div>", maxlength:"<div class='alert alert-danger' role='alert'>La contraseña no puede ser mayor de 25 caracteres</div>" }}});
        </script>
    </form>
</div>