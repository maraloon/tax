<?php

namespace Sidspears\Tax\Commission;

class Commission
{
    public function __construct(private float $amount, private float $rate)
    {
    }

    public function commission(): float
    {
        return $this->amount * $this->rate;
    }
}
