<div class="container">
  <div class="card mt-3" style="width: 25rem;">
    <div class="card-body">
      <h5 class="card-title">Recuperar contraseña a traves de mensaje de texto.</h5>
      <form action="" method="post">
        <div class="row">
          <div class="form-group">
            <label for="telefono" class="col-form-label">N° telefono:</label>
            <div class="col-sm-6 col-xs-4 col-md-6 mb-2">
              <input class="form-control" id="" name="telefono" type="number">
            </div>
          </div>
        </div>
        <div>
          <button type="button" class="btn btn-success"
            onclick="location.href='?controller=usuario&action=recovery'">Volver</button>
          <button type="submit" class="btn btn-success">Enviar Código</button>
        </div>
      </form>
    </div>
  </div>
</div>