<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Osteel\OpenApi\Testing\ValidatorBuilder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function asserApiSpec(TestResponse $response, string $method, string $path): void
    {
        $validator = ValidatorBuilder::fromYaml(storage_path('openapi.yml'))->getValidator();

        $result = $validator->validate($response->baseResponse, $path, $method);

        self::assertTrue($result);
    }
}
