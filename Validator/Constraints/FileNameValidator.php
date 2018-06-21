<?php
/**
 * Created by PhpStorm.
 * User: lech
 * Date: 21/05/18
 * Time: 10:01
 */

namespace SilkSH\SecurityBundle\Validator\Constraints;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class FileNameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value) {
            return;
        }

        if (!($value instanceof UploadedFile)) {
            throw new UnexpectedTypeException($value, UploadedFile::class);
        }

        /**
         * @var FileName $constraint
         */
        $filename = $value->getClientOriginalName();
        if (strlen($filename) > $constraint->maxFilenameLength) {
            $this->context
                ->buildViolation($constraint->maxFilenameLengthMessage)
                ->setParameter('{{ max_length }}', $constraint->maxFilenameLength)
                ->addViolation();
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($extension, $constraint->allowedExtensions)) {
            $this->context
                ->buildViolation($constraint->allowedExtensionsMessage)
                ->setParameter('{{ extension }}', $extension)
                ->setParameter('{{ extensions }}', join(', ', $constraint->allowedExtensions))
                ->addViolation();
        }
    }
}
