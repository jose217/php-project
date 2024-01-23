<?php
      // INCLUIR LA PLANTILLA DE DISEÑO
      include_once('PlantillaHistoricoPdf.php');
      // IMPORTAR CONEXION
      require_once('../connection.php');
      // CONSULTAS 
      $db=Db::getConnect();
      $sql=$db->prepare("SELECT hc.numero,
                              p.cedula, p.nombres, p.apellidos,
                              ap.imenarquia,ap.imenopausia,ap.vsexualactiva,ap.ciclos,ap.gesta,ap.partos,ap.abortos,ap.cesareas,ap.fum,ap.fup,ap.hvivos, ap.mpf, ap.descripcion AS des_ap,
                              af.cardiopatia, af.diabetes, af.cancer, af.enfcardiovasculares, af.hipertension, af.enfmentales, af.tubercolosis,af.enfinfecciosas,af.malformacion, af.otra, af.descripcion AS des_af,
                              c.fecha, c.enfactual, c.diagnostico, c.prescripcion,
                              sv.pulso, sv.prearterial, sv.peso,sv.fecha,
                              s.sentidos,s.fecha,s.respiratorio,s.cardiovascular,s.nervioso,s.genital,s.digestivo,s.urinario,s.mesqueletico,s.endocrino,s.linfatico,s.descripcion AS des_s,
                              e.cabeza,e.fecha,e.cuello,e.torax, e.abdomen, e.miembros, e.genitales,ec.descripcion AS des_ec,
                              r.medicamentos, r.indicaciones,r.fecha
      FROM histoclinicas AS hc
      INNER JOIN pacientes AS p
          ON hc.paciente = p.id
      INNER JOIN antpersonales AS ap
            ON ap.paciente = p.id
      INNER JOIN antfamiliares AS af
            ON af.paciente = p.id
      INNER JOIN consultas AS c
            ON c.paciente = p.id
      INNER JOIN sistemas AS s
            ON s.fecha = c.fecha
      INNER JOIN sigvitales AS sv
            ON sv.fecha = c.fecha
      INNER JOIN exafisicos AS e
            ON e.fecha = c.fecha
      INNER JOIN exacomplementarios AS ec
            ON ec.fecha = c.fecha
      INNER JOIN recetas AS r
            ON r.fecha = c.fecha
      WHERE p.id = :id");
      $sql->bindParam(':id',$_GET['id']);
      $sql->execute();
      $reporte=$sql->fetchAll();

      //DATOS HC Y PACIENTE
      $numero_hc=$reporte[0]['numero'];
      $cedula=$reporte[0]['cedula'];
      $nombres=$reporte[0]['nombres'];
      $apellidos=$reporte[0]['apellidos'];
      // $genero=$reporte[0]['genero']; 
      $nom_ap=$nombres.' '.$apellidos;

      //DATOS ANTECEDENTES PERSONALES
      $edad_menarquia=$reporte[0]['imenarquia'];
      $edad_menopausia=$reporte[0]['imenopausia'];
      $vida_sexual=$reporte[0]['vsexualactiva'];
      $ciclos=$reporte[0]['ciclos'];
      $edad_gestacion=$reporte[0]['gesta'];
      $numero_partos=$reporte[0]['partos'];
      $numero_abortos=$reporte[0]['abortos'];
      $numero_cesareas=$reporte[0]['cesareas'];
      $fecha_ultima_menstruacion=$reporte[0]['fum'];
      $fecha_ultimo_parto=$reporte[0]['fup'];
      $hijos_vivos=$reporte[0]['hvivos'];
      $mp_familiar=$reporte[0]['mpf'];
      $des_ap=$reporte[0]['des_ap'];

      //DATOS ANTECEDENTES FAMILIARES
      $cardiopatia=$reporte[0]['cardiopatia'];
      $cardiopatia = ($cardiopatia==2) ? "No" : "Si" ;
      $diabetes=$reporte[0]['diabetes'];
      $diabetes = ($diabetes==2) ? "No" : "Si" ;
      $cancer=$reporte[0]['cancer'];
      $cancer = ($cancer==2) ? "No" : "Si" ;
      $enfcardiovasculares=$reporte[0]['enfcardiovasculares'];
      $enfcardiovasculares = ($enfcardiovasculares==2) ? "No" : "Si" ;
      $hipertension=$reporte[0]['hipertension'];
      $hipertension = ($hipertension==2) ? "No" : "Si" ;
      $enfmentales=$reporte[0]['enfmentales'];
      $enfmentales = ($enfmentales==2) ? "No" : "Si" ;
      $tuberculosis=$reporte[0]['tubercolosis'];
      $tuberculosis = ($tuberculosis==2) ? "No" : "Si" ;
      $enfinfecciosas=$reporte[0]['enfinfecciosas'];
      $enfinfecciosas = ($enfinfecciosas==2) ? "No" : "Si" ;  
      $malformacion=$reporte[0]['malformacion'];
      $malformacion = ($malformacion==2) ? "No" : "Si" ; 
      $otra=$reporte[0]['otra'];
      $otra = ($otra==2) ? "No" : "Si" ; 
      $des_af=$reporte[0]['des_af'];

      $pdf = new PlantillaHistoricoPdf();
      $pdf->AddPage();
       // datos hc y paciente
      $pdf->detalleHistoria($numero_hc,$cedula,$nom_ap);
      // antecendentes personales
      $pdf->detallePersonales($genero, $edad_menarquia,$edad_menopausia, $vida_sexual,$ciclos,$edad_gestacion,$numero_partos,$numero_abortos,$numero_cesareas,$fecha_ultima_menstruacion,$fecha_ultimo_parto,$hijos_vivos,$mp_familiar,$des_ap);
      // antecedentes familiares
      $pdf->detalleFamiliares($cardiopatia, $diabetes,$cancer,$enfcardiovasculares,$hipertension,$enfmentales,$tuberculosis,$enfinfecciosas, $malformacion, $otra,$des_af);
      // datos de consulta
      $pdf->datosConsulta($reporte);
      //formato de salida para el nombre del archivo
      $nombre='HISTORICO-HC-'.$numero_hc.'-'.date("Y").'-'.date("m").'-'.date("d");
      $pdf->Output('I',$nombre.'.pdf');
      ob_end_flush();
?>