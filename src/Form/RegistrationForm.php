<?php

namespace App\Form;

use App\CampReservationSystem\Camp;
use App\CampReservationSystem\Camp\Team;
use App\Form\Types\PeselType;
use App\Form\Types\YesNoType;
use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Camp $camp */
        $camp = $options['camp'];
        $yesNoChoices = ['Tak'=>'Tak', 'Nie'=>'Nie'];
        $diets = ['Bezglutenowa','Bezlaktozowa','Wegetariańska','Wegańska','Inne'];
        $builder
            ->add('team', ChoiceType::class, [
                'label'=>'Wybierz drużynę, z którą na obóz udaje się zgłaszany uczestnik*',
                'choices'=> $camp->getTeams(),
                'choice_value'=>'name',
                'choice_label'=>'name',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('name', TextType::class, [
                'label'=>'Podaj imię dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('surname', TextType::class, [
                'label'=>'Podaj nazwisko dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('pesel', PeselType::class, [
                'label'=>'Podaj PESEL dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('city', TextType::class, [
                'label'=>'Podaj miejscowość zamieszkania dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label'=>'Podaj kod pocztowy zamieszkania dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('street', TextType::class, [
                'label'=>'Podaj ulicę/osiedle zamieszkania dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('house', TextType::class, [
                'label'=>'Podaj numer domu zamieszkania dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('flat', TextType::class, [
                'label'=>'Podaj numer mieszkania zamieszkania dziecka',
                'required'=>false,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherName', TextType::class, [
                'label'=>'Podaj imię matki dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherSurname', TextType::class, [
                'label'=>'Podaj nazwisko matki dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherAddressYesno', YesNoType::class, [
                'label'=>'Czy adres zamieszkania matki jest taki sam jak dziecka?*',
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherAddress', TextType::class, [
                'label'=>'Podaj adres zamieszkania matki (KOD POCZTOWY, MIEJSCOWOŚĆ, ULICA, NUMER DOMU/MIESZKANIA)'
            ])
            ->add('fatherName', TextType::class, [
                'label'=>'Podaj imię ojca dziecka'
            ])
            ->add('fatherSurname', TextType::class, [
                'label'=>'Podaj nazwisko ojca dziecka'
            ])
            ->add('fatherAddressYesno', YesNoType::class, [
                'label'=>'Czy adres zamieszkania ojca jest taki sam jak dziecka?'
            ])
            ->add('fatherAddress', TextType::class, [
                'label'=>'Podaj adres zamieszkania ojca (KOD POCZTOWY, MIEJSCOWOŚĆ, ULICA, NUMER DOMU/MIESZKANIA)'
            ])
            ->add('phone1', PhoneNumberType::class, [
                'label'=>'Podaj numer telefonu opiekuna prawnego',
                'default_region'=>'PL', 
                'format' => \libphonenumber\PhoneNumberFormat::NATIONAL
            ])
            ->add('phone1Owner', TextType::class, [
                'label'=>'Kogo to numer telefonu?'
            ])
            ->add('phone2', PhoneNumberType::class, [
                'label'=>'Podaj numer telefonu opiekuna prawnego',
                'default_region'=>'PL', 
                'format' => \libphonenumber\PhoneNumberFormat::NATIONAL
            ])
            ->add('phone2Owner', TextType::class, [
                'label'=>'Kogo to numer telefonu?'
            ])
            ->add('email1', EmailType::class, [
                'label'=>'Podaj adres email rodzica'
            ])
            ->add('email2', EmailType::class, [
                'label'=>'Podaj adres email drugiego rodzica'
            ])
            ->add('allergyYesno', YesNoType::class, [
                'label'=>'Czy dziecko jest na coś uczulone?',
                'choices'=>$yesNoChoices
            ])
            ->add('allergy', TextType::class, [
                'label'=>'Opisz, na co dziecko jest uczulone?'
            ])
            ->add('dietYesno', YesNoType::class, [
                'label'=>'Czy dziecko jest na coś uczulone?',
                'choices'=>$yesNoChoices
            ])
            ->add('diet', ChoiceType::class, [
                'label'=>'Z jakiej diety korzysta dziecko?',
                'choices'=>array_combine($diets, $diets)
            ])
            ->add('diseaseYesno', YesNoType::class, [
                'label'=>'Czy dziecko jest chore przewlekle?',
                'choices'=>$yesNoChoices
            ])
            ->add('disease', TextType::class, [
                'label'=>'Na co dziecko choruje przewlekle?',
            ])
            ->add('medicinesYesno', YesNoType::class, [
                'label'=>'Czy dziecko zażywa stałe leki?',
                'choices'=>$yesNoChoices
            ])
            ->add('medicines', TextType::class, [
                'label'=>'Jakie stałe leki zażywa dziecko oraz w jakich dawkach?',
            ])
            ->add('vaccinationYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione?',
                'choices'=>$yesNoChoices
            ])
            ->add('tetanusYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na tężec?',
                'choices'=>$yesNoChoices
            ])
            ->add('tetanusYear', NumberType::class, [
                'label'=>'Podaj rok szczepienia dziecka na tężec',
            ])
            ->add('diphtheriaYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na błonicę?',
                'choices'=>$yesNoChoices
            ])
            ->add('diphtheriaYear', NumberType::class, [
                'label'=>'Podaj rok szczepienia dziecka na błonicę',
            ])
           ->add('typhoidYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na dur?',
                'choices'=>$yesNoChoices
            ])
            ->add('typhoidYear', NumberType::class, [
                'label'=>'Podaj rok szczepienia dziecka na dur',
            ])
            ->add('otherVaccinationYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na inne choroby?',
                'choices'=>$yesNoChoices
            ])
            ->add('otherVaccinations', TextareaType::class, [
                'label'=>'Jeżeli dziecko miało jeszcze inne szczepienia ochronne, wprowadź je wraz z datami (na co i data)',
            ])
            ->add('disabilityYesno', YesNoType::class, [
                'label'=>'Czy dziecko ma orzeczenie o niepełnosprawności?',
                'choices'=>$yesNoChoices
            ])
            ->add('educationalNeeds', TextareaType::class, [
                'label'=>'Informacja o specjalnych potrzebach edukacyjnych uczestnika wypoczynku, w szczególności o potrzebach wynikających z niepełnosprawności, niedostosowania społecznego lub zagrożenia niedostosowaniem społecznym',
            ])
            ->add('otherNeeds', TextareaType::class, [
                'label'=>'Inne istotne dane o zdrowiu dziecka (aparat ortodontyczny, okulary korekcyjne, choroba lokomocyjna)',
            ])
            /**
             * Sekcja III
             */
            ->add('swimmingYesno', YesNoType::class, [
                'label'=>'Czy dziecko potrafi pływać?',
                'choices'=>$yesNoChoices
            ])
            ->add('tshirt', ChoiceType::class, [
                'label'=>'Jakiego rozmiaru T-Shirt nosi dziecko?',
                'choices' => [
                    'Męskie'=>[
                        'XS'=>'MXS','S'=>'MS','M'=>'MM','L'=>'ML','XL'=>'MXL','XXL'=>'MXXL'
                    ],
                    'Damskie'=>[
                        'XS'=>'MXS','S'=>'DS','M'=>'DM','L'=>'DL','XL'=>'DXL','XXL'=>'DXXL'
                    ],
                    'Dziecięce'=>[
                        '106/116'=>'106/116','118/128'=>'118/128','130/140'=>'130/140','142/152'=>'142/152'
                    ]
                ]
            ])

            ->add('invoiceYesno', YesNoType::class, [
                'label'=>'Czy potrzebują Państwo uzyskać fakturę za obóz dziecka?',
                'choices'=>$yesNoChoices
            ])
            ->add('invoiceName', TextType::class, [
                'label'=>'Podaj imię i nazwisko / nazwę firmy na którą ma być wystawiona faktura',
            ])
            ->add('invoiceAddress', TextType::class, [
                'label'=>'Podaj adres zamieszkania osoby/firmy na którą ma być wystawiona faktura (MIASTO, KOD POCZTOWY, ULICA OSIEDLE/NUMER DOMU)',
            ])
            ->add('invoiceNip', TextType::class, [
                'label'=>'Podaj NIP (jeśli faktura ma być wystawiona na firmę).',
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Zgłoś uczestnika na obóz'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'camp'=>null
        ]);
    }
}
