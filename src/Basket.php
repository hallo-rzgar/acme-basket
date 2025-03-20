<?php

namespace Acme;

use Acme\Offers\OfferInterface;

class Basket
{
    /**
     * @var string[] List of added product codes
     */
    private array $items = [];

    /**
     * @param array<string, float> $catalogue
     * @param array<int, array{threshold: float, cost: float}> $deliveryRules
     * @param OfferInterface[] $offers
     */
    public function __construct(
        private array $catalogue,
        private array $deliveryRules,
        private array $offers = []
    ) {
    }

    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new \InvalidArgumentException("Unknown product code: $productCode");
        }

        $this->items[] = $productCode;
    }

    public function total(): float
    {
        $itemCounts = array_count_values($this->items);
        $subtotal = 0.0;

        foreach ($itemCounts as $code => $count) {
            $price = $this->catalogue[$code];
            $lineTotal = round($price * $count, 2);
            $subtotal += $lineTotal;
        }

        foreach ($this->offers as $offer) {
            $subtotal = $offer->apply($itemCounts, $subtotal, $this->catalogue);
        }

        $delivery = $this->calculateDelivery($subtotal);

        return round($subtotal + $delivery, 2);
    }

    private function calculateDelivery(float $subtotal): float
    {
        foreach ($this->deliveryRules as $rule) {
            if ($subtotal >= $rule['threshold']) {
                return $rule['cost'];
            }
        }

        return 0.0;
    }
}
