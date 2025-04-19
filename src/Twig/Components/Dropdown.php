<?php

/*
 * This file is part of the daisyui-twig-components package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\DaisyUITwigComponents\Twig\Components;

use Gremo\DaisyUITwigComponents\Twig\ValidableComponentInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\ComponentAttributes;

class Dropdown implements ValidableComponentInterface
{
    public string $as;

    public ?string $align = null;

    public ?string $placement = null;

    /**
     * @var "focus"|"click"|"hover"
     */
    public string $trigger = 'focus';

    public bool $open = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        return [
            ...$data,
            'as' => match ($data['trigger'] ?? $this->trigger) {
                'click' => 'details',
                'focus', 'hover' => 'div',
            },
        ];
    }

    public function configureProps(OptionsResolver $resolver): void
    {
        $resolver
            ->setAllowedValues('align', ['center', 'end', 'start'])
            ->setAllowedValues('placement', ['bottom', 'left', 'right', 'top'])
            ->setAllowedValues('trigger', ['click', 'focus', 'hover'])
        ;
    }

    #[ExposeInTemplate]
    public function getToggleAttributes(): ComponentAttributes
    {
        return new ComponentAttributes(match ($this->trigger) {
            'click' => [
                'as' => 'summary',
            ],
            'focus', 'hover' => [
                'as' => 'div',
                'role' => 'button',
                'tabindex' => 0,
            ],
        });
    }

    #[ExposeInTemplate]
    public function getContentAttributes(): ComponentAttributes
    {
        return new ComponentAttributes([
            'class' => 'dropdown-content',
            ...match ($this->trigger) {
                'focus', 'hover' => [
                    'tabindex' => 0,
                ],
                'click' => [],
            },
        ]);
    }
}
