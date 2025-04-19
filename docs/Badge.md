# 🧩 Badge
[daisyUI docs](https://daisyui.com/components/badge/) •
[Source (PHP)](/src/Twig/Components/Badge.php) •
[Source (Twig)](/templates/components/Badge.html.twig)

Badges are used to inform the user of the status of specific data.

## 🚀 Examples

```twig
<twig:Badge color="secondary" variant="outline">
    Secondary
</twig:Badge>
```

Alternative syntax (simple content as prop):

```twig
<twig:Badge content="Badge" />
```

## ⚙️ Props

| Prop      | Description                                       | Type           | Default |
|:----------|:--------------------------------------------------|:---------------|:--------|
| `as`      | The HTML tag to use for rendering.                | `string`       | `span`  |
| `content` | The content (used when the block is not present). | `null\|string` | `null`  |
| `color`   | The component color ("info", "error", etc.).      | `null\|string` | `null`  |
| `size`    | The component size ("sm", "md", etc.).            | `null\|string` | `null`  |
| `variant` | The component style ("dash", "outline", etc.).    | `null\|string` | `null`  |
