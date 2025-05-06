# 🧩 Status
[daisyUI docs](https://daisyui.com/components/status/) •
[Source (PHP)](/src/Twig/Components/Status.php) •
[Source (Twig)](/templates/components/Status.html.twig)

Status is a really small icon to visually show the current status of an element, like online, offline, error, etc.

## 🚀 Examples

```twig
<twig:Status color="info" size="lg" />
```

## ⚙️ Props

| Prop    | Description                                                 | Type           | Default  |
|:--------|:------------------------------------------------------------|:---------------|:---------|
| `as`    | The HTML tag to use for rendering.                          | `string`       | `button` |
| `color` | The daisyUI theme.                                          | `null\|string` | `null`   |
| `size`  | The size of the component (how large it will be displayed). | `null\|string` | `null`   |
