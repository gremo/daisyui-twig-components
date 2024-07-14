# 🧩 RadialProgress
[Source (PHP)](/src/Twig/Components/RadialProgress.php) • [Source (Twig)](/templates/components/RadialProgress.html.twig) • [daisyUI docs](https://daisyui.com/components/radial-progress/)

Radial progress can be used to show the progress of a task or to show the passing of time.

## 🚀 Example

```twig
<twig:RadialProgress value="75" />
```

With a custom content, size and thickness:

```twig
<twig:RadialProgress value="80.5" content="80%" size="10rem" thickness="0.25rem" />
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| <b>`value`</b> | The value to show. | `float` | Yes | `null` |
| `size` | The size of the component (CSS unit). | `null\|string` |  | `null` |
| `thickness` | The thickness of the component (CSS unit). | `null\|string` |  | `null` |
| `content` | The content (used when the block is not present). | `null\|string` |  | `null` |

## 📖 Related

- [Loading](Loading.md)
- [Progress](Progress.md)
