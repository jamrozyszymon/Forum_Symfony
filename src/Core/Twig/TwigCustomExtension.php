<?php

namespace App\Core\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigCustomExtension extends AbstractExtension
{

    /** @var ContainerInterface */
    private $container;
    //arugmenty są okreslone w services.yaml
    public function __construct($container)
    {
        $this->container=$container;   
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('convertPrice', [$this, 'convertPrice'])
        ];
    }

    public function convertPrice(float $price): string
    {
        $parts=explode('.', $price);
        $html = '</br>'.$parts[0].'</br>'.$parts[1];
        return $html;
    }
}
