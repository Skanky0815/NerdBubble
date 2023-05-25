<?php declare(strict_types=1);

namespace Domains\Article\Exceptions;

use RuntimeException;

class ValueObjectValidateException extends RuntimeException implements ArticleException
{

}
