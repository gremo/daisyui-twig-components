<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class CollapseContentTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseContent',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('collapse-content', $el->attr('class'));
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseContent',
            data: [
                'id' => 'my-collapse-content',
                'class' => 'collapse-content-class',
                'data-controller' => 'collapse-content',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-collapse-content', $el->attr('id'));
        $this->assertSame('collapse-content collapse-content-class', $el->attr('class'));
        $this->assertSame('collapse-content', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseContent',
            data: ['as' => 'p'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('p', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'CollapseContent',
            content: '<b>foo</b>'
        );

        $this->assertSame('<b>foo</b>', trim($rendered->crawler()->filter('body > *:first-child')->html()));
    }
}
