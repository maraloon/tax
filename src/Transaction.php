<?php

namespace Sidspears\Tax;

class Transaction
{
    public function __construct(
        public int $bin,
        public float $amount,
        public string $currency
    ) {
    }
}
