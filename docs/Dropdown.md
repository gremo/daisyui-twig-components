# 🧩 Dropdown
[Source (PHP)](/src/Twig/Components/Dropdown.php) • [Source (Twig)](/templates/components/Dropdown.html.twig) • [daisyUI docs](https://daisyui.com/components/dropdown/)

Dropdown can open a menu or any other element when the button is clicked.

## 🚀 Example

```twig
<twig:Dropdown>
    <twig:Button {{ ...this.triggerAttributes }}>
        Click to open
    </twig:Button>

    <twig:DropdownContent
        as="ul"
        class="menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow" {{ ...contentAttributes }}
    >
        <li><a>Item 1</a></li>
        <li><a>Item 2</a></li>
    </twig:DropdownContent>
</twig:Dropdown>
```

In order to work properly:

- Requires the trigger to be a component with `as` prop bound using `triggerAttributes`
- Requires the content to be a component with `as` prop bound using `contentAttributes`

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `trigger` | Sets the trigger mode (&quot;click&quot;, &quot;focus&quot; or &quot;hover&quot;) | `string` |  | `focus` |
| `placement` | The placement (&quot;top&quot;, &quot;right&quot;, etc.) | `null\|string` |  | `null` |
| `align` | The alignment (&quot;start&quot;, &quot;end&quot;, etc.) | `null\|string` |  | `null` |

## 📖 Related

- [Button](Button.md)
- [DropdownContent](DropdownContent.md)
