<?php

namespace SilkSH\SecurityBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HTMLPurifier extends Constraint
{
    public $message = 'html_purifier.not_valid_html';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
