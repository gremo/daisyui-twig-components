# daisyUI Twig Components

[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/gremo/daisyui-twig-components/.github/workflows/ci.yaml?label=CI&style=flat-square)](https://github.com/gremo/daisyui-twig-components/actions/workflows/ci.yaml)
[![GitHub last commit](https://img.shields.io/github/last-commit/gremo/daisyui-twig-components?style=flat-square)](https://github.com/gremo/daisyui-twig-components/commits/main)
[![GitHub issues](https://img.shields.io/github/issues/gremo/daisyui-twig-components?style=flat-square)](https://github.com/gremo/daisyui-twig-components/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr/gremo/daisyui-twig-components?style=flat-square)](https://github.com/gremo/daisyui-twig-components/pulls)
[![Packagist downloads](https://img.shields.io/packagist/dt/gremo/daisyui-twig-components?style=flat-square)](https://packagist.org/packages/gremo/daisyui-twig-components)

A collection of [daisyUI](https://daisyui.com) components as [Symfony UX Twig Components](https://symfony.com/bundles/ux-twig-component/current/index.html) to abstract away complexity and create consistent UIs. Works with **Symfony 6/7** and **daisyUI 5** (but works with Tailwind CSS 4 too).

> [!NOTE]
> Why? Some may argue that using components involves more code to write. In some cases, this is true, especially for very simple components. However, for complex HTML requiring precise ordering and relationships between components, I find the benefit of Twig components tangible.

- Abstract some daisyUI complexity
- Default component attributes for consistency
- Props validation
- Custom components that inherit from bundle components

Worried about the extra CSS added by components? Don’t be — the size is very small, thanks to DaisyUI 5’s small footprint!

## 🚀 Quick start

### Installation

```console
composer require gremo/daisyui-twig-components
```

<details>
  <summary>Not using Symfony Flex?</summary>
  <p dir="auto"></p>

```php
// config/bundles.php
return [
    // ...
    Gremo\DaisyUITwigComponents\GremoDaisyUITwigComponentsBundle::class => ['all' => true],
];
```
</details>

Add the components path as [registering source](https://tailwindcss.com/docs/detecting-classes-in-source-files#explicitly-registering-sources) in your `assets/styles/app.css`:

```css
@import "tailwindcss";
@source "../../vendor/gremo/daisyui-twig-components/templates/components/**/*.html.twig";
```

<details>
  <summary>Using Tailwind CSS 4?</summary>
  <p dir="auto"></p>

```js
// tailwind.config.{js,ts,mjs,cjs}
module.exports = {
    // ...
    content: [
        // ...
        'vendor/gremo/daisyui-twig-components/templates/components/**/*.html.twig',
    ],
}
```
</details>

### Configuration

> [!WARNING]
> Do not set the `class` attribute as default. It won't work most of the time because YAML files are usually not included in the Tailwind CSS content source.

```yaml
gremo_daisyui_components:
    # Default attributes help to apply common properties or attributes to a component.
    # Every component listed below will have these attributes by default.
    default_attributes:
        Button: { theme: primary }
        Progress: { theme: accent, max: 100 }

    # You can define custom components, i.e., components that inherit from
    # bundle components and share the same attributes.
    # Note that custom components do not inherit default attributes.
    custom_components:
        DeleteButton: { theme: error, size: sm, outline: true }
```

## 🧩 Components

Read the [documentation](./docs/README.md).

## ❤️ Contributing

All types of contributions are encouraged and valued. See the [contributing](.github/CONTRIBUTING.md) guidelines, the community looks forward to your contributions!

## 📘 License

Released under the terms of the [ISC License](LICENSE).
