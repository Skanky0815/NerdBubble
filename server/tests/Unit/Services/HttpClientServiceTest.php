<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\HttpClientService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class HttpClientServiceTest extends TestCase
{
    #[Test]
    public function loadContentFromWebsite_when_response_is_xml_dom_then_a_DOMDocument_will_be_returned(): void
    {
        Http::fake(['https://some.html' => Http::response(<<<'HTML'
                <html />
                <body>
                    <h1>Some HTML</h1>
                </body>
            HTML)]);

        $result = $this->service()->loadContentFromWebsite('https://some.html');

        static::assertInstanceOf(\DOMDocument::class, $result);
    }

    #[Test]
    public function loadContentFromWebsite_when_response_is_json_dom_then_a_array_will_be_returned(): void
    {
        Http::fake(['https://some.json' => Http::response(<<<'JSON'
            {
              "body": "SOME JSON"
            }
            JSON)]);

        $result = $this->service()->loadContentFromWebsite('https://some.json');

        static::assertIsArray($result);
    }

    private function service(): HttpClientService
    {
        return new HttpClientService();
    }
}
