<?php

namespace Sidspears\Tax\Commission\Custom;

use Sidspears\Tax\Commission\Commission;
use Sidspears\Tax\Commission\CountCommission;

abstract class CustomBody implements CountCommission
{
    public function commission(): float
    {
        $amount = $this->amount();
        $rate = $this->rate();
        $commission = new Commission($amount, $rate);
        return round($commission->commission(), 2);
    }

    abstract protected function amount(): float;
    abstract protected function rate(): float;
}
