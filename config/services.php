<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set(TwigComponentDefaultsListener::class)
            ->args([
                abstract_arg('defaultPropsMap'),
            ])
            ->tag('kernel.event_listener', [
                'event' => 'Symfony\UX\TwigComponent\Event\PreMountEvent',
                'method' => 'onPreMount',
            ])
    ;
};
