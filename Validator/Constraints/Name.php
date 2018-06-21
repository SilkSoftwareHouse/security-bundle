<?php

namespace SilkSH\SecurityBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Name extends Constraint
{
    public $message = 'name.not_allowed_signs';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
