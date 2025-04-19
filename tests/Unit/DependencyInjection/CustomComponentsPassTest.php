<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\DependencyInjection;

use Gremo\DaisyUITwigComponents\DependencyInjection\CustomComponentsPass;
use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;
use Gremo\DaisyUITwigComponents\Tests\Fixtures\Component\Foo;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

class CustomComponentsPassTest extends TestCase
{
    public function testThrowWhenComponentDoesNotHaveParent(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('/unable to infer the parent for custom component/i');

        $container = new ContainerBuilder();
        $container
            ->register(TwigComponentDefaultsListener::class)
            ->setArgument(0, [])
        ;
        $container->setParameter('.daisyui_twig_components.custom_components', [
            'Foo' => ['foo' => 'bar'],
        ]);

        $pass = new CustomComponentsPass();
        $pass->process($container);
    }

    public function testThrowWhenComponentOverrideParent(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('/has the same name as its parent/i');

        $container = new ContainerBuilder();
        $container
            ->register(TwigComponentDefaultsListener::class)
            ->setArgument(0, [])
        ;
        $container->register(Foo::class, Foo::class)
            ->addTag('twig.component', [
                'key' => 'Foo',
            ])
        ;
        $container->setParameter('.daisyui_twig_components.custom_components', [
            'Foo' => ['foo' => 'bar'],
        ]);

        $pass = new CustomComponentsPass();
        $pass->process($container);
    }

    public function testRegisterCustomComponent(): void
    {
        $container = new ContainerBuilder();
        $container
            ->register(TwigComponentDefaultsListener::class)
            ->setArgument(0, [])
        ;
        $container->register('foo', 'Gremo\DaisyUITwigComponents\Twig\Components\Foo')
            ->addTag('twig.component', [
                'key' => 'Foo',
                'template' => 'foo.html.twig',
                'expose_public_props' => true,
            ])
        ;
        $container->setParameter('.daisyui_twig_components.custom_components', [
            'CustomFoo' => ['foo' => 'bar'],
        ]);

        $pass = new CustomComponentsPass();
        $pass->process($container);

        $definitionId = 'daisyui_twig_components.custom_component.custom_foo';
        $this->assertTrue($container->hasDefinition($definitionId));

        $definition = $container->getDefinition($definitionId);
        $this->assertSame('Gremo\DaisyUITwigComponents\Twig\Components\Foo', $definition->getClass());

        $tags = $definition->getTag('twig.component');
        $this->assertSame(
            [
                'key' => 'CustomFoo',
                'template' => 'foo.html.twig',
                'expose_public_props' => true,
            ],
            $tags[0]
        );

        $this->assertSame(
            ['CustomFoo' => ['foo' => 'bar']],
            $container->getDefinition(TwigComponentDefaultsListener::class)->getArgument(0)
        );
    }
}
