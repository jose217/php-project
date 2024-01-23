<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Inspección</h2>
  </div>
  <form action="?controller=Inspeccion&action=save" method="post" name="formulario">
    <div class="mt-3">
      <label for="ivSolicitudId" class="col-auto col-form-label">Solicitud de inspeccion Activa N°
        <?php echo $GET_SOLICITUD->getId(); ?>
      </label>
      <input type="hidden" name="ivSolicitudId" id="ivSolicitudId" value="<?php echo $GET_SOLICITUD->getId(); ?>">
    </div>
    <div class="row">
      <div class="col-md-4 mt-3">
        <div clas="form-group">
          <label for="proyectoId">Residencial:</label>
          <select name="proyectoId" id="proyectoId" class="form-select">
            <option value="<?php echo $proyectoById->getId(); ?>" selected>
              <?php echo $proyectoById->getNombre(); ?>
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label for="etapaId">Etapa / Cluster / Otros:</label>
          <select name="etapaId" id="etapaId" class="form-select">
            <option value="<?php echo $etapaById->getId(); ?>" selected>
              <?php echo $etapaById->getNombre(); ?>
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label for="poligonoId">Polígono:</label>
          <select name="poligonoId" id="poligonoId" class="form-select">
            <option value="<?php echo $poligonoById->getId(); ?>" selected>
              <?php echo $poligonoById->getNombre(); ?>
            </option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mt-3">
        <label for="loteId">Casa:</label>
        <select name="loteId" id="loteId" class="form-select">
          <option value="<?php echo $loteById->getId(); ?>" selected>
            <?php echo $loteById->getNumeroLote(); ?>
          </option>
        </select>
      </div>
      <div class="col-md-4 mt-3">
        <label for="codCliente">Código Cliente:</label>
        <input type="text" readonly class="form-control" name="codCliente" id="codCliente"
          value="<?php echo $loteById->getCodCliente(); ?>">
      </div>
      <div class="col-md-4 mt-3">
        <label for="inspeccion">Inspección:</label>
        <select name="inspeccion" id="inspeccion" class="form-select">
          <option value="<?php echo $catInspeccionById->getId(); ?>" selected>
            <?php echo $catInspeccionById->getDescripcion(); ?>
          </option>
        </select>
      </div>
    </div>
    <div class=" mt-3">
      <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input" disabled <?php if ($GET_SOLICITUD->getHabitada() != null) {
          echo ' checked ';
        } ?> name="habitada" id="habitada" value="">
        <label for="habitada" class="form-check-label">Habitada</label>
      </div>
      <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input" disabled <?php if ($GET_SOLICITUD->getNegocio() != null) {
          echo ' checked ';
        } ?> name="negocio" id="negocio" value="">
        <label for="negocio" class="form-check-label">Negocio</label>
      </div>
    </div>
    <div class=" mt-3">
      <div class="">
        <label for="tipoNegocioId">Tipo de Negocio:</label>
        <select name="tipoNegocioId" id="tipoNegocioId" class="form-select">
          <option value="<?php echo $catTipoNegocioById->getId(); ?>" selected>
            <?php echo $catTipoNegocioById->getDescripcion(); ?>
          </option>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col">
        <label for="ivFechaVisita">Fecha de Inspección</label>
        <input type="datetime-local" name="ivFechaVisita" id="ivFechaVisita" class="form-control"
          value="<?php echo date('Y-m-d H:m'); ?>">
      </div>
    </div>
    <div class="mt-3" style="border-bottom: solid; border-color: #717D7E;">
      <h5>Detalle de Inspección</h5>
    </div>
    <div class="mt-3">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="ivDetalle[]" value="altoCons">
        <label class="form-check-label" for="inlineCheckbox1">Alto Consumo</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="ivDetalle[]" value="bajoCons">
        <label class="form-check-label" for="inlineCheckbox2">Bajo Consumo</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="ivDetalle[]" value="medInv">
        <label class="form-check-label" for="inlineCheckbox3">Medidor Invertido</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="ivDetalle[]" value="fugInt">
        <label class="form-check-label" for="inlineCheckbox1">Fuga Interna</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="ivDetalle[]" value="fugExt">
        <label class="form-check-label" for="inlineCheckbox2">Fuga Externa</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="ivDetalle[]" value="Otros">
        <label class="form-check-label" for="inlineCheckbox3">Otros</label>
      </div>
    </div>
    <div class="mt-3">
      <label for="ivDetalleEspecificacion">Especifique:</label>
      <textarea name="ivDetalleEspecificacion" id="ivDetalleEspecificacion" class="form-control" rows="3"></textarea>
    </div>
    <div class="mt-3" style="border-bottom: solid; border-color:#717D7E;">
      <h5>Fontaneria</h5>
    </div>
    <div class="row">
      <div class="col-md-4 mt-3">
        <label for="ivSerieMedidor">Número de Serie del Medidor:</label>
        <input type="text" class="form-control" id="ivSerieMedidor" name="ivSerieMedidor"
          value="<?php echo $loteById->getNumeroSerieMedidor(); ?>" readonly>
      </div>
      <div class="col-md-4 mt-3">
        <label for="ivLecturaAnterior">Lectura Anterior:</label>
        <input type="text" class="form-control" id="ivLecturaAnterior" name="ivLecturaAnterior" value="<?php foreach ($lecturaByLote as $evalueciones) {
          echo $evalueciones->getUltimaLectura();
        } ?>" readonly>
      </div>
      <div class="col-md-4 mt-3">
        <label for="ivConsumo">Consumo:</label>
        <input type="text" class="form-control" id="ivConsumo" name="ivConsumo" value="<?php foreach ($lecturaByLote as $evalueciones) {
          echo $evalueciones->getConsumo();
        } ?>" readonly>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mt-3">
        <label for="ivCorreccionSerie">Corrección Serie:</label>
        <input type="text" name="ivCorreccionSerie" id="ivCorreccionSerie" class="form-control">
      </div>
      <div class="col-md-4 mt-3">
        <label for="ivLecturaEnInspeccion">Lectura al Momento de Inspección:</label>
        <input type="text" class="form-control" id="ivLecturaEnInspeccion" name="ivLecturaEnInspeccion">
      </div>
    </div>
    <div class="mt-3">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="ivHabitada" name="ivHabitada" value="">
        <label class="form-check-label" for="ivHabitada">Habitada al Momento de Inspección</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="ivNegocio" name="ivNegocio" value="">
        <label class="form-check-label" for="ivNegocio">Negocio</label>
      </div>
    </div>
    <div class="mt-3 row">
      <div class="col">
        <label for="ivFkTipoNegocioId">Tipo de Negocio:</label>
        <select name="ivFkTipoNegocioId" id="ivFkTipoNegocioId" class="form-select">
          <option value="null">Seleccione una Opción</option>
          <?php foreach ($catTiposNegocios as $tipoNegocio) { ?>
            <option value="<?php echo $tipoNegocio->getId(); ?>">
              <?php echo $tipoNegocio->getDescripcion(); ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="mt-3" style="border-bottom: solid; border-color:#717D7E;">
      <h5>Prueba de Litros</h5>
    </div>
    <div class="row mt-3">
      <div class="col">
        <label for="ivPLCuantosGiros">Cantidad de giros:</label>
        <input type="number" class="form-control" id="ivPLCuantosGiros" name="ivPLCuantosGiros">
      </div>
      <div class="col">
        <label for="ivPLMarcaLitros">Marca de Litros:</label>
        <input type="number" class="form-control" id="ivPLMarcaLitros" name="ivPLMarcaLitros">
      </div>
    </div>
    <div class="row g-3 mt-3">
      <div class="col">
        <h5>Antes de Inspección</h5>
        <div id="chart1" style="width: 400px; height: 120px;"></div>
        <input type="text" readonly id="valor1">
        <input type="text" readonly id="valor2">
      </div>
      <div class="col">
        <h5>Despues de Inspección</h5>
        <div id="chart2" style="width: 400px; height: 120px;"></div>
        <input type="text" readonly id="valor3">
        <input type="text" readonly id="valor4">
      </div>
    </div>
    <div class="mt-3" style="border-bottom: solid; border-color:#717D7E;">
      <h5>Estado de Medidor y Accesorios</h5>
    </div>
    <div>
      <div class="row">
        <div class="col-md-6 mt-3">
          <label for="ivIEMAMedidor">Estado de Medidor:</label>
          <input type="text" class="form-control" id="ivIEMAMedidor" name="ivIEMAMedidor">
        </div>
        <div class="col-md-6 mt-3">
          <label for="ivIEMAValvula">Estado de Válvula:</label>
          <input type="text" class="form-control" name="ivIEMAValvula" id="ivIEMAValvula">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mt-3">
          <label for="ivIEMACajaMedidora">Estado de Caja Medidora:</label>
          <input type="text" class="form-control" name="ivIEMACajaMedidora" id="ivIEMACajaMedidora">
        </div>
        <div class="col-md-6 mt-3">
          <label for="ivIEMATapadera">Estado de Tapadera:</label>
          <input type="text" class="form-control" name="ivIEMATapadera" id="ivIEMATapadera">
        </div>
      </div>
    </div>
    <div class="mt-3" style="border-bottom: solid; border-color:#717D7E;">
      <h5>Respuesta Según Inspección: </h5>
    </div>
    <div class="mt-3">
      <textarea name="ivRespuesta" id="ivRespuesta" class="form-control" rows="4"></textarea>
    </div>
    <div class="mt-3">
      <label for="signatureCanvas">Firma del Cliente:</label>
    </div>
    <div class="d-flex justify-content-center mt-3">
      <canvas id="signatureCanvas" width="800" height="200" style="border: 2px solid #717D7E;"></canvas>
      <input type="hidden" name="ivFirmaCliente" id="ivFirmaCliente" value="" >
    </div>
    <div class="d-flex justify-content-center mt-3">
      <div class="">
        <button type="button" class="btn btn-primary" onclick="borrarFirma()">Limpiar</button>
      </div>
      <!-- <div class="">
        <button type="button" class="btn btn-primary" onclick="guardarFirma()">Guardar</button>
      </div> -->
    </div>
    <div class="row">
      <div class="">
        <input type="submit" onclick="guardarFirma()" class="btn btn-primary" name="guardar" id="guardar" value="Guardar">
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  google.charts.load('current', { 'packages': ['gauge'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Grs', 0],
      ['Lts', 0]
    ]);

    var data2 = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Grs', 0],
      ['Lts', 0]
    ]);


    var options = {
      width: 400, height: 120,
      min: 0, max: 9,
      majorTicks: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
      animation: { duration: 1000, easing: 'linear' },
      format: '#'
    };

    var chart = new google.visualization.Gauge(document.getElementById('chart1'));
    var chart2 = new google.visualization.Gauge(document.getElementById('chart2'));

    chart.draw(data, options);
    chart2.draw(data2, options);

    var counter1 = 0;
    var counter2 = 0;
    var vueltas1 = 0;
    var vueltas2 = 0;
    var counter1_2 = 0;
    var counter2_2 = 0;
    var vueltas1_2 = 0;
    var vueltas2_2 = 0;

    setInterval(function () {
      counter1++;
      if (counter1 > 9) {
        counter1 = 0;
        vueltas1++;
      }
      data.setValue(0, 1, counter1);
      chart.draw(data, options);
      document.getElementById('valor1').value = counter1 + "Vueltas X:" + vueltas1;
    }, 1000);

    setInterval(function () {
      counter2++;
      if (counter2 > 9) {
        counter2 = 0;
        vueltas2++;
      }
      data.setValue(1, 1, counter2);
      chart.draw(data, options);
      document.getElementById('valor2').value = counter2 + "Litros X:" + vueltas2;
    }, 1000);

    var chartElement = document.getElementById('chart1');
    chartElement.style.marginLeft = '12%';

    setInterval(function () {
      counter1_2++;
      if (counter1_2 > 9) {
        counter1_2 = 0;
        vueltas1_2++;
      }
      data2.setValue(0, 1, counter1_2);
      chart2.draw(data2, options);
      document.getElementById('valor3').value = counter1_2 + "Vueltas X:" + vueltas1_2;
    }, 1000);

    setInterval(function () {
      counter2_2++;
      if (counter2_2 > 9) {
        counter2_2 = 0;
        vueltas2_2++;
      }
      data2.setValue(1, 1, counter2_2);
      chart2.draw(data2, options);
      document.getElementById('valor4').value = counter2_2 + "Litros X:" + vueltas2_2;
    }, 1000);

    var chartElement2 = document.getElementById('chart2');
    chartElement2.style.marginLeft = '12%';
  }
</script>
<script>
  // Inicializa Signature Pad en el canvas
  var canvas = document.getElementById('signatureCanvas');
  var firmaPad = new SignaturePad(canvas);

  // Función para borrar la firma
  function borrarFirma() {
    firmaPad.clear();
  }

  // Función para obtener la imagen de la firma y guardarla en la base de datos
  function guardarFirma() {

    // Obtén la imagen en formato base64
    var imagenFirma = firmaPad.toDataURL();

    // Asigna la imagen base64 al campo del formulario
    document.getElementById('ivFirmaCliente').value = imagenFirma;
  }
</script>