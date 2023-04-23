<?php

namespace App\Form;

use App\CampReservationSystem\Camp;
use App\CampReservationSystem\Camp\Team;
use App\Form\Types\PeselType;
use App\Form\Types\YesNoType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use libphonenumber\PhoneNumberFormat;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
                'label'=>'Podaj numer mieszkania zamieszkania dziecka (jeżeli potrzeba)',
                'required'=>false,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherName', TextType::class, [
                'label'=>'Podaj imię matki/opiekuna prawnego dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherSurname', TextType::class, [
                'label'=>'Podaj nazwisko matki/opiekuna prawnego dziecka*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>''
                ]
            ])
            ->add('motherAlive', YesNoType::class, [
                'label'=>'Czy matka/opiekun prawny dziecka żyje?*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'field-trigger',
                    'data-fields'=>'mother-address-yesno',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('motherAddressYesno', YesNoType::class, [
                'label'=>'Czy adres zamieszkania matki jest taki sam jak dziecka?*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'mother-address-yesno field-trigger',
                    'data-fields'=>'mother-address',
                    'data-show-value'=>'Nie'
                ]
            ])
            ->add('motherAddress', TextType::class, [
                'label'=>'Podaj adres zamieszkania matki (KOD POCZTOWY, MIEJSCOWOŚĆ, ULICA, NUMER DOMU/MIESZKANIA)',
                'required'=>false,
                'attr'=>[
                    'class'=>'mother-address-yesno mother-address'
                ]
            ])
            ->add('fatherName', TextType::class, [
                'label'=>'Podaj imię ojca/prawnego opiekuna dziecka',
                'required'=>false
            ])
            ->add('fatherSurname', TextType::class, [
                'label'=>'Podaj nazwisko ojca/prawnego opiekuna dziecka',
                'required'=>false
            ])
            ->add('fatherAlive', YesNoType::class, [
                'label'=>'Czy ojciec/opiekun prawny dziecka żyje?*',
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'field-trigger',
                    'data-fields'=>'father-address-yesno',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('fatherAddressYesno', YesNoType::class, [
                'label'=>'Czy adres zamieszkania ojca jest taki sam jak dziecka?',
                'required'=>true,
                'attr'=>[
                    'class'=>'father-address-yesno field-trigger',
                    'data-fields'=>'father-address',
                    'data-show-value'=>'Nie'
                ]
            ])
            ->add('fatherAddress', TextType::class, [
                'label'=>'Podaj adres zamieszkania ojca (KOD POCZTOWY, MIEJSCOWOŚĆ, ULICA, NUMER DOMU/MIESZKANIA)',
                'required'=>false,
                'attr'=>[
                    'class'=>'father-address-yesno father-address',
                ]
            ])
            ->add('phone1', PhoneNumberType::class, [
                'label'=>'Podaj numer telefonu opiekuna prawnego*',
                'required'=>true,
                'default_region'=>'PL',
                'format' => \libphonenumber\PhoneNumberFormat::NATIONAL
            ])
            ->add('phone1Owner', TextType::class, [
                'label'=>'Kogo to numer telefonu?*',
                'required'=>true,
                'help'=>'np. rodziców, ojca, matki, dziadka, babci'
            ])
            ->add('phone2', PhoneNumberType::class, [
                'label'=>'Podaj numer telefonu opiekuna prawnego',
                'required'=>false,
                'default_region'=>'PL',
                'format' => \libphonenumber\PhoneNumberFormat::NATIONAL
            ])
            ->add('phone2Owner', TextType::class, [
                'label'=>'Kogo to numer telefonu?',
                'required'=>false,
                'help'=>'np. rodziców, ojca, matki, dziadka, babci'
            ])
            ->add('email1', EmailType::class, [
                'label'=>'Podaj adres email rodzica*',
                'help'=>'Jeżeli jesteś pełnoletni, podaj tutaj swój adres email. Na ten adres email prześlemy również kartę kwalifikacyjną do wydruku!',
                'required'=>true
            ])
            ->add('email2', EmailType::class, [
                'label'=>'Podaj adres email drugiego rodzica',
                'required'=>false
            ])
            ->add('allergyYesno', YesNoType::class, [
                'label'=>'Czy dziecko jest na coś uczulone?',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'field-trigger',
                    'data-fields'=>'allergy',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('allergy', TextType::class, [
                'label'=>'Opisz, na co dziecko jest uczulone?',
                'required'=>false,
                'attr'=>[
                    'class'=>'allergy'
                ]
            ])
            ->add('dietYesno', YesNoType::class, [
                'label'=>'Czy dziecko korzysta z jakiejś specjalnej diety?',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'field-trigger',
                    'data-fields'=>'diet',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('diet', ChoiceType::class, [
                'label'=>'Z jakiej diety korzysta dziecko?',
                'choices'=>array_combine($diets, $diets),
                'required'=>false,
                'attr'=>[
                    'class'=>'diet'
                ]
            ])
            ->add('diseaseYesno', YesNoType::class, [
                'label'=>'Czy dziecko jest chore przewlekle?',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'field-trigger',
                    'data-fields'=>'disease',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('disease', TextType::class, [
                'label'=>'Na co dziecko choruje przewlekle?',
                'required'=>false,
                'attr'=>[
                    'class'=>'disease'
                ]
            ])
            ->add('medicinesYesno', YesNoType::class, [
                'label'=>'Czy dziecko zażywa stałe leki?',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'field-trigger',
                    'data-fields'=>'medicines',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('medicines', TextType::class, [
                'label'=>'Jakie stałe leki zażywa dziecko oraz w jakich dawkach?',
                'help'=>'Format: nazwa leku - pora podawania leku - dawka',
                'required'=>false,
                'attr'=>[
                    'class'=>'medicines'
                ]
            ])
            ->add('vaccinationYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione?',
                'help'=>'Chodzi o dowolne szczepienie',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'field-trigger',
                    'data-fields'=>'vaccination',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('tetanusYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na tężec?',
                'help'=>'https://szczepienia.pzh.gov.pl/szczepionki/tezec/',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'vaccination field-trigger',
                    'data-fields'=>'tetanus',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('tetanusYear', NumberType::class, [
                'label'=>'Podaj rok szczepienia dziecka na tężec',
                'help'=>'Liczba musi należeć do przedziału 1970 do 2050',
                'required'=>false,
                'attr'=>[
                    'class'=>'vaccination tetanus'
                ]
            ])
            ->add('diphtheriaYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na błonicę?',
                'help'=>'https://szczepienia.pzh.gov.pl/szczepionki/blonica/',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'vaccination field-trigger',
                    'data-fields'=>'diphtheria',
                    'data-show-value'=>'Tak'
                ]

            ])
            ->add('diphtheriaYear', NumberType::class, [
                'label'=>'Podaj rok szczepienia dziecka na błonicę',
                'help'=>'Liczba musi należeć do przedziału 1970 do 2050',
                'required'=>false,
                'attr'=>[
                    'class'=>'vaccination diphtheria'
                ]
            ])
           ->add('typhoidYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na dur?',
                'help'=>'np. brzuszny/plamisty/powrotny/rzekomy',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'vaccination field-trigger',
                    'data-fields'=>'typhoid',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('typhoidYear', NumberType::class, [
                'label'=>'Podaj rok szczepienia dziecka na dur',
                'help'=>'Liczba musi należeć do przedziału 1970 do 2050',
                'required'=>false,
                'attr'=>[
                    'class'=>'vaccination typhoid'
                ]
            ])
            ->add('otherVaccinationYesno', YesNoType::class, [
                'label'=>'Czy dziecko było szczepione na inne choroby?',
                'choices'=>$yesNoChoices,
                'required'=>true,
                'attr'=>[
                    'class'=>'vaccination field-trigger',
                    'data-fields'=>'other-vaccination',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('otherVaccinations', TextareaType::class, [
                'label'=>'Jeżeli dziecko miało jeszcze inne szczepienia ochronne, wprowadź je wraz z datami (na co i data)',
                'help'=>'Format: choroba - data szczepienia',
                'required'=>false,
                'attr'=>[
                    'class'=>'vaccination other-vaccination'
                ]
            ])
            ->add('disabilityYesno', YesNoType::class, [
                'label'=>'Czy dziecko ma orzeczenie o niepełnosprawności?',
                'choices'=>$yesNoChoices,
                'required'=>true,
            ])
            ->add('educationalNeeds', TextareaType::class, [
                'label'=>'Informacja o specjalnych potrzebach edukacyjnych uczestnika wypoczynku, w szczególności o potrzebach wynikających z niepełnosprawności, niedostosowania społecznego lub zagrożenia niedostosowaniem społecznym*',
                'help'=>'Wpisz "Brak" jeżeli nie ma specjalnych potrzeb. Czy któryś z rodziców ma odebrane/ograniczone prawa rodzicielskie?',
                'required'=>true
            ])
            ->add('otherNeeds', TextareaType::class, [
                'label'=>'Inne istotne dane o zdrowiu dziecka (aparat ortodontyczny, okulary korekcyjne, choroba lokomocyjna)*',
                'help'=>'Wpisz "Brak" jeżeli nie posiadasz istotnych danych o zdrowiu.',
                'required'=>true,
            ])
            /**
             * Sekcja III
             */
            ->add('swimmingYesno', YesNoType::class, [
                'label'=>'Czy dziecko potrafi pływać?*',
                'required'=>true,
                'choices'=>$yesNoChoices
            ])
            ->add('tshirt', ChoiceType::class, [
                'label'=>'Jakiego rozmiaru T-Shirt nosi dziecko?*',
                'required'=>true,
                'choices' => [
                    'Męskie'=>[
                        'Męska XS'=>'MXS','Męska S'=>'MS','Męska M'=>'MM','Męska L'=>'ML','Męska XL'=>'MXL','Męska XXL'=>'MXXL'
                    ],
                    'Damskie'=>[
                        'Damska XS'=>'DXS','Damska S'=>'DS','Damska M'=>'DM','Damska L'=>'DL','Damska XL'=>'DXL','Damska XXL'=>'DXXL'
                    ],
                    'Dziecięce'=>[
                        '106/116'=>'106/116','118/128'=>'118/128','130/140'=>'130/140','142/152'=>'142/152'
                    ]
                ]
            ])

            ->add('invoiceYesno', YesNoType::class, [
                'label'=>'Czy potrzebują Państwo uzyskać fakturę za obóz dziecka?',
                'choices'=>$yesNoChoices,
                'attr'=>[
                    'class'=>'field-trigger',
                    'data-fields'=>'invoice',
                    'data-show-value'=>'Tak'
                ]
            ])
            ->add('invoiceName', TextType::class, [
                'label'=>'Podaj imię i nazwisko / nazwę firmy na którą ma być wystawiona faktura',
                'required'=>false,
                'attr'=>[
                    'class'=>'invoice'
                ]
            ])
            ->add('invoiceAddress', TextType::class, [
                'label'=>'Podaj adres zamieszkania osoby/firmy na którą ma być wystawiona faktura (MIASTO, KOD POCZTOWY, ULICA OSIEDLE/NUMER DOMU)',
                'required'=>false,
                'attr'=>[
                    'class'=>'invoice'
                ]
            ])
            ->add('invoiceNip', TextType::class, [
                'label'=>'Podaj NIP (jeśli faktura ma być wystawiona na firmę).',
                'required'=>false,
                'attr'=>[
                    'class'=>'invoice'
                ]
            ])
            ->add('startDay', DateType::class, [
                'label'=>'Podaj termin w którym Twoje dziecko rozpocznie swój udział w obozie*',
                'required'=>true
            ])
            ->add('endDay', DateType::class, [
                'label'=>'Podaj termin w którym Twoje dziecko zakończy swój udział w obozie*',
                'required'=>true
            ])
            ->add('price', MoneyType::class, [
                'label'=>'Podaj koszt obozu dla Twojego dziecka*',
                'required'=>true,
                'currency'=>$camp->getCurrency()
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
