<?php

namespace Sidspears\Tax\Currency;

interface CurrencyResource
{
    public function currency(string $from, string $to): float;
}
