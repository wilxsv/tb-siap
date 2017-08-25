<?php

namespace Minsal\FarmaciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Minsal\FarmaciaBundle\Entity\FarmRecetas as Recetas;
use Minsal\FarmaciaBundle\Entity\FarmMedicinarecetada as MedicinaRecetada;
use Minsal\FarmaciaBundle\Entity\FarmMedicinaDistribucion as Distribucion;

class FarmRecetasController extends Controller {
    /*
     * DESCRIPCIÓN: Método que devuelve un json con la información SNOMED según
     *              los parametros de busqueda
     * PARAMETROS ENTRADA:
     *          id        =>  Id SNOMED a buscar
     *          clue      =>  palabra a buscar en el campo descriptivo del snomed
     *  PARAMETROS RETORNO:
     *          snomed   =>  Valores que cumplen con las condiciones del id o del
     *                       clue según sea el caso.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Celina Menjivar
     */

    /**
     * @Route("/listadomedicamento/get/{idHistorialClinico}", name="listadomedicamento", options={"expose"=true})
     * @Method("GET")
     */
    public function getListadoMedicamentoAction($idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $idsmedicina = $request->get('ids');
        if ($idsmedicina == NULL) {
            $notint = '';
        } else {
            $notint = 'AND fcpxe.idmedicina NOT IN (' . $idsmedicina . ')';
        }

        if (isset($id)) {

            $sql = "SELECT t01.id,
                           t01.sct_name_es AS text,
                           count(*) OVER() AS total
                    FROM mnt_snomed_cie10     t01
                    WHERE t01.id = $id
                    ORDER BY text";
        } else {
            //SE DEBE VERIFICAR EL TIPO DE BUSQUEDA QUE SE HARA PARA LOS MEDICAMENTOS YA SEA POR CATALOGO O POR EXISTENCIA
            $historialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);
            //$area = $historialClinico->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdAreaAtencion()->getId();
            $modalidad = $historialClinico->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();
            $clue = ltrim(strtolower($request->get('clue')), '0');
            $limit = $request->get('page_limit');
            $page = ($request->get('page') - 1) * 10;

            $sql = "SELECT  id, CONCAT_WS(' ',text,'--- ',CAST(existencia AS TEXT)) as text, count(*) OVER() as total
                    FROM(SELECT DISTINCT ON (text)fcpxe.idmedicina as id,
                                fcp.nombre ||'---'|| COALESCE(fcp.formafarmaceutica,'*')||'---'|| COALESCE(fcp.concentracion,'*')||'---'|| COALESCE(fcp.presentacion,'*') as text,
                                SUM(COALESCE(existencia,0)) AS existencia
                          FROM farm_catalogoproductos fcp
                               INNER JOIN farm_catalogoproductosxestablecimiento fcpxe ON (fcp.id=fcpxe.idmedicina AND condicion = 'H' AND fcpxe.idestablecimiento=(SELECT id FROM ctl_establecimiento WHERE configurado=true) AND idmodalidad = $modalidad)
                               INNER JOIN mnt_areamedicina mam ON (fcp.id=mam.idmedicina AND mam.idarea=(SELECT idarea FROM mnt_areafarmaciaxestablecimiento WHERE dispensar_seguimiento = true and habilitado = 'S' and idestablecimiento = (SELECT id FROM ctl_establecimiento WHERE configurado=true) and idmodalidad = $modalidad))
                               LEFT JOIN farm_medicinaexistenciaxarea fmea ON fcp.id=fmea.idmedicina
                          WHERE unaccent(fcp.nombre ||' '||fcp.presentacion) ILIKE unaccent('%$clue%')
                                $notint
                          GROUP BY fcpxe.id,fcp.nombre ||'---'||COALESCE(fcp.formafarmaceutica,'*')||'---'||COALESCE(fcp.concentracion,'*')||'---'||COALESCE(fcp.presentacion,'*')
                          ORDER BY text
                    ) AS listamedicamento
                    LIMIT $limit OFFSET $page";
        }

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $snomed['data1'] = $result;
        $snomed['data2'] = count($result) > 0 ? $result[0]['total'] : 0;

        return new Response(json_encode($snomed));
    }

    /*
     * DESCRIPCIÓN: Método que borra un elemento de la receta en una edición.
     * PARAMETROS ENTRADA:
     *          - idMedicinaRecetada  =>  id de la tabla medicina recetada que se necesita borrar.
     *          - idHistorialClinico  =>  id de la tabla historial clinico.
     *  PARAMETROS RETORNO:
     *          id => id borrardo de la tabla para eliminarlo de la vista.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

    /**
     * @Route("/borrar/medicina/recetada/{idMedicinaRecetada}/{idHistorialClinico}", name="borrar_medicina_recetada", options={"expose"=true})
     * @Method("GET")
     */
    public function borrarMedicinaRecetadaAction($idMedicinaRecetada, $idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $medicinaRecetada = $em->getRepository('MinsalFarmaciaBundle:FarmMedicinarecetada')->find($idMedicinaRecetada);
        $medicamento = $medicinaRecetada->getIdmedicina();
        $receta = $medicinaRecetada->getIdreceta();
        //QUITANDO LA MEDICINA RECETADA DE LA RECETA DEL DIA.
        $em->remove($medicinaRecetada);
        $em->flush();
        $dql = "SELECT A
                 FROM MinsalFarmaciaBundle:FarmMedicinarecetada A
                    JOIN A.idreceta B
                    JOIN A.idmedicina D
                    WHERE B.id=" . $receta->getId() . "
                    GROUP BY A";
        $medicinaEnReceta = $em->createQuery($dql)->getResult();
        if (empty($medicinaEnReceta)) {
            $em->remove($receta);
            $em->flush();
        }

        $medicina['id'] = array('id' => $idMedicinaRecetada, 'idMedicamento' => $medicamento->getId());

        return new Response(json_encode($medicina));
    }

    /*
     * DESCRIPCIÓN: Método que actualiza la cantidad total de medicamento y el numero de dias de duaracion de tratamiento de la receta en una edición.
     * PARAMETROS ENTRADA:
     *          - idMedicinaRecetada  =>  id de la tabla medicina recetada que se necesita actualizar.
     *          - idHistorialClinico  =>  id de la tabla historial clinico.
     *  PARAMETROS RETORNO:
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     */

    /**
     * @Route("/actualizar/medicina/recetada/{idMedicinaRecetada}/{idHistorialClinico}/{durante}/{totalMedicamento}", name="actualizar_medicina_recetada", options={"expose"=true})
     * @Method("GET")
     */
    public function actualizarMedicinaRecetadaAction($idMedicinaRecetada, $idHistorialClinico,$durante,$totalMedicamento) {
        $em = $this->getDoctrine()->getEntityManager();
        $medicina = $em->getRepository('MinsalFarmaciaBundle:FarmMedicinarecetada')->find($idMedicinaRecetada);
        $medicina->setDurante($durante);
        $medicina->setTotalMedicamento($totalMedicamento);

        $em->persist($medicina);
        $em->flush();

        return new Response(json_encode('todo ok'));
    }

    /*
     * DESCRIPCIÓN: Método que inserta un elemento a la receta en una edición.
     * PARAMETROS ENTRADA:
     *          - idHistorialClinico  =>  id de la tabla historial clinico.
     *          - cantidadMes  =>  numero de meses a sumar a la fecha actual.
     *                             Si es 0 es porque es la fecha actual.
     *  PARAMETROS RETORNO:
     *          id => id de la medicina receta generada.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

    /**
     * @Route("/agregar/medicina/recetada/{idHistorialClinico}", name="agregar_medicina_recetada", options={"expose"=true})
     * @Method("GET")
     */
    public function agregarMedicinaRecetadaAction($idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $historialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);
        $establecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $modalidad = $historialClinico->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad();
        $cantidadMes = $request->get('cantidad');
        $fechaReceta = $request->get('fechaReceta');
        $coeficiente = $request->get('coeficiente');
        $tiempo = $request->get('tiempo');
        $i = $request->get('i');
        $recetadelDia = $request->get('recetadelDia');
        $pacienteEstable = $request->get('pacienteEstable');
        $formulaInsulina = $request->get('formulaInsulina');
        //OBTENIENDO LAS VARIABLES
        $idMedicamento = $request->get('idMedicamento');
        $cantidadMedicamento = $request->get('cantidadMedicamento');

        //INICIO Verificacion de area origen y area dispensa
        $idmedicina = $em->getRepository('MinsalFarmaciaBundle:FarmCatalogoproductos')->find($idMedicamento);

        $sql="SELECT idarea
              FROM mnt_areafarmaciaxestablecimiento
              WHERE dispensar_seguimiento = true and habilitado = 'S'
                    AND idestablecimiento = (SELECT id FROM ctl_establecimiento WHERE configurado=true)
                    AND idmodalidad = ".$modalidad->getId();
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $resultAreaOrigen = $stm->fetchAll();
        $idAreaOrigen=$em->getRepository('MinsalFarmaciaBundle:MntAreafarmacia')->find($resultAreaOrigen[0]['idarea']);
        $areaDispensa = $em->getRepository('MinsalFarmaciaBundle:MntAreamedicina')
                ->findOneBy(array('idmedicina' => $idmedicina, 'idestablecimiento' => $establecimiento, 'idmodalidad' => $modalidad,
                'idarea'=>$idAreaOrigen->getId()));

        if($coeficiente == 1000){//Si el coeficiente es de 1000 el medicamento no va a farmacia especializada por lo que no se debe de validar
            $fecha = $this->calcularFechaReceta($fechaReceta,$cantidadMes, $tiempo,$idHistorialClinico,$i);
            $fechaCalculada = new \DateTime(json_decode($fecha->getContent())->fecha);
        }
        else{//Medicamento se envia a Farmacia especializada por lo que se busca fecha y franja horaria
            $fecha = $this->calcularFechaReceta($fechaReceta,$cantidadMes, $tiempo,$idHistorialClinico,$i);
            $fechaCalculada1 = new \DateTime(json_decode($fecha->getContent())->fecha);
            if($recetadelDia == 0 && (($i==1 && $formulaInsulina !='S') || $i==0) ){
                $Intervalo=0;
            }else {
                $Intervalo=10;
            }
            $Estado='RE';
            $FechasExtremas = $this->ValorarFestivoDiaHabil($fechaCalculada1,$Intervalo);
            $FechasdeExtremos=explode(',',$FechasExtremas);
            $FechaExtremoMaximo=$FechasdeExtremos[1];
            $FechaExtremoMinimo=$FechasdeExtremos[0];
            $answer=  $this->ProcesoParaEncontrarFechaHorario($FechaExtremoMinimo,$FechaExtremoMaximo,$idHistorialClinico,$establecimiento,$Estado);
            $resultado=explode('&',$answer);
            $fechaCalculada = new \DateTime($resultado[0]);
            $idrangohora = $resultado[1];
        }

        $dql = "SELECT DISTINCT A
                            FROM MinsalFarmaciaBundle:FarmRecetas A
                            JOIN MinsalSeguimientoBundle:SecHistorialClinico B WITH (A.idhistorialclinico = B.id AND B.id=$idHistorialClinico)
                            JOIN MinsalFarmaciaBundle:FarmMedicinarecetada C WITH (A.id = C.idreceta AND C.idareadispensa = ".$areaDispensa->getDispensada()->getId()." AND C.idEstablecimientoDespacha = ".$request->get('idestabdespacha').")
                            WHERE A.fecha='" . $fechaCalculada->format('d-m-Y') . "'
                            GROUP BY A";

        $recetaCalculada = $em->createQuery($dql)->getResult();

        if (empty($recetaCalculada)) {
            $receta = new Recetas();
            $receta->setFecha($fechaCalculada);
            if ($cantidadMes == 0 || ($cantidadMes == 1 && $coeficiente != 1000))
                $receta->setIdEstado($em->getRepository('MinsalFarmaciaBundle:FarmEstados')->find(3)->getIdestado());
            else
                $receta->setIdEstado($em->getRepository('MinsalFarmaciaBundle:FarmEstados')->find(4)->getIdestado());
            //OBTENIENDO CORRELATIVO. PARA ELLO SE CUENTAN LA RECETAS DEL DIA QUE SE HAN INGRESADO
            //DE SEGUIMIENTO Y SE LE SUMA 1
            $dql = "SELECT COUNT(A.id) as cuenta
                        FROM MinsalFarmaciaBundle:FarmRecetas A
                        JOIN A.idhistorialclinico B
                        WHERE B.piloto = 'F' AND A.fecha = '" . $fechaCalculada->format('d-m-Y') . "'";
            $correlativo = $em->createQuery($dql)->getSingleResult();
            $receta->setNumeroreceta($correlativo['cuenta'] + 1);
            $receta->setIdestablecimiento($establecimiento);
            $receta->setIdModalidad($modalidad);
            $receta->setIdfarmacia($em->getRepository('MinsalFarmaciaBundle:MntFarmacia')->find(2));
            $receta->setIdhistorialclinico($historialClinico);
            $receta->setIdarea($em->getRepository('MinsalFarmaciaBundle:MntAreafarmacia')->find(2));
            $receta->setPacientestable($pacienteEstable);
            if(!empty($idrangohora)){//Cuando el medicamento se despacha en farmacia especializada
                $receta->setIdRangohora($em->getRepository('MinsalFarmaciaBundle:FarmRangohora')->find($idrangohora));
            }
            $em->persist($receta);
            $em->flush();
        }else {
            $receta = $recetaCalculada[0];
        }




        $frecuencia = $request->get('frecuencia');
        $tiempoFrecuencia = $request->get('tiempoFrecuencia');
        $durante = $request->get('durante');
        $tiempoDurante = $request->get('tiempoDurante');
        $totalMedicamento = $request->get('totalMedicamento');
        $recomendacion = $request->get('recomendacion');
        $banderaDistribucion = $request->get('banderaDistribucion');
        $distribucion = $request->get('distribucion');
        $justificacionprescripcion = $request->get('justificacionprescripcion');
        $dosificaciontexto = trim($request->get('dosificaciontexto'));
        $iddosificacion = $em->getRepository('MinsalFarmaciaBundle:FarmDosificacion')->find($request->get('iddosificacion'));
        $idestabdespacha = $request->get('idestabdespacha');
        $idEstabDespacha = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->find($idestabdespacha);


        //CREACION DEL OBJETO

        //$idmedicina = $em->getRepository('MinsalFarmaciaBundle:FarmCatalogoproductos')->find($idMedicamento);
        $divisormedicna = $idmedicina->getDivisormedicina();
        /*if($divisormedicna){//Esto es para la parte de Farmacia para que les cuadre con lo de los Frascos
            $cantidaddivisormedicina = $totalMedicamento/$divisormedicna;
        }
        else{
            $cantidaddivisormedicina = $totalMedicamento;
        }$medicina->setCantidad($cantidaddivisormedicina);*/

        $medicina = new MedicinaRecetada();
        $medicina->setCantidadMedicamento($cantidadMedicamento);
        $medicina->setCantidad($totalMedicamento);
        $medicina->setFrecuencia($frecuencia);
        $medicina->setTiempoFrecuencia($tiempoFrecuencia);
        $medicina->setDurante($durante);
        $medicina->setTiempoDurante($tiempoDurante);
        $medicina->setTotalMedicamento($totalMedicamento);
        $medicina->setRecomendacion($recomendacion);
        $medicina->setJustificacionPrescripcion($justificacionprescripcion);
        $medicina->setIdEstablecimientoDespacha($idEstabDespacha);
        $medicina->setIdDosificacion($iddosificacion);
        $medicina->setSincronizadofc('N');
        if($frecuencia== 0){
            $cada = ' ';
        }
        else {
            $cada = ' cada ' . $frecuencia . ' ' . $tiempoFrecuencia;
         }

        $dosisfraccion = '';
        $arraycantidad = explode('.', $cantidadMedicamento);
        $dosisentero = '';
        if($arraycantidad[0] !=0){
            $dosisentero = $arraycantidad[0];
        }

        if(count($arraycantidad) > 1 &&  $arraycantidad[1] !=0){
            $fraccion = $this->decimalFranccion('0.'.$arraycantidad[1],10);
            $dosisfraccion = '('.$fraccion[0].'/'.$fraccion[1].')';
        }

        $cantidadtransformada = $dosisentero.$dosisfraccion;

        $dosis = $cantidadtransformada . ' ' . $dosificaciontexto . ' ' .$cada . ' durante ' . $durante . ' ' . $tiempoDurante;
        $medicina->setDosis($dosis);
        $medicina->setIdmedicina($idmedicina);
        $medicina->setIdreceta($receta);
        /*$sql="SELECT idarea
              FROM mnt_areafarmaciaxestablecimiento
              WHERE dispensar_seguimiento = true and habilitado = 'S'
                    AND idestablecimiento = (SELECT id FROM ctl_establecimiento WHERE configurado=true)
                    AND idmodalidad = ".$modalidad->getId();
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $resultAreaOrigen = $stm->fetchAll();
        $idAreaOrigen=$em->getRepository('MinsalFarmaciaBundle:MntAreafarmacia')->find($resultAreaOrigen[0]['idarea']);*/
        $medicina->setIdareaorigen($idAreaOrigen);
        $medicina->setIdestado($em->getRepository('MinsalFarmaciaBundle:FarmEstados')->find(17)->getIdestado());
        /*$areaDispensa = $em->getRepository('MinsalFarmaciaBundle:MntAreamedicina')
                ->findOneBy(array('idmedicina' => $idmedicina, 'idestablecimiento' => $establecimiento, 'idmodalidad' => $modalidad,
                'idarea'=>$idAreaOrigen->getId()));*/
        $medicina->setIdareadispensa($areaDispensa->getDispensada());
        $medicina->setIdestablecimiento($establecimiento);
        $medicina->setIdmodalidad($modalidad);
        $varindicacion = '';
        if ($banderaDistribucion == '1') {
            $medicina->setDistribucionEspecial(true);
            $distribuciones = explode('°°', $distribucion);
            foreach ($distribuciones as $aux) {
                list($cantidadDistribucion, $indicacion) = explode('¬¬', $aux);
                $medicinaDistribucion = new Distribucion();
                $medicinaDistribucion->setCantidadDistribucion($cantidadDistribucion);
                $medicinaDistribucion->setIndicacion($indicacion);
                $medicinaDistribucion->setIdMedicinaRecetada($medicina);
                $varindicacion = $varindicacion.$cantidadDistribucion.' '.$dosificaciontexto.' '.$indicacion.', ';
                $em->persist($medicinaDistribucion);
                $em->flush();
            }
        } else {
            $medicina->setDistribucionEspecial(false);
        }
        $medicina->setDosis($dosis.($varindicacion ? ': '.$varindicacion : '') );
        $em->persist($medicina);
        $em->flush();
        $medicinaEnviada['id'] = array('id' => $medicina->getId(), 'fecha' => $receta->getFecha()->format('d-m-Y'));



        return new Response(json_encode($medicinaEnviada));
    }

    /*
     * DESCRIPCIÓN: Metodo que convierte cantidades decimales en francion (Se reutizo codigo que ya realizaba esta funcionalidad)
     * PARAMETROS ENTRADA:
     *          - v  =>  numero decimal que se convertira en francion.
     *          - lim  =>  limite maximo para el denominador.
     *  PARAMETROS RETORNO:
     *          -esnohabil=> retorna 0 si el dia no es sabado o doming / retorna 1 si el dia es sabado o domingo
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     */
    public function decimalFranccion($v, $lim) {
        // No error checking on args.  lim = maximum denominator.
        // Results are array(numerator, denominator); array(1, 0) is 'infinity'.
        if($v < 0) {
            list($n, $d) = farey(-$v, $lim);
            return array(-$n, $d);
        }
        $z = $lim - $lim;   // Get a "zero of the right type" for the denominator
        list($lower, $upper) = array(array($z, $z+1), array($z+1, $z));
        while(true) {
            $mediant = array(($lower[0] + $upper[0]), ($lower[1] + $upper[1]));
            if($v * $mediant[1] > $mediant[0]) {
                if($lim < $mediant[1])
                    return $upper;
                $lower = $mediant;
            }
            else if($v * $mediant[1] == $mediant[0]) {
                if($lim >= $mediant[1])
                    return $mediant;
                if($lower[1] < $upper[1])
                    return $lower;
                return $upper;
            }
            else {
                if($lim < $mediant[1])
                    return $lower;
                $upper = $mediant;
            }
        }
    }


    /*
     * DESCRIPCIÓN: Método que suma la cantidad de meses enviada a la fecha actual
     * PARAMETROS ENTRADA:
     *          - cantidadMeses  =>  cantidad de meses a sumar.
     *  PARAMETROS RETORNO:
     *          -fechaCalculada => fecha con los nuevos meses a sumar.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

    /**
     * @Route("/calcular/fecha/{fechaReceta}/{cantidad}/{tiempo}/{idHistorialClinico}/{i}", name="calcular_fecha_receta", options={"expose"=true})
     * @Method("GET")
     */
    public function calcularFechaReceta($fechaReceta,$cantidad, $tiempo,$idHistorialClinico,$i) {
        $em = $this->getDoctrine()->getManager();
        $historia=$em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);

        $fecha = $historia->getFechaConsulta();//quitar esto y mandar la fecha desde el avascrip
        $IdEstablecimiento = $historia->getIdestablecimiento()->getId();
        switch ($tiempo) {
            case 'mes':
                $suma = new \DateInterval('P' . (1 * $cantidad) . 'M');
                $fecha = $fecha->add($suma);
                $fechaCalculada['fecha'] = $fecha->format('d-m-Y');
                break;
            case 'dia':
                $suma = new \DateInterval('P' . (1 * $cantidad) . 'D');
                $fecha = $fecha->add($suma);
                $fechaCalculada['fecha'] = $fecha->format('d-m-Y');
                break;
            case 'especializada':
                if($i==2){
                    $suma = new \DateInterval('P' . (1 ) . 'M');
                    //$fechaReceta = new \DateTime($fechaReceta);
                    //$fechaReceta = new \DateTime($fecha);
                    //$fecha = $fechaReceta->add($suma);
                    $fecha = $fecha->add($suma);
                    $fechaCalculada['fecha'] = $fecha->format('d-m-Y');
                }
                else{
                    $suma = new \DateInterval('P' . ($cantidad-1) . 'M');
                    //$fechaReceta = new \DateTime($fechaReceta);
                    //$fechaReceta = new \DateTime($fecha);
                    //$fecha = $fechaReceta->add($suma);
                    $fecha = $fecha->add($suma);
                    $fechaCalculada['fecha'] = $fecha->format('d-m-Y');
                }
                break;
        }
        return new Response(json_encode($fechaCalculada));
    }


    public function ValorarFestivoDiaHabil($Fecha,$Intervalo){
        $Fecha = $Fecha->format('Y-m-d');
        $query_festivos = "SELECT count(id) as id,fechaini,fechafin  "
                        . "FROM farm_evento "
                        . "WHERE '$Fecha' between fechaini AND fechafin "
                        . "GROUP BY fechaini,fechafin";
        $stm = $this->container->get('database_connection')->prepare($query_festivos);
        $stm->execute();
        $resultfestivos = $stm->fetchAll();
        $evaluar=0;
        $FechaDeEventoNuevo=0;

        $fecha = new \DateTime($Fecha);
        $fecha->sub(new \DateInterval('P'.$Intervalo.'D'));
        $FechaExtremoMinimo=$fecha->format('Y-m-d');
        foreach ($resultfestivos as $row){
            $FechaFinalNueva=$row['fechafin'];
            $FechaInicialNueva=$row['fechaini'];
            $IdDeEvento=$row['id'];
            if(!empty($FechaInicialNueva) || $FechaInicialNueva !=null ){
                $fecha = new \DateTime($FechaInicialNueva);
                $fecha->sub(new \DateInterval('P'.$Intervalo.'D'));
                $FechaExtremoMinimo=$fecha->format('Y-m-d');
            }
            else{
                $fecha = new \DateTime($Fecha);
                $fecha->sub(new \DateInterval('P'.$Intervalo.'D'));
                $FechaExtremoMinimo=$fecha->format('Y-m-d');
            }
            //$FechaInicialNueva = '2015-12-26';
            if($IdDeEvento==1){//Fecha esta dentro de la vacacion
                while($evaluar !=-1 && $FechaDeEventoNuevo==0){
                    $fecha = new \DateTime($FechaInicialNueva);
                    $fecha->add(new \DateInterval('P1D'));
                    $Fecha=$fecha->format('Y-m-d');
                    $DiaFecha=$fecha->format('N');

                    if($DiaFecha !=7 && $DiaFecha !=6){
                        $evaluar=0;
                    }else{
                        $evaluar=-1;
                    }

                    if ($evaluar==0){
                        $FechaDeEventoNuevo=1;
                    }
                }
            }
        }
        return $FechaExtremoMinimo.','.$Fecha;
    }

    /*
     * DESCRIPCIÓN: Método que verifica si una determinada fecha cae en dia sabado o domingo(Metodo tomado del sistema antiguo de prescripcion de medicamentos)
     * PARAMETROS ENTRADA:
     *          - FechaExtremoMinimo  =>  Fecha a validar.
     *  PARAMETROS RETORNO:
     *          -esnohabil=> retorna 0 si el dia no es sabado o doming / retorna 1 si el dia es sabado o domingo
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     */
    public function DiaHabil($FechaExtremoMinimo){
        $fecha = new \DateTime($FechaExtremoMinimo);
        $DiaFecha=$fecha->format('N');
        if($DiaFecha !=6 && $DiaFecha !=7){
            $esnohabil=0;
        }else{
            $esnohabil=-1;
        }
        return $esnohabil;
    }

    public function ProcesoParaEncontrarFechaHorario($FechaExtremoMinimo,$FechaExtremoMaximo,$IdHistorialClinico,$IdEstablecimiento,$Estado){
        $k=0;
        $bandera = 0;
        while($bandera==0){
            $esFest = $this->FechaFestiva($FechaExtremoMinimo);//Valida en la funcion que la fecha no sea festiva, retorna -1 si encuentra coincidencia y 0 de lo contrario
            $esnohabil= $this->DiaHabil($FechaExtremoMinimo);//Verifica que la fecha no caiga en sabado o domingo,retorna -1 si encuentra coincidencia y 0 de lo contrario
            $Cantidadencontrada = $this->comprobarsiexisterecetaconcita($IdHistorialClinico,$IdEstablecimiento,$FechaExtremoMinimo);
            if(strtotime($FechaExtremoMinimo) <= strtotime($FechaExtremoMaximo)){// Seguira comprobando hasta llegar a la fecha minima aceptable
                if (intval($Cantidadencontrada) != 0) {
                    $rslt = $FechaExtremoMinimo.'&'.$Cantidadencontrada;
                    $bandera = 1;
                }

                if($esnohabil==-1 || $esFest==-1){
                    $fecha = new \DateTime($FechaExtremoMinimo);
                    $fecha->add(new \DateInterval('P1D'));
                    $FechaExtremoMinimo = $fecha->format('Y-m-d');
                }
                else{
                    $FranjasyTotales=$this->CantidadDeCitasPorFranja($FechaExtremoMinimo, $IdEstablecimiento,$Estado);
                    $LimiteFranjas=$this->LimitePorFranja($Estado,$IdEstablecimiento);
                    list($array_ids_franjascitasdadas, $array_ids_totaldecitasdadas) = $FranjasyTotales;
                    list($array_ids_horarios, $array_ids_limites) = $LimiteFranjas;
                    $sizerangohrs=sizeof($array_ids_franjascitasdadas);
                    while($k < $sizerangohrs){
                        $dd_encontrado = array_search($array_ids_franjascitasdadas[$k], $array_ids_horarios);
                            if($array_ids_totaldecitasdadas[$k]<$array_ids_limites[$dd_encontrado]){
                                $rslt = $FechaExtremoMinimo.'&'.$array_ids_horarios[$dd_encontrado];
                                $bandera = 1;
                                $k=$sizerangohrs;
                            }//Endif
                        $k++;
                    }//EndWhile $k
                    $fechaaux = new \DateTime($FechaExtremoMinimo);
                    $fechaaux->add(new \DateInterval('P1D'));
                    $FechaExtremoMinimo = $fechaaux->format('Y-m-d');
                    $k=0;
                }
            }else{
                $bandera = 1;
            }
        }
        return $rslt;
    }

    function LimitePorFranja($Estado,$IdEstablecimiento){
        //$IdEstablecimiento=34;//Es el id nuevo del establecimiento tabla ctl_establecimiento para el Hospital Rosales
        $ids = array();
        $limites = array();

        if($Estado=='R'){
            $limite='limitedeldia';
        }else{
            $limite='limiterepetitiva';
        }
        $sqllimiteporfranja =   "SELECT id,$limite,hora_ini,hora_fin,meridianoini
                                    FROM farm_rangohora
                                    WHERE meridianoini ~ 'am' AND id_establecimiento=:establecimiento
                                UNION
                                SELECT id,$limite,hora_ini,hora_fin,meridianoini FROM farm_rangohora
                                    WHERE meridianoini ~ 'pm' AND id_establecimiento=:establecimiento
                                    ORDER BY meridianoini  asc,hora_ini";

        $stm = $this->container->get('database_connection')->prepare($sqllimiteporfranja);
        $stm->bindValue(':establecimiento', $IdEstablecimiento->getId());
        $stm->execute();
        $resultlimiteporfranja = $stm->fetchAll();
        foreach ($resultlimiteporfranja as $rows ){
            $ids[]=$rows['id'];
            $limites[]= $rows['limiterepetitiva'];
        }
        return array($ids,$limites);
    }



    public function comprobarsiexisterecetaconcita($IdHistorialClinico,$IdEstablecimiento,$FechaExtremoMaximo){
        //FALTA PONER AND IdArea <> 1 DE LA TABLA farm_recetas
        $query = "SELECT cantidad,id_rangohora
                    FROM farm_recetas tb01 JOIN sec_historial_clinico tb02 ON (tb01.idhistorialclinico = tb02.id)
                    JOIN farm_medicinarecetada tb03 ON (tb01.id = tb03.idreceta)
                    WHERE   tb02.id =:IdHistorialClinico AND
                            tb01.fecha =:FechaExtremoMaximo AND
                            tb02.idestablecimiento = :IdEstablecimiento AND
                            tb01.idestado='RE'AND
                            tb01.pacientestable='S' AND
                            tb01.id_rangohora is not null";
        $stm = $this->container->get('database_connection')->prepare($query);
        $stm->bindValue(':IdHistorialClinico', $IdHistorialClinico);
        $stm->bindValue(':FechaExtremoMaximo', $FechaExtremoMaximo);
        $stm->bindValue(':IdEstablecimiento', $IdEstablecimiento->getId());
        $stm->execute();
        $tempo= $stm->fetchAll();
        if(!empty($tempo)){
            foreach ($tempo as $row ){
                $var=$row['cantidad'];
            }
        }else{
            $var=0;
        }
        return $var;
    }

    //Consulta si la fecha que se envia es un dia festivo
    public function FechaFestiva($fech_act){
        $query_festivos = "SELECT id FROM farm_evento WHERE fechaini <= :fech_act AND fechafin >= :fech_act ";
        $stm = $this->container->get('database_connection')->prepare($query_festivos);
        $stm->bindValue(':fech_act', $fech_act);
        $stm->execute();
        $resultfestivos = $stm->fetchAll();
        if(count($resultfestivos) > 0){
            $esEvt=-1;
        }
        else{
            $esEvt = 0;
        }
        return $esEvt;
    }

    public function CantidadDeCitasPorFranja($Fecha,$IdEstablecimiento,$Estado){
        $cantidadxfranja = array();
        $franja = array();

        $sqlrangohora=   "SELECT farm_rangohora.id,COUNT( DISTINCT sec_historial_clinico.id_numero_expediente ),count(farm_recetas.id_rangohora)
                FROM farm_rangohora
                LEFT JOIN farm_recetas  ON (farm_rangohora.id=farm_recetas.id_rangohora
                                        AND farm_recetas.pacientestable ='S'
                                        AND farm_recetas.fecha = :fecha
                                        AND farm_recetas.id_rangohora is not null
                                        AND farm_recetas.idestado =:estado)
                LEFT JOIN sec_historial_clinico ON (farm_recetas.idhistorialclinico = sec_historial_clinico.id
                                        AND  sec_historial_clinico.idestablecimiento =:establecimiento)
                GROUP BY farm_rangohora.id
                ORDER BY COUNT(DISTINCT sec_historial_clinico.id_numero_expediente) ASC";

        $stm = $this->container->get('database_connection')->prepare($sqlrangohora);
        $stm->bindValue(':fecha', $Fecha);
        $stm->bindValue(':estado', $Estado);
        $stm->bindValue(':establecimiento', $IdEstablecimiento->getId());
        $stm->execute();
        $resultrangohora = $stm->fetchAll();
        foreach ($resultrangohora as $rows ){
            $franja[]=$rows['id'];
            $cantidadxfranja[]= $rows['count'];
        }
        return array($franja,$cantidadxfranja);
    }




    /*
     * DESCRIPCIÓN: Método que retorna si al selecionar un medicamento este ya ha sido prescrito 30 dias antes de la fecha actual
     *              Ademas consulta si un medicamento cuenta con formula de dosificacion(el caso por el momento aplica para la insulina) y si el medicamento se despachara a
     *              farmacia especializada
     * PARAMETROS ENTRADA:
     *          - idMedicamento
     *          - paramIdHistorialClinico
     *  PARAMETROS RETORNO:
     *          - id del medicamento
     *          - resetado => si el medicamento ya ha sido resetado al maciente hace 30 dias a partir de la fecha actual
     *          - dosis => si el medicamento cuenta con formula de dosificacion
     *          - medespecializada => si el medicamento se envia a farmacia especializada
     *
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

    /**
     * @Route("/consultar/medicina/recetada/{idMedicamento}/{paramIdHistorialClinico}", name="consultar_medicina_recetada", options={"expose"=true})
     * @Method("GET")
     */
    public function consultarMedicinaRecetadaAction($idMedicamento, $paramIdHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $idHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($paramIdHistorialClinico);
        $establecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $modalidad = $idHistorialClinico->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();

        //INICIO consulta para la busqueda de medicamentos que ya han sido prescritos
        $sqlmedicamentos = "SELECT count(idmedicina) as cuantos
                            FROM farm_recetas D, farm_medicinarecetada C,
                                sec_historial_clinico G, mnt_expediente H,farm_catalogoproductos I
                            WHERE
                                D.id = C.idreceta AND
                                D.idhistorialclinico = G.id AND
                                G.id_numero_expediente = H.id AND
                                C.idmedicina = I.id AND
                                (D.fecha <= current_date AND D.fecha >=current_date-30) AND
                                numero = :numero_expediente AND
                                C.idmedicina = :idmedicina";

        $stm = $this->container->get('database_connection')->prepare($sqlmedicamentos);
        $stm->bindValue(':numero_expediente', $idHistorialClinico->getIdExpediente()->getNumero());
        $stm->bindValue(':idmedicina', $idMedicamento);
        $stm->execute();
        $resultmedicamentos = $stm->fetchAll();
        //FIN consulta para la busqueda de medicamentos que ya han sido prescritos

        //INICIO consulta si medicamento cuenta con dosificacion y este sera enviado a farmacia especializada
        $sqldosis = "SELECT fcpxe.formula_dosificacion,fcpxe.medicamento_especializada,fcpxe.idmedicina as id,fcp.cuantificable,SUM(COALESCE(existencia,0)) AS existencia
                     FROM farm_catalogoproductos fcp
                        INNER JOIN farm_catalogoproductosxestablecimiento fcpxe ON (fcp.id=fcpxe.idmedicina)
                        INNER JOIN mnt_areamedicina mam ON (fcp.id=mam.idmedicina)
                        LEFT JOIN farm_medicinaexistenciaxarea fmea ON fcp.id=fmea.idmedicina
                     WHERE
                        fcpxe.idmedicina = :idmedicina AND
                        fcpxe.idestablecimiento = :idestablecimiento AND
                        fcpxe.idmodalidad = :idmodalidad
                    GROUP BY fcpxe.id,fcp.cuantificable";

        $stm = $this->container->get('database_connection')->prepare($sqldosis);
        $stm->bindValue(':idmedicina', $idMedicamento);
        $stm->bindValue(':idestablecimiento', $establecimiento->getId());
        $stm->bindValue(':idmodalidad', $modalidad);
        $stm->execute();
        $resultdosis = $stm->fetchAll();
        //FIN  consulta si medicamento cuenta con dosificacion y este sera enviado a farmacia especializada


        //INICIO consulta si medicamento cuenta con dosificacion y este sera enviado a farmacia especializada
        $sqldosificacion = "SELECT C.id as dosis,  C.abreviatura as nombre, B.id as medicina
                            FROM mnt_catalogoproductos_dosificacion A
                                INNER JOIN farm_catalogoproductos B  ON (A.id_catalogo_productos= B.id)
                                INNER JOIN farm_dosificacion C  ON ( C.id = A.id_dosificacion)
                            WHERE
                                B.id = :idmedicina";
        $stm = $this->container->get('database_connection')->prepare($sqldosificacion);
        $stm->bindValue(':idmedicina', $idMedicamento);
        $stm->execute();
        $resultdosificacion = $stm->fetchAll();
        //FIN  consulta si medicamento cuenta con dosificacion y este sera enviado a farmacia especializada


        $consultareceta['id'] = array('id' => $idMedicamento, 'resetado' => $resultmedicamentos[0]['cuantos'], 'dosis' => $resultdosis[0]['formula_dosificacion'],'medespecializada'=>$resultdosis[0]['medicamento_especializada'],'existencia'=>$resultdosis[0]['existencia'],'cuantificable'=>$resultdosis[0]['cuantificable'],'dosificacion'=>$resultdosificacion);
        return new Response(json_encode($consultareceta));
    }
}

?>
