<?php
// src/Minsal/SiapsBundle/Form/DataTransformer/MntCiqToStringTransformer.php
namespace Minsal\SiapsBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TaskBundle\Entity\Issue;

class MntCiqToStringTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (MntCiq) to a string (number).
     *
     * @param  MntCiq|null $idCiq
     * @return string
     */
    public function transform($idCiq)
    {
        if (null === $idCiq) {
            return "";
        }

        return $idCiq->getId();
    }

    /**
     * Transforms a string (number) to an object (MntCiq).
     *
     * @param  string $number
     *
     * @return MntCiq|null
     *
     * @throws TransformationFailedException if object (MntCiq) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }

        $idCiq = $this->om
            ->getRepository('MinsalSiapsBundle:MntCiq')
            ->findOneBy(array('id' => $number))
        ;

        if (null === $idCiq) {
            throw new TransformationFailedException(sprintf(
                'An issue with id "%s" does not exist!',
                $number
            ));
        }

        return $idCiq;
    }
}
