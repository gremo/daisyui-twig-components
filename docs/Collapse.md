# 🧩 Collapse
[daisyUI docs](https://daisyui.com/components/collapse/) •
[Source (PHP)](/src/Twig/Components/Collapse.php) •
[Source (Twig)](/templates/components/Collapse.html.twig)

Collapse is used for showing and hiding content.

## 🚀 Examples

```twig
<twig:Collapse icon="arrow">
    <twig:CollapseTitle>
        How do I create an account?
    </twig:CollapseTitle>

    <twig:CollapseContent class="text-sm">
        Click the "Sign Up" button in the top right corner and follow the registration process.
    </twig:CollapseContent>
</twig:Collapse>
```

## ⚙️ `Collapse` props

| Prop     | Description                                               | Type          | Default |
|:---------|:----------------------------------------------------------|:--------------|:--------|
| `as`     | The HTML tag to use for rendering.                        | `string`      | `div`   |
| `icon`   | The icon type to use ("arrow" or "plus").                 | `null\|string`| `null`  |
| `open`   | Whether the collapse starts opened.                       | `bool`        | `false` |
| `trigger`| The trigger that opens the collapse ("focus" or "click"). | `string`      | `focus` |

The component supports the following nested attributes:

- `title:*`: for the title element

## ⚙️ `CollapseTitle` props

| Prop     | Description                                               | Type          | Default |
|:---------|:----------------------------------------------------------|:--------------|:--------|
| `as`     | The HTML tag to use for rendering.                        | `string`      | `div`   |

## ⚙️ `CollapseContent` props

| Prop     | Description                                               | Type          | Default |
|:---------|:----------------------------------------------------------|:--------------|:--------|
| `as`     | The HTML tag to use for rendering.                        | `string`      | `div`   |
