<?php

namespace Acme\Offers;

class BuyOneGetOneHalfOffOffer implements OfferInterface
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    /**
     * Apply the "Buy one, get one half off" discount.
     *
     * @param array<string, int> $itemCounts Associative array of item codes and their counts
     * @param array<string, float> $catalogue Associative array of product codes and their prices
     */
    public function apply(array $itemCounts, float $subtotal, array $catalogue): float
    {
        if (!isset($itemCounts[$this->productCode])) {
            return $subtotal;
        }

        $count = $itemCounts[$this->productCode];
        $price = $catalogue[$this->productCode];

        $discountedItems = intdiv($count, 2);
        $discount = round(($price / 2) * $discountedItems, 2);

        return round($subtotal - $discount, 2);
    }
}
