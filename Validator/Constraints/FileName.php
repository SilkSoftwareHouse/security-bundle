<?php

namespace SilkSH\SecurityBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FileName extends Constraint
{
    public $maxFilenameLengthMessage = 'filename.too_long';
    public $maxFilenameLength = 100;

    public $allowedExtensionsMessage = 'filename.extension_not_allowed';
    public $allowedExtensions = [
        'pdf',
        'txt',
        'doc',
        'docx',
        'ppt',
        'pptx',
        'jpg',
        'jpeg',
        'png'
    ];

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
