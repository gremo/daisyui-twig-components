<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class TabTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutLabel(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/label should be defined for component /i');

        $this->renderTwigComponent(
            name: 'Tab',
            data: [],
        );
    }

    public function testRenderWithoutMinimalData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Tab',
            data: ['label' => 'foo'],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(2, $body->children());

        $input = $body->children()->first();
        $this->assertSame('input', $input->nodeName());
        $this->assertSame('radio', $input->attr('type'));
        $this->assertNull($input->attr('name'));
        $this->assertSame('tab', $input->attr('class'));
        $this->assertSame('foo', $input->attr('aria-label'));
        $this->assertNull($input->attr('checked'));
    }
}
