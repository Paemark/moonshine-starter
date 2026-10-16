<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_slug_generation_converts_text_to_url_friendly_format(): void
    {
        self::assertSame(
            'hello-world',
            Str::slug('Hello World')
        );
    }
}
