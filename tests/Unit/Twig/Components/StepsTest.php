<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Steps;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class StepsTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Steps',
            data: [],
        );

        $this->assertInstanceOf(Steps::class, $component);
        $this->assertSame('ul', $component->as);
        $this->assertNull($component->direction);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Steps',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('ul', $el->nodeName());
        $this->assertSame('steps', $el->attr('class'));
        $this->assertEmpty($el->innerText());
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Steps',
            data: [
                'id' => 'my-steps',
                'class' => 'steps-custom',
                'data-controller' => 'steps',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-steps', $el->attr('id'));
        $this->assertSame('steps steps-custom', $el->attr('class'));
        $this->assertSame('steps', $el->attr('data-controller'));
    }

    /**
     * @testWith ["horizontal", "steps-horizontal"]
     *           ["vertical", "steps-vertical"]
     */
    public function testDirectionProp(string $value, string $expectedCssClass): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Steps',
            data: ['direction' => $value],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame("steps $expectedCssClass", $el->attr('class'));
    }

    public function testInvalidDirectionPropThrows(): void
    {
        $this->expectException(\Twig\Error\RuntimeError::class);
        $this->expectExceptionMessageMatches('/option "direction" with value "foo" is invalid/i');

        $this->renderTwigComponent(
            name: 'Steps',
            data: ['direction' => 'foo'],
        );
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Steps',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->html()));
    }
}
