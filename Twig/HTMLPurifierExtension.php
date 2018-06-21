<?php
/**
 * Created by PhpStorm.
 * User: tbalsys
 * Date: 6/1/18
 * Time: 4:53 PM
 */

namespace SilkSH\SecurityBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HTMLPurifierExtension extends AbstractExtension
{
    private $purifier;

    public function __construct()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $this->purifier = new \HTMLPurifier($config);
    }

    public function getFilters()
    {
        return array(
            new TwigFilter('purify', array($this, 'purifyFilter')),
        );
    }

    public function purifyFilter($html)
    {
        return $this->purifier->purify($html);
    }
}
