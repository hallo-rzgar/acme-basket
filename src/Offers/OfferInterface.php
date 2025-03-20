<?php

namespace Acme\Offers;

interface OfferInterface
{
    /**
     * Apply the offer to the basket.
     *
     * @param array<string, int> $itemCounts Associative array of item codes and their counts
     * @param array<string, float> $catalogue Associative array of product codes and their prices
     */
    public function apply(array $itemCounts, float $subtotal, array $catalogue): float;
}
