<?php

namespace App\Form\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PeselType extends AbstractType
{
    public function getParent(): string
    {
        return TextType::class;
    }
}
