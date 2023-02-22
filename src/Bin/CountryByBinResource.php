<?php

namespace Sidspears\Tax\Bin;

interface CountryByBinResource {
    public function country(int $bin): string;
}
