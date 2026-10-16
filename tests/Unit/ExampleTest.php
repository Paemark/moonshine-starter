<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    #[Test]
    public function slug_generation_converts_text_to_url_friendly_format(): void
    {
        $slug = Str::slug('Hello World');

        $this->assertSame('hello-world', $slug);
    }
}