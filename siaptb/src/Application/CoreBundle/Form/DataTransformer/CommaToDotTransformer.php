<?php
namespace Application\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class CommaToDotTransformer implements DataTransformerInterface
{
	public function transform($number)
    {
        return str_replace(',', '.', $number);
    }
 
    public function reverseTransform($input)
    {
        return $input;
    }
}