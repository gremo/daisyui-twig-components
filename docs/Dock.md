# 🧩 Dock
[daisyUI docs](https://daisyui.com/components/dock/) •
[Source (PHP)](/src/Twig/Components/Dock.php) •
[Source (Twig)](/templates/components/Dock.html.twig)

Dock is a UI element that provides navigation options to the user.

## 🚀 Examples

```twig
<twig:Dock>
    <twig:DockItem label="Home" active>
        <twig:ux:icon name="material-symbols:home-outline-rounded" class="size-5" />
    </twig:DockItem>

    <twig:DockItem label="Inbox">
        <twig:ux:icon name="material-symbols:inbox-outline" class="size-5" />
    </twig:DockItem>

    <twig:DockItem label="Settings">
        <twig:ux:icon name="material-symbols:settings-outline" class="size-5" />
    </twig:DockItem>
</twig:Dock>
```

## ⚙️ `Dock` props

| Prop   | Description                                                 | Type           | Default |
|:-------|:------------------------------------------------------------|:---------------|:--------|
| `as`   | The HTML tag to use for rendering.                          | `string`       | `div`   |
| `size` | The size of the component (how large it will be displayed). | `null\|string` | `null`  |

## ⚙️ `DockItem` props

| Prop      | Description                                         | Type           | Default  |
|:----------|-----------------------------------------------------|:---------------|:---------|
| `as`      | The HTML tag to use for rendering.                  | `string`       | `button` |
| `active`  | Whether the item is active.                         | `bool`         | `false`  |
| `current` | The `aria-current` attribute value for active item. | `null\|string` | `true`   |
| `label`   | The item label.                                     | `null\|string` | `null`   |

The component supports the following nested attributes:

- `label:*`: for the label element

## 📖 Related

- [Menu](Menu.md)
- [Steps](Steps.md)
- [Tabs](Tabs.md)
