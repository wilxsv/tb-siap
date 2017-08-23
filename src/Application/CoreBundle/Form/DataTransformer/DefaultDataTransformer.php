<?php
namespace Application\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class DefaultDataTransformer implements DataTransformerInterface
{
	public function transform($data)
    {
        return $data;
    }
 
    public function reverseTransform($input)
    {
        return $input;
    }
}