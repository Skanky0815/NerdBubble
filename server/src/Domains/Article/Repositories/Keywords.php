<?php

declare(strict_types=1);

namespace Domains\Article\Repositories;

use Domains\Article\Entities\Keyword;
use Domains\Article\ValueObjects\Id;

interface Keywords
{
    public function all(): array;

    public function removeById(Id $id): void;

    public function add(Keyword $keyword): Keyword;
}
