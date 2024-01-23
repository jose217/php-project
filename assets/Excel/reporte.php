<!-- <?php 
// require_once('../../connection.php');
// $connect=Db::getConnect();
//consulta
// SELECT hc.numero,
//                               p.cedula, p.nombres, p.apellidos,
//                               ap.imenarquia,ap.imenopausia,ap.vsexualactiva,ap.ciclos,ap.gesta,ap.partos,ap.abortos,ap.cesareas,ap.fum,ap.fup,ap.hvivos, ap.mpf, ap.descripcion AS des_ap,
//                               af.cardiopatia, af.diabetes, af.cancer, af.enfcardiovasculares, af.hipertension, af.enfmentales, af.tubercolosis,af.enfinfecciosas,af.malformacion, af.otra, af.descripcion AS des_af,
//                               c.fecha, c.enfactual, c.diagnostico, c.prescripcion,
//                               sv.pulso, sv.prearterial, sv.peso,sv.fecha,
//                               s.sentidos,s.fecha,s.respiratorio,s.cardiovascular,s.nervioso,s.genital,s.digestivo,s.urinario,s.mesqueletico,s.endocrino,s.linfatico,s.descripcion AS des_s,
//                               e.cabeza,e.fecha,e.cuello,e.torax, e.abdomen, e.miembros, e.genitales,ec.descripcion AS des_ec,
//                               r.medicamentos, r.indicaciones,r.fecha
//       FROM histoclinicas AS hc
//       INNER JOIN pacientes AS p
//           ON hc.paciente = p.id
//       INNER JOIN antpersonales AS ap
//             ON ap.paciente = p.id
//       INNER JOIN antfamiliares AS af
//             ON af.paciente = p.id
//       INNER JOIN consultas AS c
//             ON c.paciente = p.id
//       INNER JOIN sistemas AS s
//             ON s.fecha = c.fecha
//       INNER JOIN sigvitales AS sv
//             ON sv.fecha = c.fecha
//       INNER JOIN exafisicos AS e
//             ON e.fecha = c.fecha
//       INNER JOIN exacomplementarios AS ec
//             ON ec.fecha = c.fecha
//       INNER JOIN recetas AS r
//             ON r
// a

// $sql= $db->prepare('SELECT p.nombre, p.codigo,
//                         e.nombre, e.codigo,
//                         pol.nombre,
//                         c.numero_lote, c.numero_serie_medidor,
//                         ev.lectura_final, ev.estado_vivienda, ev.tipo_vivienda,  ev.fecha_creacion, ev.fecha_modificacion, ev.lectura_anterior, ev.consumo,
//                         m.mes,m.annio,
//                         em.descripcion,
//                         tn.descripcion,
//                         na. 
//                           FROM evaluacion_vivienda WHERE mes_ativo_id=:mesActivo');
// $sql->bindParam(':mesActivo',$_GET['mesActivo']);
// $sql->execute();
// $reporte=$sql->fetchAll();


// header("Pragma: public");
// header("Expires: 0");
// $filename = ".xls";
// header("Content-type: application/x-msdownload");
// header("Content-Disposition: attachment; filename=$filename");
// header("Pragma: no-cache");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");


?>
<table>
    <thead>
        <tr>
            <th>codsucursal</th>
            <th>nomsucursal</th> 
            <th>codproyecto</th>
            <th>nomproyecto</th>
            <th>poligono</th>
            <th>casa</th>
            <th>nummedidor</th>
            <th>lecturainicial</th>
            <th>diferencia</th>
            <th>fechainicial</th>
            <th>fechafinal</th>
            <th>habitada</th>
            <th>esnegocio</th>
            <th>tiponegocio</th>
            <th>fechainspeccion</th>
            <th>observacion</th>
            <th>usuario asignado</th>
        </tr>       
    </thead>
<tbody>
<tr>
<td>1</td>
<td>2</td>
<td>3</td>
<td>4</td>
<td>5</td>
<td>6</td>
<td>7</td>
<td>8</td>
<td>9</td>
<td>10</td>
</tr>
</tbody>
</table> -->