<?php

namespace SilkSH\SecurityBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TagWhitelist extends Constraint
{
    public $allowedTagsMessage = 'tag_whitelist.tags';
    public $allowedTags = [
        'html',
        'head',
        'meta',
        'title',
        'style',
        'body',
        'table',
        'tr',
        'th',
        'td',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'p',
        'a',
        'img',
        'br',
        'span',
        'small',
    ];

    public $allowedAttributesMessage = 'tag_whitelist.attributes';
    public $allowedAttributes = [
        'width',
        'align',
        'cellspacing',
        'cellpadding',
        'class',
        'style',
        'href',
        'http-equiv',
        'name',
        'alt',
        'border',
        'content',
        'bgcolor',
        'type',
        'target',
        'src',
    ];

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
