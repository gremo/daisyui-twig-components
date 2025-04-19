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

use Gremo\DaisyUITwigComponents\Twig\ValidableComponentInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Event\PreMountEvent;

class TwigComponentValidationListener
{
    public function onPreMount(PreMountEvent $event): void
    {
        $component = $event->getComponent();
        if (!$component instanceof ValidableComponentInterface) {
            return;
        }

        $metadata = $event->getMetadata();
        $reflection = new \ReflectionClass($component);

        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);
        if ($metadata->isPublicPropsExposed()) {
            foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
                /** @var \ReflectionProperty $property */
                if ($property->hasDefaultValue()) {
                    $resolver->setDefined($property->getName());
                }
            }
        }

        $component->configureProps($resolver);
        $event->setData($resolver->resolve($event->getData()) + $event->getData());
    }
}
