<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sidspears\Tax\Bin\CountryByBinResource;
use Sidspears\Tax\Commission\Custom\EuroOfficeCommission;
use Sidspears\Tax\Currency\CurrencyResource;
use Sidspears\Tax\Transaction;

final class CountCommissionTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testCount(
        float $currencyMock,
        string $countryMock,
        int $bin,
        float $amount,
        string $currency,
        float $expected): void
    {

        $currencyResource = $this->createMock(CurrencyResource::class);
        $currencyResource
            ->method('currency')
            ->with($this->equalTo($currency), $this->equalTo("EUR"))
            ->will($this->returnValue($currencyMock));

        $binResource = $this->createMock(CountryByBinResource::class);
        $binResource
            ->method('country')
            ->with($this->equalTo($bin))
            ->will($this->returnValue($countryMock));

        $transaction = new Transaction($bin, $amount, $currency);
        $euroOffice = new EuroOfficeCommission($transaction, $currencyResource, $binResource);

        $this->assertSame($expected, $euroOffice->commission());
    }

    public function additionProvider(): array
    {
        return [
            [1.00, 'NL', 45717360, 100.00, 'EUR', 1.00],
            [0.9389, 'LT', 516793, 50.00, 'USD', 0.47],
            [0.0070, 'JP', 45417360, 10000.00, 'JPY', 1.40],
            [0.9389, 'US', 41417360, 130.00, 'USD', 2.44],
            [1.1397, 'UK', 4745030, 2000.00, 'GBP', 45.59],
        ];
    }
}
