<?php

namespace App\Form\Types;

use App\CampRegistrationSystem\Values\YesNoValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class YesNoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new CallbackTransformer(
            function (?YesNoValue $value): ?string {
                if (!$value) {
                    return null;
                }
                return $value->toString();
            },
            function (?string $value): ?YesNoValue {
                if (!$value) {
                    return null;
                }
                return new YesNoValue($value);
            }
        ));
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'choices'=>YesNoValue::$availableValues
        ]);
    }
}
