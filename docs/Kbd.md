# 🧩 Kbd
[Source (PHP)](/src/Twig/Components/Kbd.php) • [Source (Twig)](/templates/components/Kbd.html.twig) • [daisyUI docs](https://daisyui.com/components/kbd/)

Kbd is used to display keyboard shortcuts.

## 🚀 Example

```twig
<twig:Kbd content="A" />
```

```twig
<twig:Kbd size="sm">
   B
</twig:Kbd>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `div` |
| `content` | The content (used when the block is not present). | `null\|string` |  | `null` |
| `size` | The size of the component (how large it will be displayed). | `null\|string` |  | `null` |
