<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\DependencyInjection;

use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;
use Gremo\DaisyUITwigComponents\GremoDaisyUITwigComponentsBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class DaisyUITwigComponentsExtensionTest extends TestCase
{
    public function testLoadEmptyConfiguration(): void
    {
        $container = $this->createContainer();
        $container->registerExtension((new GremoDaisyUITwigComponentsBundle())->getContainerExtension());
        $container->loadFromExtension('daisyui_twig_components');
        $this->compileContainer($container);

        $this->assertFalse($container->hasDefinition(TwigComponentDefaultsListener::class));
    }

    /**
     * @testWith [null, ""]
     *           ["", ""]
     *           ["foo", "foo:"]
     *           ["foo:", "foo:"]
     */
    public function testLoadConfigurationWithPrefix(?string $prefix, string $expectedPrefix): void
    {
        $container = $this->createContainer();
        $container->registerExtension((new GremoDaisyUITwigComponentsBundle())->getContainerExtension());
        $container->loadFromExtension('daisyui_twig_components', [
            'prefix' => $prefix,
            'default_attributes' => [
                'Foo' => ['bar' => 'baz'],
                'Bar' => ['foo' => 'baz'],
            ],
        ]);
        $this->compileContainer($container);

        $this->assertSame($expectedPrefix, $container->getParameter('.daisyui_twig_components.prefix'));
        $this->assertSame(
            [
                "{$expectedPrefix}Foo" => ['bar' => 'baz'],
                "{$expectedPrefix}Bar" => ['foo' => 'baz'],
            ],
            $container->getDefinition(TwigComponentDefaultsListener::class)->getArgument(0)
        );
    }

    public function testLoadConfigurationWithDefaultAttributes(): void
    {
        $container = $this->createContainer();
        $container->registerExtension((new GremoDaisyUITwigComponentsBundle())->getContainerExtension());
        $container->loadFromExtension('daisyui_twig_components', [
            'default_attributes' => [
                'Foo' => ['bar' => 'baz'],
                'Bar' => ['baz' => 'foo'],
            ],
        ]);
        $this->compileContainer($container);

        $this->assertTrue($container->hasDefinition(TwigComponentDefaultsListener::class));
        $this->assertSame(
            [
                'Foo' => ['bar' => 'baz'],
                'Bar' => ['baz' => 'foo'],
            ],
            $container->getDefinition(TwigComponentDefaultsListener::class)->getArgument(0)
        );
    }

    public function testLoadConfigurationWithCustomComponents(): void
    {
        $container = $this->createContainer();
        $container->registerExtension((new GremoDaisyUITwigComponentsBundle())->getContainerExtension());
        $container->loadFromExtension('daisyui_twig_components', [
            'custom_components' => [
                'Foo' => ['bar' => 'baz'],
            ],
        ]);
        $this->compileContainer($container);

        $this->assertTrue($container->hasDefinition(TwigComponentDefaultsListener::class));
        $this->assertSame(
            ['Foo' => ['bar' => 'baz']],
            $container->getParameter('.daisyui_twig_components.custom_components')
        );
    }

    private function createContainer(): ContainerBuilder
    {
        return new ContainerBuilder(new ParameterBag([
            'kernel.debug' => false,
            'kernel.environment' => 'test',
            'kernel.build_dir' => __DIR__,
        ]));
    }

    private function compileContainer(ContainerBuilder $container): void
    {
        $container->getCompilerPassConfig()->setOptimizationPasses([]);
        $container->getCompilerPassConfig()->setRemovingPasses([]);
        $container->getCompilerPassConfig()->setAfterRemovingPasses([]);
        $container->compile();
    }
}
