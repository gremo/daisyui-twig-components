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

use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

class CustomComponentsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition(TwigComponentDefaultsListener::class)) {
            return;
        }

        $nsPrefix = implode('\\', \array_slice(explode('\\', __NAMESPACE__), 0, 2)).'\\';
        $parentsMap = [];
        foreach ($container->findTaggedServiceIds('twig.component') as $id => $tags) {
            if (str_starts_with($class = $container->findDefinition($id)->getClass(), $nsPrefix)) {
                $parentsMap[substr($class, strrpos($class, '\\') + 1)] = $tags[0];
            }
        }

        $listener = $container->getDefinition(TwigComponentDefaultsListener::class);
        foreach ($container->getParameter('.daisyui_twig_components.custom_components') as $key => $attributes) {
            $parent = array_filter($parentsMap, fn ($_, $parent) => str_ends_with($key, $parent), \ARRAY_FILTER_USE_BOTH);

            if ([] === $parent) {
                throw new RuntimeException(\sprintf('Unable to infer the parent for custom component "%s". Ensure the name ends with one of: %s.', $key, implode(', ', array_keys($parentsMap))));
            }

            $parentKey = key($parent);
            if ($parentKey === $key) {
                throw new RuntimeException(\sprintf('Custom component "%s" has the same name as its parent, which would result in overriding it.', $key));
            }

            $container
                ->register('daisyui_twig_components.custom_component.'.Container::underscore($key))
                ->setClass('Gremo\DaisyUITwigComponents\Twig\Components\\'.key($parent))
                ->addTag('twig.component', [...current($parent), 'key' => $key])
            ;

            $listener->replaceArgument(0, [...$listener->getArgument(0), $key => $attributes]);
        }
    }
}
