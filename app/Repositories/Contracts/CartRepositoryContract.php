<?php

namespace App\Repositories\Contracts;

// Add items to basket

interface CartRepositoryContract
{
    public function addItems(string $pcode, string $product, int $qty): void;
}
