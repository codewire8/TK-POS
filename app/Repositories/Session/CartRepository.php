<?php

namespace App\Repositories\Session;

use App\Repositories\Contracts\CartRepositoryContract;
use Illuminate\Contracts\Session\Session;

class CartRepository implements CartRepositoryContract
{
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function addItems(string $pcode, string $product, int $qty): void
    {
        $this->session->put($pcode, $product, $qty);
    }
}
