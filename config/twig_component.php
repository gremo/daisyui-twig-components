<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Gremo\DaisyUITwigComponents\DependencyInjection\ComponentsPass;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autoconfigure()
        ->autowire();

    $services->load('Gremo\\DaisyUITwigComponents\\Twig\\Components\\', __DIR__ . '/../src/Twig/Components')
        ->tag(ComponentsPass::TAG_DAISYUI_COMPONENT);
};
