# 🧩 Progress
[daisyUI docs](https://daisyui.com/components/progress/) •
[Source (PHP)](/src/Twig/Components/Progress.php) •
[Source (Twig)](/templates/components/Progress.html.twig)

Progress bar can be used to show the progress of a task or to show the passing of time.

## 🚀 Examples

Progress with a value:

```twig
<twig:Progress value="75" max="100" />
```

Indeterminate (without value):

```twig
<twig:Progress color="primary" />
```

## ⚙️ Props

| Prop    | Description                                  | Type           | Default |
|:--------|:---------------------------------------------|:---------------|:--------|
| `color` | The component color ("info", "error", etc.). | `null\|string` | `null`  |

## 📖 Related

- [Alert](Alert.md)
- [Loading](Loading.md)
- [RadialProgress](RadialProgress.md)
- [Toast](Toast.md)
- [Tooltip](Tooltip.md)
