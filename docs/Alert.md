# 🧩 Alert
[daisyUI docs](https://daisyui.com/components/alert/) •
[Source (PHP)](/src/Twig/Components/Alert.php) •
[Source (Twig)](/templates/components/Alert.html.twig)

Alert informs users about important events.

## 🚀 Examples

```twig
<twig:Alert color="info" variant="soft">
    <span>New software update available.</span>
</twig:Alert>
```

Alternative syntax (simple content as prop):

```twig
<twig:Alert color="error" variant="dash" content="An error occurred." />
```

## ⚙️ Props

| Prop        | Description                                       | Type           | Default |
|:------------|:--------------------------------------------------|:---------------|:--------|
| `as`        | The HTML tag to use for rendering.                | `string`       | `div`   |
| `content`   | The content (used when the block is not present). | `null\|string` | `null`  |
| `color`     | The component color ("info", "error", etc.).      | `null\|string` | `null`  |
| `direction` | The component layout ("vertical", "horizontal").  | `null\|string` | `null`  |
| `variant`   | The component style ("dash", "ghost", etc.).      | `null\|string` | `null`  |

## 📖 Related

- [Loading](Loading.md)
- [Progress](Progress.md)
- [RadialProgress](RadialProgress.md)
- [Toast](Toast.md)
- [Tooltip](Tooltip.md)
