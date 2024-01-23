<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
    <div class="mt-3">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="?controller=etapa&action=register" role="tab" aria-controls="nav-home" aria-selected="true">Formulario Principal</a>
          <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#" role="tab" aria-controls="nav-profile" aria-selected="false">Consolidado</a>
        </div>
      </nav>   
    </div>
  <div>
  <h2 class="mt-3 ">Registro de Etapa</h2>
  </div>
	<form action="?controller=etapa&action=save" method="post" name="formulario">
      <div class="">
        <label for="proyectoId" class="col-auto col-form-label">Proyecto:</label>
        <div class="col-auto">
          	<select type="select"  name="proyectoId" class="form-select" id="proyectoId" required="true">
			        <?php foreach($GET_PROJ_ID as $row){ ?>
			        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getCodigo(); ?></option>
			        <?php } ?>
			      </select>
        </div>
      </div>
      
      <div class="d-flex flex-row-reverse mt-5 row">
            <div class="mb-2 col-auto">
                <button type="button" class="btn btn-primary" id="remove">Eliminar</button>
            </div>
            <div class="mb-2 col-auto">
                <button type="button" class=" btn btn-primary " id="add">Agregar</button>
            </div>
      </div>
      <table id="Table" class="table" style="width:100%;">
          <thead>
              <tr>
                  <th><input type="checkbox" class="toggleCheckbox" name="id" id="id"  value="0"></th>
                  <th>Código de Etapa</th>
                  <th>Nombre de Etapa</th>
              </tr>
          </thead>
          <tbody id="tbody">
          <tr>
            <td><input type="checkbox" name="id"  id="id"  value="1"></td>
            <td><input type="text" name="codigo" class="form-control" id="codigo" autocomplete="off" value="0000001" required="true"></td>
            <td><input type="text" name="nombre" class="form-control" id="nombre" value="default" autocomplete="off" required="true"></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="id"  id="id"  value="2"></td>
            <td><input type="text" name="codigo" class="form-control" id="codigo" autocomplete="off" value="0000002" required="true"></td>
            <td><input type="text" name="nombre" class="form-control" id="nombre" value="default" autocomplete="off" required="true"></td>
          </tr>
          </tbody>
      </table>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
	</form>
</div>


<script>
  var rowIdx = 2;
  
  // jQuery button click event to add a row.
  $('#add').on('click', function () {
    
      // Adding a row inside the tbody.
      $('#tbody').append(`
        <tr>
            <td><input type="checkbox" name="id"  id="id"  value="${rowIdx++}"></td>
            <td><input type="text" name="codigo" class="form-control" id="codigo" autocomplete="off" value="000000${rowIdx++}"></td>
            <td><input type="text" name="nombre" class="form-control" id="nombre" value="default" autocomplete="off"></td>
        </tr>
      `);
  });

  
$("#remove").on('click', function () {
  $("#Table tbody tr").each(function () {
    if ($(this).find("input:checkbox:checked").length > 0){ 
      $(this).remove();
      rowIdx--;
    }
  })

})

$(".toggleCheckbox").change(function(){
  $("#Table tbody tr").find("input:checkbox").prop("checked",this.checked);
})

</script>