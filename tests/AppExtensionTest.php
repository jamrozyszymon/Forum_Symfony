<?php

namespace App\Tests;

use App\Twig\AppExtension;
use PHPUnit\Framework\TestCase;

class AppExtensionTest extends TestCase
{

    /**
     * @dataProvider getSlug
     */
    public function testSlug(string $test, string $slug): void
    {
        $slugNew = new AppExtension;
        $this->assertSame($slug, $slugNew->slug($test));
    }

    public function getSlug()
    {
        return [
            ['Test Text', 'test-text'],
            ['Test Text+', 'test-text'],
            ['Test Text!', 'test-text'],
            ['Test T/ext', 'test-text'],
        ];
    }
}