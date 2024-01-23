<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
    <div class="mt-3">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="?controller=lote&action=register" role="tab" aria-controls="nav-home" aria-selected="true">Formulario Principal</a>
          <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#" role="tab" aria-controls="nav-profile" aria-selected="false">Formulario Alternativo</a>
        </div>
      </nav>   
    </div>
  <div>
  <h2 class="mt-3 ">Registro de Lote</h2>
  </div>
	<form action="?controller=lote&action=save" method="post" name="formulario">
      <div class="">
        <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
        <div class="col-auto">
          	<select type="select"  name="poligonoId" class="form-select" id="poligonoId">
			        <?php foreach($GET_POLIGONO_ID as $row){ ?>
			        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getNombre(); ?></option>
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
                  <th>Número Lote</th>
                  <th>Número Serie Medidor</th>
              </tr>
          </thead>
          <tbody id="tbody">
          <tr>
            <td><input type="checkbox" name="id"  id="id"  value="1"></td>
            <td><input type="text" name="numeroLote" class="form-control" id="numeroLote" autocomplete="off" value="1"></td>
            <td><input type="text" name="numeroSerieMedidor" class="form-control" id="numeroSerieMedidor" value="000001" autocomplete="off"></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="id"  id="id"  value="2"></td>
            <td><input type="text" name="numeroLote" class="form-control" id="numeroLote" autocomplete="off" value="2"></td>
            <td><input type="text" name="numeroSerieMedidor" class="form-control" id="numeroSerieMedidor" value="000002" autocomplete="off"></td>
          </tr>
          </tbody>
      </table>

      <div class="mt-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
	</form>
</div>


<script>
  var rowIdx = 0;
  
  // jQuery button click event to add a row.
  $('#add').on('click', function () {
    
      // Adding a row inside the tbody.
      $('#tbody').append(`
          <tr>
            <td><input type="checkbox" name="id"  id="id"  value="${rowIdx++}"></td>
            <td><input type="text" name="numeroLote" class="form-control" id="numeroLote" autocomplete="off" value="${rowIdx++}"></td>
            <td><input type="text" name="numeroSerieMedidor" class="form-control" id="numeroSerieMedidor" value="00000${rowIdx++}" autocomplete="off"></td>
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