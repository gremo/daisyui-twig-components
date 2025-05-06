<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Gremo\DaisyUITwigComponents\Twig\Components\Accordion;
use Gremo\DaisyUITwigComponents\Twig\Components\Alert;
use Gremo\DaisyUITwigComponents\Twig\Components\Badge;
use Gremo\DaisyUITwigComponents\Twig\Components\Button;
use Gremo\DaisyUITwigComponents\Twig\Components\Collapse;
use Gremo\DaisyUITwigComponents\Twig\Components\Dock;
use Gremo\DaisyUITwigComponents\Twig\Components\Drawer;
use Gremo\DaisyUITwigComponents\Twig\Components\Dropdown;
use Gremo\DaisyUITwigComponents\Twig\Components\Kbd;
use Gremo\DaisyUITwigComponents\Twig\Components\Loading;
use Gremo\DaisyUITwigComponents\Twig\Components\Menu;
use Gremo\DaisyUITwigComponents\Twig\Components\Progress;
use Gremo\DaisyUITwigComponents\Twig\Components\Status;
use Gremo\DaisyUITwigComponents\Twig\Components\Step;
use Gremo\DaisyUITwigComponents\Twig\Components\Steps;
use Gremo\DaisyUITwigComponents\Twig\Components\Tabs;
use Gremo\DaisyUITwigComponents\Twig\Components\Toast;

return static function (ContainerConfigurator $container): void {
    $container->services()

        ->set('.daisyui_twig_components.accordion', Accordion::class)
            ->tag('twig.component', [
                'key' => 'Accordion',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.alert', Alert::class)
            ->tag('twig.component', [
                'key' => 'Alert',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.badge', Badge::class)
            ->tag('twig.component', [
                'key' => 'Badge',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.button', Button::class)
            ->tag('twig.component', [
                'key' => 'Button',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.collapse', Collapse::class)
            ->tag('twig.component', [
                'key' => 'Collapse',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.dock', Dock::class)
            ->tag('twig.component', [
                'key' => 'Dock',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.drawer', Drawer::class)
            ->tag('twig.component', [
                'key' => 'Drawer',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.dropdown', Dropdown::class)
            ->tag('twig.component', [
                'key' => 'Dropdown',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.kbd', Kbd::class)
            ->tag('twig.component', [
                'key' => 'Kbd',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.loading', Loading::class)
            ->tag('twig.component', [
                'key' => 'Loading',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.menu', Menu::class)
            ->tag('twig.component', [
                'key' => 'Menu',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.progress', Progress::class)
            ->tag('twig.component', [
                'key' => 'Progress',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.status', Status::class)
            ->tag('twig.component', [
                'key' => 'Status',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.step', Step::class)
            ->tag('twig.component', [
                'key' => 'Step',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.steps', Steps::class)
            ->tag('twig.component', [
                'key' => 'Steps',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.tabs', Tabs::class)
            ->tag('twig.component', [
                'key' => 'Tabs',
                'expose_public_props' => true,
            ])

        ->set('.daisyui_twig_components.toast', Toast::class)
            ->tag('twig.component', [
                'key' => 'Toast',
                'expose_public_props' => true,
            ])
    ;
};
