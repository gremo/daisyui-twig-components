<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DrawerSideTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: [],
        );

        $body = $rendered->crawler()->children('body');
        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('drawer-side', $el->attr('class'));

        $this->assertCount(1, $el->children());

        $overlay = $el->children()->first();
        $this->assertSame('label', $overlay->nodeName());
        $this->assertSame('drawer-overlay', $overlay->attr('class'));
        $this->assertNull($overlay->attr('for'));
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: [
                'id' => 'my-drawer-side',
                'class' => 'drawer-side-class',
                'data-controller' => 'drawer-controller',

                'overlay:class' => 'overlay-class',
                'overlay:for' => 'should-be-ignored',
                'overlay:data-controller' => 'overlay-controller',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-drawer-side', $el->attr('id'));
        $this->assertSame('drawer-side drawer-side-class', $el->attr('class'));
        $this->assertSame('drawer-controller', $el->attr('data-controller'));

        $overlay = $el->children()->first();
        $this->assertSame('label', $overlay->nodeName());
        $this->assertSame('drawer-overlay overlay-class', $overlay->attr('class'));
        $this->assertNull($overlay->attr('for'));
        $this->assertSame('overlay-controller', $overlay->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            data: ['as' => 'aside'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('aside', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerSide',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->children()->last()->outerHtml()));
    }
}
