# 🧩 Progress
[Source (PHP)](/src/Twig/Components/Progress.php) • [Source (Twig)](/templates/components/Progress.html.twig) • [daisyUI docs](https://daisyui.com/components/progress/)

Progress bar can be used to show the progress of a task or to show the passing of time.

## 🚀 Example

Progress with a `value` and a `max`:

```twig
<twig:Progress value="75" max="100" />
```

Indeterminate progress:

```twig
<twig:Progress theme="primary" />
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `theme` | The daisyUI theme to use. | `null\|string` |  | `null` |

## 📖 Related

- [Loading](Loading.md)
- [RadialProgress](RadialProgress.md)
