<?php

namespace App\CampRegistrationSystem;

use App\CampRegistrationSystem\Camp\Team;

use App\CampRegistrationSystem\Values\YesNoValue;
use JsonSerializable;
use libphonenumber\PhoneNumberUtil;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;
use PharIo\Manifest\Email;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumber;
use NumberToWords\NumberToWords;

class RegistrationData implements \JsonSerializable
{
    protected string $id;
    public string $internalCampId;
    public ?Team $team = null;

    #[NotBlank]
    #[Regex(pattern: '/^[A-Za-z\p{L}]+/u', message: 'Imię może składać się z wielkich liter, małych liter oraz polskich znaków.')]
    #[Length(max: 40)]
    public ?string $name = null;

    #[NotBlank]
    #[Regex(pattern: '/^[A-Za-z\-\s\p{L}]+/u', message: 'Nazwisko może składać się z wielkich liter, małych liter, polskich znaków oraz myślnika i spacji.')]
    #[Length(max: 40)]
    public ?string $surname = null;

    #[NotBlank]
    #[Length(exactly: 11)]
    #[Regex(pattern: '/^[0-9]{11}$/', message: 'Pesel to 11 cyfr.')]
    public ?string $pesel = null;

    #[NotBlank]
    #[Length(max: 40)]
    #[Regex(pattern: '/^[A-Za-z\-\s\p{L}]+$/u', message: 'Miasto może składać się z wielkich liter, małych liter, myślnika oraz polskich znaków.')]
    public ?string $city = null;

    #[NotBlank]
    #[Regex(pattern: '/^\d{2}-\d{3}$/')]
    public ?string $postalCode = null;

    #[NotBlank]
    #[Regex(pattern: '/^[a-zA-Z\.\-0-9\p{L}\s]+$/u')]
    public ?string $street = null;

    #[NotBlank]
    #[Regex(pattern: '/^[0-9]+([a-zA-Z\s]{1,3})?$/')]
    public ?string $house = null;

    #[Regex(pattern: '/^[0-9]+$/')]
    public ?string $flat = null;

    #[NotBlank]
    #[Regex(pattern: '/^[A-Za-z\p{L}]+/u')]
    #[Length(max: 40)]
    public ?string $motherName = null;

    #[NotBlank]
    #[Regex(pattern: '/^[A-Za-z\-\s\p{L}]+/u')]
    #[Length(max: 40)]
    public ?string $motherSurname = null;

    #[NotBlank]
    public ?YesNoValue $motherAlive = null;

    #[NotBlank]
    public ?YesNoValue $fatherAlive = null;


    public ?YesNoValue $motherAddressYesno = null;


    #[Regex(pattern: '/^[A-Za-z\-\s\.0-9\p{L}]+/u')]
    #[Length(max: 100)]
    public ?string $motherAddress = null;


    #[Regex(pattern: '/^[A-Za-z\p{L}]+/u')]
    #[Length(max: 40)]
    public ?string $fatherName = null;

    #[Regex(pattern: '/^[A-Za-z\-\s\p{L}]+/u')]
    #[Length(max: 40)]
    public ?string $fatherSurname = null;


    public ?YesNoValue $fatherAddressYesno = null;

    #[Regex(pattern: '/^[A-Za-z\-\s\.0-9\p{L}]+$/u')]
    #[Length(max: 100)]
    public ?string $fatherAddress = null;

    #[NotBlank]
    #[AssertPhoneNumber(format: PhoneNumberFormat::NATIONAL)]
    public $phone1 = null;

    #[NotBlank]
    #[Length(max: 40)]
    public ?string $phone1Owner = null;

    #[AssertPhoneNumber()]
    public $phone2 = null;

    #[Length(max: 40)]
    public ?string $phone2Owner = null;

    #[NotBlank]
    #[Email]
    public ?string $email1 = null;

    #[Email]
    public ?string $email2 = null;

    #[NotBlank]
    public ?YesNoValue $allergyYesno = null;

    public ?string $allergy = null;

    #[NotBlank]
    public ?YesNoValue $dietYesno = null;

    public ?string $diet = null;

    #[NotBlank]
    public ?YesNoValue $diseaseYesno = null;

    public ?string $disease = null;

    #[NotBlank]
    public ?YesNoValue $medicinesYesno = null;

    public ?string $medicines = null;

    #[NotBlank]
    public ?YesNoValue $vaccinationYesno = null;

    #[NotBlank]
    public ?YesNoValue $tetanusYesno = null;

    #[Regex(pattern:'/^(19|20|21|22)[0-9]{2}$/')]
    public ?string $tetanusYear = null;

    #[NotBlank]
    public ?YesNoValue $diphtheriaYesno = null;

    #[Regex(pattern:'/^(19|20|21|22)[0-9]{2}$/')]
    public ?string $diphtheriaYear = null;

    #[NotBlank]
    public ?YesNoValue $typhoidYesno = null;

    #[Regex(pattern:'/^(19|20|21|22)[0-9]{2}$/')]
    public ?string $typhoidYear = null;

    #[NotBlank]
    public ?YesNoValue $otherVaccinationYesno = null;


    public ?string $otherVaccinations = null;

    #[NotBlank]
    public ?YesNoValue $disabilityYesno = null;

    #[NotBlank]
    public ?string $educationalNeeds = null;

    #[NotBlank]
    public ?string $otherNeeds = null;

    #[NotBlank]
    public ?YesNoValue $swimmingYesno = null;

    #[NotBlank]
    #[Regex(pattern:'/^(DXS|DS|DM|DL|DXL|DXXL|DXXXL|MXS|MS|MM|ML|MXL|MXXL|MXXXL|[0-9\/]+)$/')]
    public ?string $tshirt = null;

    #[NotBlank]
    public ?YesNoValue $invoiceYesno = null;


    #[Regex(pattern: '/^[A-Za-z\-\"\']+/')]
    #[Length(max: 100)]
    public ?string $invoiceName = null;

    #[Regex(pattern: '/^[A-Za-z\-\s\.0-9]+$/')]
    #[Length(max: 100)]
    public ?string $invoiceAddress = null;

    #[Regex(pattern: '/^[0-9]{10}$/')]
    #[Length(exactly: 10)]
    public ?string $invoiceNip = null;

    public ?\DateTime $startDay = null;
    public ?\DateTime $endDay = null;

    #[NotBlank]
    #[Positive]
    public ?float $price = null;


    public function jsonSerialize()
    {
        // todo: extract to the service
        $converter = new NumberToWords();
        $transformer = $converter->getNumberTransformer('pl');

        $data = array_merge([
            'price_text'=>$transformer->toWords(floor($this->price)).' zł '.sprintf('%02d gr', ($this->price - floor($this->price))*100)
        ], get_object_vars($this));
        $formatter = \libphonenumber\PhoneNumberUtil::getInstance();
        $nestedData = array_map(function ($item) use ($formatter) {
            if ($item instanceof JsonSerializable) {
                return $item->jsonSerialize();
            }
            if ($item instanceof PhoneNumber) {
                return $formatter->format($item, PhoneNumberFormat::INTERNATIONAL);
            }
            if ($item === null) {
                return "";
            }
            if ($item instanceof \DateTime) {
                return $item->format("Y-m-d");
            }
            return $item;
        }, $data);
        return $nestedData;
    }

    public function __construct(Camp $camp)
    {
        $this->id =  Uuid::v4()->__toString();
        $this->internalCampId = $camp->getInternalCampId();
        $this->disabilityYesno = YesNoValue::NO();
        $this->motherAlive = YesNoValue::YES();
        $this->fatherAlive = YesNoValue::YES();
        $this->motherAddressYesno = YesNoValue::YES();
        $this->fatherAddressYesno = YesNoValue::YES();
        $this->allergyYesno = YesNoValue::NO();
        $this->dietYesno = YesNoValue::NO();
        $this->diseaseYesno = YesNoValue::NO();
        $this->medicinesYesno = YesNoValue::NO();
        $this->vaccinationYesno = YesNoValue::NO();
        $this->tetanusYesno = YesNoValue::YES();
        $this->diphtheriaYesno = YesNoValue::YES();
        $this->typhoidYesno = YesNoValue::YES();
        $this->invoiceYesno = YesNoValue::NO();
    }
}
