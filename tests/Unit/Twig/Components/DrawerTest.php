<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\Components\Drawer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

class DrawerTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    public function testMount(): void
    {
        $component = $this->mountTwigComponent(
            name: 'Drawer',
            data: [],
        );

        $this->assertInstanceOf(Drawer::class, $component);
        $this->assertSame('div', $component->as);

        $inputAttrs = $component->getInputAttributes();
        $this->assertArrayHasKey('id', $inputAttrs);
        $this->assertStringMatchesFormat('drawer-%d-input', $inputAttrs['id']);

        $labelAttrs = $component->getLabelAttributes();
        $this->assertArrayHasKey('for', $labelAttrs);
        $this->assertStringMatchesFormat('drawer-%d-input', $labelAttrs['for']);

        $toggleAttrs = $component->getToggleAttributes();
        $this->assertArrayHasKey('as', $toggleAttrs);
        $this->assertSame('label', $toggleAttrs['as']);
        $this->assertArrayHasKey('for', $toggleAttrs);
        $this->assertStringMatchesFormat('drawer-%d-input', $toggleAttrs['for']);
    }

    public function testRenderWithoutData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            data: [],
        );

        $body = $rendered->crawler()->children('body');

        $this->assertCount(1, $body->children());

        $el = $body->children()->first();
        $this->assertSame('div', $el->nodeName());
        $this->assertStringMatchesFormat('drawer-%d', $el->attr('id'));
        $this->assertSame('drawer', $el->attr('class'));

        $this->assertCount(1, $el->children());

        $input = $el->children()->first();
        $this->assertStringMatchesFormat('drawer-%d-input', $input->attr('id'));
        $this->assertSame('drawer-toggle', $input->attr('class'));
        $this->assertSame('checkbox', $input->attr('type'));
    }

    public function testRenderWithData(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            data: [
                'id' => 'my-drawer',
                'class' => 'drawer-custom',
                'data-controller' => 'drawer',
                'input:id' => 'my-input',
                'input:class' => 'input-custom',
                'input:type' => 'text',
                'input:data-controller' => 'input',
            ],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');
        $this->assertSame('my-drawer', $el->attr('id'));
        $this->assertSame('drawer drawer-custom', $el->attr('class'));
        $this->assertSame('drawer', $el->attr('data-controller'));

        $input = $el->children()->first();
        $this->assertStringMatchesFormat('my-drawer-input', $input->attr('id'));
        $this->assertSame('drawer-toggle', $input->attr('class'));
        $this->assertSame('checkbox', $input->attr('type'));
        $this->assertSame('input', $input->attr('data-controller'));
    }

    public function testAsProp(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            data: ['as' => 'section'],
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('section', $el->nodeName());
    }

    public function testContentSlot(): void
    {
        $rendered = $this->renderTwigComponent(
            name: 'Drawer',
            content: '<b>foo</b>',
        );

        $el = $rendered->crawler()->filter('body > *:first-child');

        $this->assertSame('<b>foo</b>', trim($el->children()->last()->outerHtml()));
    }
}
