<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\DependencyInjection;

use Gremo\DaisyUITwigComponents\DependencyInjection\ComponentsPass;
use Gremo\DaisyUITwigComponents\Tests\Fixtures\Component\Foo;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ComponentsPassTest extends TestCase
{
    /**
     * @testWith [null]
     *           [""]
     *           ["dui"]
     */
    public function testRegisterComponent(?string $prefix): void
    {
        $container = new ContainerBuilder();
        $container->setParameter('.daisyui_twig_components.prefix', $prefix);

        $definition = $container
            ->register(Foo::class)
            ->addTag(ComponentsPass::TAG_DAISYUI_COMPONENT)
        ;

        $pass = new ComponentsPass();
        $pass->process($container);

        $tags = $definition->getTag('twig.component');
        $this->assertNotEmpty($tags);
        $this->assertArrayHasKey('key', $tags[0]);
        $this->assertSame($prefix . 'Foo', $tags[0]['key']);
        $this->assertArrayHasKey('template', $tags[0]);
        $this->assertSame('@GremoDaisyUITwigComponents/components/Foo.html.twig', $tags[0]['template']);
        $this->assertArrayHasKey('expose_public_props', $tags[0]);
    }
}
