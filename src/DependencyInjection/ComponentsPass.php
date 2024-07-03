<?php

/*
 * This file is part of the daisyui-twig-components package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\DaisyUITwigComponents\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ComponentsPass implements CompilerPassInterface
{
    public const TAG_DAISYUI_COMPONENT = 'twig.daisyui_component';

    public function process(ContainerBuilder $container): void
    {
        $componentPrefix = $container->getParameter('.daisyui_twig_components.prefix');
        foreach (array_keys($container->findTaggedServiceIds(self::TAG_DAISYUI_COMPONENT)) as $id) {
            $reflection = new \ReflectionClass($id);
            $componentName = $reflection->getShortName();

            $container->getDefinition($id)
                ->clearTags()
                ->addTag('twig.component', [
                    'key' => "{$componentPrefix}{$componentName}",
                    'template' => "@GremoDaisyUITwigComponents/components/{$componentName}.html.twig",
                    'expose_public_props' => true,
                ])
            ;
        }
    }
}
