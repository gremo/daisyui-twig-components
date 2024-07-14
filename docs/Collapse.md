# 🧩 Collapse
[Source (PHP)](/src/Twig/Components/Collapse.php) • [Source (Twig)](/templates/components/Collapse.html.twig) • [daisyUI docs](https://daisyui.com/components/collapse/)

Collapse is used for showing and hiding content.

## 🚀 Example

Short usage form:

```twig
<twig:Collapse title="Focus me to see content" autoClose>
   Collapse content here!
</twig:Collapse>
```
Usage with blocks:

```twig
<twig:Collapse>
    <twig:block name="title">
       <b>Click</b> me to show/hide content
    </twig:block>

    Collapse content here!
</twig:Collapse>
```

- Supports nested attributes for title and content.

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `title` | The title of the collapse (used when the block is not present). | `null\|string` |  | `null` |
| `icon` | The icon type to use (&quot;arrow&quot; or &quot;plus&quot;). | `null\|string` |  | `null` |
| `autoClose` | Whether the collapse will close when it loses focus. | `bool` |  | `false` |
