<?php

namespace App\CampRegistrationSystem;


interface RegistrationServiceInterface{
    /**
     * Makes registration
     *
     * @param RegistrationData $data
     * @return bool
     */
    public function register(RegistrationData $data):bool;
}