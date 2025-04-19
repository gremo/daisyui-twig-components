# 🧩 RadialProgress
[daisyUI docs](https://daisyui.com/components/radial-progress/) •
[Source (PHP)](/src/Twig/Components/RadialProgress.php) •
[Source (Twig)](/templates/components/RadialProgress.html.twig)

Radial progress can be used to show the progress of a task or to show the passing of time.

## 🚀 Examples

```twig
<twig:RadialProgress value="75" />
```

Customizations:

```twig
<twig:RadialProgress value="80" size="12rem" thickness="2px" content="80%" />
```

## ⚙️ Props

| Prop        | Description                                          | Type           | Default |
|:------------|:-----------------------------------------------------|:---------------|---------|
| `as`        | The HTML tag to use for rendering.                   | `string`       | `div`   |
| `content`   | The content (used when the block is not present).    | `null\|string` | `null`  |
| `size`      | The size of the component as CSS unit.               | `string`       | `null`  |
| `thickness` | The thickness of the component as CSS unit.          | `string`       | `null`  |
| `value`     | The value to show (used also as content by default). | `string`       |         |

## 📖 Related

- [Alert](Alert.md)
- [Loading](Loading.md)
- [Progress](Progress.md)
- [Toast](Toast.md)
- [Tooltip](Tooltip.md)
