<?php

namespace Sidspears\Tax\Bin;

use Sidspears\Tax\CountryCode;

class BinCountry
{
    public int $bin;
    public CountryCode $countryCode;

    public function __construct(int $bin, CountryByBinResource $resource) {
        $this->bin = $bin;
        $this->countryCode = new CountryCode($resource->country($bin));
    }
}
