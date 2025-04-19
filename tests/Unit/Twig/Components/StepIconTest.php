<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class StepIconTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'StepIcon',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('span', $el->nodeName());
        $this->assertSame('step-icon', $el->attr('class'));
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'StepIcon',
            data: [
                'id' => 'my-stepicon',
                'class' => 'stepicon-class',
                'data-controller' => 'stepicon',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-stepicon', $el->attr('id'));
        $this->assertSame('step-icon stepicon-class', $el->attr('class'));
        $this->assertSame('stepicon', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'StepIcon',
            data: ['as' => 'i'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('i', $el->nodeName());
    }

    /**
     * @testWith ["foo", null, "foo"]
     *           [null, "<b>bar</b>", "<b>bar</b>"]
     *           ["foo", "<b>bar</b>", "<b>bar</b>"]
     */
    public function testContentPropOrSlot(?string $propContent, ?string $slotContent, string $expectedContent): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'StepIcon',
            data: null !== $propContent ? ['content' => $propContent] : [],
            content: $slotContent
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame($expectedContent, trim($el->html()));
    }
}
