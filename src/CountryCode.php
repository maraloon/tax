<?php

namespace Sidspears\Tax;

use Exception;

class CountryCode
{
    private string $country;

    public function __construct(string $country)
    {
        if (strlen($country) !== 2) {
            throw new Exception("false country code format");
        }

        $this->country = strtoupper($country);
    }

    public function isEU(): bool
    {
        $euCountrycodes = array(
            'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'EL',
            'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV',
            'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK'
        );
        return (in_array($this->country, $euCountrycodes));
    }
}
