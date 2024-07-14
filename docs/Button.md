# 🧩 Button
[Source (PHP)](/src/Twig/Components/Button.php) • [Source (Twig)](/templates/components/Button.html.twig) • [daisyUI docs](https://daisyui.com/components/button/)

Buttons allow the user to take actions or make choices.

## 🚀 Example

```twig
<twig:Button theme="success" content="Click me" outline />
```

```twig
<twig:Button theme="grass" size="sm">
    Glass button
</twig:Button>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `button` |
| `theme` | The daisyUI theme. | `null\|string` |  | `null` |
| `content` | The content (used when the block is not present). | `null\|string` |  | `null` |
| `size` | The size of the component (how large it will be displayed). | `null\|string` |  | `null` |
| `shape` | The shape of the component (&quot;circle&quot;, &quot;square&quot;, etc.). | `null\|string` |  | `null` |
| `active` | Whether is shown with active state. | `null\|bool` |  | `false` |
| `block` | Whether is shown full width button. | `null\|bool` |  | `false` |
| `noAnimation` | Whether to disable the click animation. | `null\|bool` |  | `false` |
| `outline` | Whether is shown outlined (transparent with border). | `null\|bool` |  | `false` |
| `wide` | Whether is shown wider (more horizontal padding). | `null\|bool` |  | `false` |
