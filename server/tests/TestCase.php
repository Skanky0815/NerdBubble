<?php declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Osteel\OpenApi\Testing\ValidatorBuilder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function asserApiSpec(TestResponse $response, string $path) : void
    {
        $validator = ValidatorBuilder::fromYaml(storage_path('openapi.yml'))->getValidator();

        $result = $validator->get($response->baseResponse, $path);

        self::assertTrue($result);
    }
}
