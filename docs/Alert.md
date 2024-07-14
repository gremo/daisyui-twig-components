# 🧩 Alert
[Source (PHP)](/src/Twig/Components/Alert.php) • [Source (Twig)](/templates/components/Alert.html.twig) • [daisyUI docs](https://daisyui.com/components/alert/)

Alert informs users about important events.

## 🚀 Example

```twig
<twig:Alert theme="error" content="An error occurred." />
```

```twig
<twig:Alert theme="info">
   New <b>software update</b> available.
</twig:Alert>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `div` |
| `content` | The content (used when the block is not present). | `null\|string` |  | `null` |
| `theme` | The daisyUI theme to use. | `null\|string` |  | `null` |
