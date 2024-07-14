# 🧩 Loading
[Source (PHP)](/src/Twig/Components/Loading.php) • [Source (Twig)](/templates/components/Loading.html.twig) • [daisyUI docs](https://daisyui.com/components/loading/)

Loading shows an animation to indicate that something is loading.

## 🚀 Example

```twig
<twig:Loading shape="spinner" />
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `span` |
| `shape` | The shape of the component (&quot;spinner&quot;, &quot;bars&quot;, etc.). | `null\|string` |  | `null` |

## 📖 Related

- [Progress](Progress.md)
- [RadialProgress](RadialProgress.md)
