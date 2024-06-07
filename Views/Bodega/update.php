<div class="container mt-5">
    <div class="alert alert-info text-center" role="alert">
        Actualización
    </div>
    <form action="?controller=bodega&action=update" class="" method="POST">
        <input type="hidden" name="id" value="<?php echo $bodega->getId(); ?>">
        <div class="row g-3">
            <div class="col">
                <label for="codigo">Codigo:</label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                    value="<?php echo $bodega->getCodigo(); ?>">
            </div>
            <div class="col">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?php echo $bodega->getNombre(); ?>">
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col">
                <label for="departamento">Departamento:</label>
                <select class="form-select" name="departamento" id="departamento" aria-label="Default select example">
                    <?php $departamento = Catalogos::getDepartamentoById($bodega->getDepartamento()); ?>
                    <option value="<?php echo $departamento->getId(); ?>" selected>
                        <?php echo $departamento->getDescripcion(); ?>
                    </option>
                </select>
            </div>
            <div class="col">
                <label for="municipio">Municipio:</label>
                <select class="form-select" name="municipio" id="municipio" aria-label="Default select example">
                    <?php $municipio = Catalogos::getMunicipioById($bodega->getMunicipio()); ?>
                    <option value="<?php echo $municipio->getId(); ?>" selected>
                        <?php echo $municipio->getDescripcion(); ?>
                    </option>
                </select>
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col">
                <label for="direccion">Direccion:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $bodega->getDireccion();?>">
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary "><svg xmlns="http://www.w3.org/2000/svg" width="15"
                        height="15" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                        <path
                            d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z" />
                    </svg> Actualizar Bodega </button>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-success"
                    onclick="location.href='?controller=bodega&action=show'"><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                    </svg> Cancelar </button>
            </div>
        </div>
    </form>
</div>
<script>
    document.getElementById('departamento').addEventListener('mousedown', function (e) {
        e.preventDefault();
        this.blur();
        return false;
    });
    document.getElementById('municipio').addEventListener('mousedown', function (e) {
        e.preventDefault();
        this.blur();
        return false;
    });
</script>