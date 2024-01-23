<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>
<script>
    var datosLote = [<?php echo $GET_LOTE_ID; ?>];
  
    function getLote(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $.each( datos, function( key, value ) {      
        if(value.poligonoId == sel.value){
          $("#"+idsel).append('<option value="'+value.id+'">'+value.numeroLote+'</option>')
          document.getElementById("numeroSerieMedidor").value = ''+value.numeroSerieMedidor+''; 
        }
      });
    };
</script>

<div class="container">
    <div class="mt-3">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="?controller=evaluacionV&action=register" role="tab" aria-controls="nav-home" aria-selected="true">Formulario Principal</a>
          <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#" role="tab" aria-controls="nav-profile" aria-selected="false">Formulario Alternativo</a>
        </div>
    </nav>   
    </div>
  <div>
  <h2 class="mt-3">Registro de Evaluación de Vivienda</h2>
  </div>
  <form class="form-horizontal" action='?controller=evaluacionV&action=save' method='post' id="eventForm">
  
      <div class="">
        <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
        <div class="col-auto">
          	<select type="select" name="poligonoId" class="form-select" id="poligonoId" onchange="getLote(this,'loteId',datosLote);">
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
                  <th>Lectura Final</th>
                  <th>Estado Medidor</th>
                  <th>Estado vivienda</th>
                  <th>Tipo Vivienda</th>
                  <th>Tipo Negocio</th>
              </tr>
          </thead>
          <tbody id="tbody">
            <tr>
                <td><input type="checkbox" name="id"  id="id"  value="1"></td>
                <td><input type="text" name="numeroLote" class="form-control" id="numeroLote" autocomplete="off" value="1"></td>
                <td><input type="text" name="numeroSerieMedidor" class="form-control" id="numeroSerieMedidor" value="258964" autocomplete="off"></td>
                <td><input type="text" name="lecturaFinal" class="form-control" id="lecturaFinal" value="000001" autocomplete="off"></td>
                <td>
                    <select type="select"  name="estadoMedidor" class="form-select" id="estadoMedidor">
                        <option value="Sin Selección" selected>Sin Selección</option>
                        <option value="Regular">Regular</option>
			        </select>
                </td>
                <td>
                    <div class="col-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox1" value="Habitada">
                            <label class="form-check-label" for="inlineCheckbox1">Habitada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox2" value="No Habitada">
                            <label class="form-check-label" for="inlineCheckbox1">No Habitada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox1" value="Abandonada">
                            <label class="form-check-label" for="inlineCheckbox1">Habandonada</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="col-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="inlineCheckbox1" value="Residencia">
                            <label class="form-check-label" for="inlineCheckbox1">Residencia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="inlineCheckbox2" value="Negocio">
                            <label class="form-check-label" for="inlineCheckbox1">Negocio</label>
                        </div>
                    </div>
                </td>
                <td>
                    <select type="select"  name="tipoNegocio" class="form-select" id="tipoNegocio">
                        <option value="Sin Selección" selected>Sin Selección</option>
                        <option value="Combo Box">Combo Box</option>
			        </select>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" name="id"  id="id"  value="2"></td>
                <td><input type="text" name="numeroLote" class="form-control" id="numeroLote" autocomplete="off" value="2"></td>
                <td><input type="text" name="numeroSerieMedidor" class="form-control" id="numeroSerieMedidor" value="000002" autocomplete="off"></td>
                <td><input type="text" name="lecturaFinal" class="form-control" id="lecturaFinal" value="000002" autocomplete="off"></td>
                <td>
                    <select type="select"  name="estadoMedidor" class="form-select" id="estadoMedidor">
                        <option value="Sin Selección" selected>Sin Selección</option>
                        <option value="Regular">Regular</option>
			        </select>
                </td>
                <td>
                    <div class="col-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox1" value="Habitada">
                            <label class="form-check-label" for="inlineCheckbox1">Habitada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox2" value="No Habitada">
                            <label class="form-check-label" for="inlineCheckbox1">No Habitada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox1" value="Abandonada">
                            <label class="form-check-label" for="inlineCheckbox1">Habandonada</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="col-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="inlineCheckbox1" value="Residencia">
                            <label class="form-check-label" for="inlineCheckbox1">Residencia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="inlineCheckbox2" value="Negocio">
                            <label class="form-check-label" for="inlineCheckbox1">Negocio</label>
                        </div>
                    </div>
                </td>
                <td>
                    <select type="select"  name="tipoNegocio" class="form-select" id="tipoNegocio">
                        <option value="Sin Selección" selected>Sin Selección</option>
                        <option value="Combo Box">Combo Box</option>
			        </select>
                </td>
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
            <td><input type="text" name="numeroLote" class="form-control" id="numeroLote" autocomplete="off" value="${rowIdx++}"></td>
                <td><input type="text" name="numeroSerieMedidor" class="form-control" id="numeroSerieMedidor" value="00000${rowIdx++}" autocomplete="off"></td>
                <td><input type="text" name="lecturaFinal" class="form-control" id="lecturaFinal" value="00000${rowIdx++}" autocomplete="off"></td>
                <td>
                    <select type="select"  name="estadoMedidor" class="form-select" id="estadoMedidor">
                        <option value="Sin Selección" selected>Sin Selección</option>
                        <option value="Regular">Regular</option>
			        </select>
                </td>
                <td>
                    <div class="col-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox1" value="Habitada">
                            <label class="form-check-label" for="inlineCheckbox1">Habitada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox2" value="No Habitada">
                            <label class="form-check-label" for="inlineCheckbox1">No Habitada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="inlineCheckbox1" value="Abandonada">
                            <label class="form-check-label" for="inlineCheckbox1">Habandonada</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="col-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="inlineCheckbox1" value="Residencia">
                            <label class="form-check-label" for="inlineCheckbox1">Residencia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="inlineCheckbox2" value="Negocio">
                            <label class="form-check-label" for="inlineCheckbox1">Negocio</label>
                        </div>
                    </div>
                </td>
                <td>
                    <select type="select"  name="tipoNegocio" class="form-select" id="tipoNegocio">
                        <option value="Sin Selección" selected>Sin Selección</option>
                        <option value="Combo Box">Combo Box</option>
			        </select>
                </td>
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

log.console(rowIdx);
</script>
