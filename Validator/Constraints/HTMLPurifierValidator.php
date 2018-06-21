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


class HTMLPurifierValidator extends ConstraintValidator
{
    private $purifier;

    public function __construct()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('Core.CollectErrors', true);
        $this->purifier = new \HTMLPurifier($config);
    }

    public function validate($value, Constraint $constraint)
    {
        /**
         * @var HTMLPurifier $constraint
         */
        $this->purifier->purify($value);
        $errors = $this->purifier->context->get('ErrorCollector')->getRaw();
        if ($errors) {
            /*
             * non translatable english error messages
            foreach ($errors as $error) {
                $this->context
                    ->buildViolation($error[2] ?? '')
                    ->addViolation();
            }
            */

            // translatable error message
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
