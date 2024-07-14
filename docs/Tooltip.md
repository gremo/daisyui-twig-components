# 🧩 Tooltip
[Source (PHP)](/src/Twig/Components/Tooltip.php) • [Source (Twig)](/templates/components/Tooltip.html.twig) • [daisyUI docs](https://daisyui.com/components/tooltip/)

Tooltip can be used to show a message when hovering over an element.

## 🚀 Example

```twig
<twig:Tooltip theme="primary" placement="right" tip="hello">
    <twig:Button>
        Hover me
    </twig:Button>
</twig:Tooltip>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| <b>`tip`</b> | The text to show. | `string` | Yes | `null` |
| `theme` | The daisyUI theme to use. | `null\|string` |  | `null` |
| `placement` | The position (&quot;top&quot;, &quot;bottom&quot;, etc.). | `null\|string` |  | `null` |
