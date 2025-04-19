# 🧩 Dropdown
[daisyUI docs](https://daisyui.com/components/dropdown/) •
[Source (PHP)](/src/Twig/Components/Dropdown.php) •
[Source (Twig)](/templates/components/Dropdown.html.twig)

## 🚀 Examples

For convenience, `DropdownToggle` (inherits [`Button`](Button.md)) and `DropdownMenu` (inherits from [`Menu`](Menu.md)) components are provided:

```twig
<twig:Dropdown>
    <twig:DropdownToggle>
        Open
    </twig:DropdownToggle>
    <twig:DropdownMenu class="bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
        <!-- Menu content -->
    </twig:DropdownMenu>
</twig:Dropdown>
```

For further customization, you can use any component as a toggle, as long as it supports the `as` prop, by binding it with `toggleAttributes`, and any component as content, by binding it with `contentAttributes`:

```twig
<twig:Dropdown>
    <twig:Button {{ ...toggleAttributes }}>
        Button
    </twig:Button>
    <twig:Card class="bg-base-100 z-1 w-64 shadow-md" size="sm" {{ ...contentAttributes }}>
        <!-- Card content -->
    </twig:Card>
</twig:Dropdown>
```

## ⚙️ Props

| Dropdown    | Description                                                       | Type           | Default  |
|:------------|:------------------------------------------------------------------|:---------------|:---------|
| `as`        | The HTML tag to use for rendering.                                | `null\|string` | `div`    |
| `align`     | The component alignment ("center", "end", "start")                | `string`       | `null`   |
| `open`      | Whether the component starts opened.                              | `bool`         | `false`  |
| `placement` | The component position ("top", "bottom").                         | `null\|string` | `null`   |
| `trigger`   | The trigger that opens the component ("click", "focus", "hover"). | `string`       | `focus`  |

## 📖 Related

- [Button](Button.md)
- [Menu](Menu.md)
