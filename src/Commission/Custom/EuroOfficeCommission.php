<?php

namespace Sidspears\Tax\Commission\Custom;

use Sidspears\Tax\Bin\BinCountry;
use Sidspears\Tax\Bin\CountryByBinResource;
use Sidspears\Tax\Currency\CurrencyResource;
use Sidspears\Tax\Transaction;

class EuroOfficeCommission extends CustomBody
{
    public function __construct(
        private Transaction $transaction,
        private CurrencyResource $currencyResource,
        private CountryByBinResource $binResource,
    ) {
    }

    protected function amount(): float
    {
        return $this->transaction->amount * $this->currencyCoef();
    }

    private function currencyCoef(): float
    {
        $resource = $this->currencyResource;
        return $resource->currency(
            from: $this->transaction->currency,
            to: "EUR"
        );
    }

    protected function rate(): float
    {
        $binCountry = new BinCountry(
            bin: $this->transaction->bin,
            resource: $this->binResource
        );

        return $binCountry->countryCode->isEU()
            ? 0.01
            : 0.02;
    }
}
