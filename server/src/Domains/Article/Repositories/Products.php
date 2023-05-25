<?php declare(strict_types=1);

namespace Domains\Article\Repositories;

use Domains\Article\ValueObjects\ProductName;

interface Products
{
    public function withTheGivenNameDoNotExist(ProductName $name): bool;
}
