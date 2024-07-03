<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class TabContentTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderingWithDefaults(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'TabContent',
            data: [
                'label' => 'foo',
                'tab' => 'my-tabs',
            ],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(2, $body->children());

        $input = $body->children()->first();
        $this->assertSame('input', $input->nodeName());
        $this->assertSame('radio', $input->attr('type'));
        $this->assertSame('my-tabs', $input->attr('name'));
        $this->assertSame('tab', $input->attr('class'));
        $this->assertSame('tab', $input->attr('role'));
        $this->assertSame('foo', $input->attr('aria-label'));

        $div = $input->nextAll()->first();
        $this->assertSame('div', $div->nodeName());
        $this->assertSame('tab-content', $div->attr('class'));
        $this->assertSame('tabpanel', $div->attr('role'));
    }

    public function testCanRenderContent(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'TabContent',
            data: [
                'label' => 'foo',
                'tab' => 'my-tabs',
            ],
            content: '<b>foo</b>',
        );

        $content = $rendered->crawler()->filter('.tab-content');
        $this->assertStringContainsString('<b>foo</b>', $content->html());
    }

    public function testCanRenderAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'TabContent',
            data: [
                'label' => 'foo',
                'tab' => 'my-tabs',
                'foo' => 'bar',
            ],
        );

        $content = $rendered->crawler()->filter('.tab-content');
        $this->assertSame('bar', $content->attr('foo'));
    }

    public function testCannotChangeFixedAttributes(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'TabContent',
            data: [
                'label' => 'foo',
                'tab' => 'my-tabs',
                'role' => 'baz',
            ],
        );

        $content = $rendered->crawler()->filter('.tab-content');
        $this->assertNotSame('baz', $content->attr('role'));
    }

    public function testLabelPropMissing(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessage('Variable "label" does not exist');

        $this->renderTwigComponent(
            name: 'TabContent',
            data: ['tab' => 'my-tabs'],
        );
    }

    public function testTabPropMissing(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessage('Variable "tab" does not exist');

        $this->renderTwigComponent(
            name: 'TabContent',
            data: [
                'label' => 'foo',
            ],
        );
    }

    /**
     * @testWith [null, null]
     *           [false, null]
     *           [true, "checked"]
     */
    public function testActiveProp(?bool $value, ?string $expectedCheckedValue): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'TabContent',
            data: [
                'label' => 'foo',
                'tab' => 'my-tabs',
                'active' => $value,
            ],
        );

        $input = $rendered->crawler()->filter('.tab');
        $this->assertSame($expectedCheckedValue, $input->attr('checked'));
    }
}
