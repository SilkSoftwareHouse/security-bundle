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


class TagWhitelistValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) return;
        /**
         * @var TagWhitelist $constraint
         */
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($value);

        foreach($doc->getElementsByTagName('*') as $element ){
            if (!in_array($element->nodeName, $constraint->allowedTags)) {
                $this->context->buildViolation($constraint->allowedTagsMessage)
                    ->setParameter('{{ allowed_tags }}', join(', ', $constraint->allowedTags))
                    ->addViolation();
                return;
            }

            for($i = $element->attributes->length -1; $i >= 0; $i--){
                $attribute = $element->attributes->item($i);
                if(!in_array($attribute->name, $constraint->allowedAttributes)) {
                    //$element->removeAttributeNode($attribute);
                    $this->context->buildViolation($constraint->allowedAttributesMessage)
                        ->setParameter('{{ allowed_attributes }}', join(', ', $constraint->allowedAttributes))
                        ->addViolation();
                    return;
                }
            }
        }
    }
}
