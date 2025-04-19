<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;
use Gremo\DaisyUITwigComponents\EventListener\TwigComponentValidationListener;
use Symfony\UX\TwigComponent\Event\PreMountEvent;

return static function (ContainerConfigurator $container): void {
    $container->services()

        ->set(TwigComponentDefaultsListener::class)
            ->args([
                abstract_arg('defaultPropsMap'),
            ])
            ->tag('kernel.event_listener', [
                'event' => PreMountEvent::class,
                'method' => 'onPreMount',
                'priority' => -16,
            ])

        ->set(TwigComponentValidationListener::class)
            ->tag('kernel.event_listener', [
                'event' => PreMountEvent::class,
                'method' => 'onPreMount',
                'priority' => -32,
            ])

    ;
};
