<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DrawerContentTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            data: [],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertSame('drawer-content', $el->attr('class'));
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            data: [
                'id' => 'my-drawer-content',
                'class' => 'drawer-custom',
                'data-controller' => 'drawer',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('my-drawer-content', $el->attr('id'));
        $this->assertSame('drawer-content drawer-custom', $el->attr('class'));
        $this->assertSame('drawer', $el->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            data: ['as' => 'main'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('main', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'DrawerContent',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->html()));
    }
}
