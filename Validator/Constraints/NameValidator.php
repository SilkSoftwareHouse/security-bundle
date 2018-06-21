<?php
/**
 * Created by PhpStorm.
 * User: lech
 * Date: 21/05/18
 * Time: 10:01
 */

namespace SilkSH\SecurityBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class NameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /**
         * @var Name $constraint
         */

        if (!preg_match("/^[\pL0-9 \\+\\_,.@\"'-]*$/u", $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ allowed_signs }}', 'A-z 0-9 - + _ . , @ " \'')
                ->addViolation();
        }
    }
}
