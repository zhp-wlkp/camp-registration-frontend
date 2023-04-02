<?php

namespace App\Form;

use App\CampReservationSystem\Camp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Camp $camp */
        $camp = $options['camp'];
        $builder
            ->add('team', ChoiceType::class, [
                'label'=>'Wybierz drużynę, z którą na obóz udaje się zgłaszany uczestnik',
                'choices'=> $camp->getTeams(),
                'choice_value'=>'name',
                'choice_label'=>'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'camp'=>null
        ]);
    }
}
