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

use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

class Drawer
{
    public string $id;

    public string $as = 'div';

    #[PreMount]
    public function preMount(array $data): array
    {
        if (!isset($data['id'])) {
            $data['id'] = 'drawer-'.mt_rand();
        }

        return $data;
    }

    #[ExposeInTemplate]
    public function getInputAttributes(): array
    {
        return [
            'id' => "$this->id-input",
        ];
    }

    #[ExposeInTemplate]
    public function getLabelAttributes(): array
    {
        return [
            'for' => "$this->id-input",
        ];
    }

    #[ExposeInTemplate]
    public function getToggleAttributes(): array
    {
        return [
            'as' => 'label',
            'for' => "$this->id-input",
        ];
    }
}
