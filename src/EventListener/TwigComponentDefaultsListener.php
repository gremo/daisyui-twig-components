<?php

/*
 * This file is part of the daisyui-twig-components package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\DaisyUITwigComponents\EventListener;

use Symfony\UX\TwigComponent\Event\PreMountEvent;

class TwigComponentDefaultsListener
{
    // @phpstan-ignore missingType.iterableValue
    public function __construct(private array $defaultPropsMap = [])
    {
    }

    public function onPreMount(PreMountEvent $event): void
    {
        if (
            !str_starts_with(
                get_class($event->getComponent()),
                implode('\\', array_slice(explode('\\', __NAMESPACE__), 0, 2)),
            )
        ) {
            return;
        }

        $event->setData([
            ...($this->defaultPropsMap[$event->getMetadata()->getName()] ?? []),
            ...$event->getData()
        ]);
    }
}
