<?php

/*
 * This file is part of the daisyui-twig-components package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\DaisyUITwigComponents;

use Gremo\DaisyUITwigComponents\DependencyInjection\ComponentsPass;
use Gremo\DaisyUITwigComponents\DependencyInjection\CustomComponentsPass;
use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class GremoDaisyUITwigComponentsBundle extends AbstractBundle
{
    protected string $extensionAlias = 'daisyui_twig_components';

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition
            ->rootNode()
                ->children()
                    ->scalarNode('prefix')
                        ->defaultNull()
                        ->beforeNormalization()
                            ->ifTrue(fn(?string $v) => !empty($v))
                            ->then(fn(string $v) => trim($v, ':') . ':')
                        ->end()
                    ->end()
                    ->arrayNode('default_attributes')
                        ->useAttributeAsKey('name')
                        ->arrayPrototype()
                            ->scalarPrototype()->end()
                        ->end()
                    ->end()
                    ->arrayNode('custom_components')
                        ->useAttributeAsKey('name')
                        ->arrayPrototype()
                            ->scalarPrototype()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    // @phpstan-ignore missingType.iterableValue
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $builder->setParameter('.daisyui_twig_components.prefix', $config['prefix'] ?? '');
        $builder->setParameter('.daisyui_twig_components.custom_components', $config['custom_components']);

        $container->import('../config/services.php');
        $container->import('../config/twig_component.php');

        if ($config['default_attributes'] !== [] || $config['custom_components'] !== []) {
            $builder
                ->getDefinition(TwigComponentDefaultsListener::class)
                ->replaceArgument(0, array_combine(
                    array_map(fn(string $k) => "{$config['prefix']}$k", array_keys($config['default_attributes'])),
                    array_values($config['default_attributes'])
                ))
            ;
        } else {
            $builder->removeDefinition(TwigComponentDefaultsListener::class);
        }
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new ComponentsPass(), priority: 10);
        $container->addCompilerPass(new CustomComponentsPass(), priority: 8);
    }
}
