<?php

namespace Application\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Application\CoreBundle\Entity\FrmFormulario;
use Doctrine\DBAL as DBAL;

/**
 * ConexionRepository
 *
 */
class FrmFormularioRepository extends EntityRepository
{
    public function getFormularioPorCodigo($codigo)
    {
         $sql = "SELECT id from frm_formulario where codigo='$codigo' limit 1";

        $datos = $this->getEntityManager()->getConnection()->executeQuery($sql)->fetchColumn(0);
        
        return $datos;
    }

}
