<?php

namespace App\CampRegistrationSystem\Impl;
use App\CampRegistrationSystem\Camp;
use App\CampRegistrationSystem\RegistrationData;
use Munus\Collection\Stream;

interface ClientInterface{
    /**
     * Undocumented function
     *
     * @return Stream<Camp>
     */
    public function getCamps():Stream;

    /**
     * Undocumented function
     *
     * @param RegistrationData $data
     * @return void
     */
    public function register(RegistrationData $data): void;

    public function reportError($data):void;
}