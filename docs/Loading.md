# 🧩 Loading
[daisyUI docs](https://daisyui.com/components/loading/) •
[Source (PHP)](/src/Twig/Components/Loading.php) •
[Source (Twig)](/templates/components/Loading.html.twig)

Loading shows an animation to indicate that something is loading.

## 🚀 Examples

```twig
<twig:Loading variant="spinner" size="lg" />
```

## ⚙️ Props

| Prop      | Description                                                 | Type           | Default |
|:----------|:------------------------------------------------------------|:---------------|:--------|
| `as`      | The HTML tag to use for rendering.                          | `string`       | `span`  |
| `size`    | The size of the component (how large it will be displayed). | `null\|string` | `null`  |
| `variant` | The component style ("spinner", "dots", etc.).              | `null\|string` | `null`  |

## 📖 Related

- [Alert](Alert.md)
- [Progress](Progress.md)
- [RadialProgress](RadialProgress.md)
- [Toast](Toast.md)
- [Tooltip](Tooltip.md)
