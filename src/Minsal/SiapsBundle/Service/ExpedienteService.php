<?php
namespace Minsal\SiapsBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ExpedienteService
{

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /*
     * DESCRIPCIÓN: Obtener el id de expediente activo para un paciente
     * PARAMETROS: id del paciente
     *
     * ANALISTA PROGRAMADOR: Victoria López.
     */
    public function obtenerExpedientePaciente($idPaciente) {

        $sql = "SELECT A.id
                FROM mnt_expediente A
                WHERE A.habilitado = true AND A.id_paciente = $idPaciente";

        $stm = $this->container->get('database_connection')->prepare($sql);

        $stm->execute();
        $result = $stm->fetch();

        return $result['id'];
    }
}
