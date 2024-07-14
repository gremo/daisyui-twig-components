# 🧩 Badge
[Source (PHP)](/src/Twig/Components/Badge.php) • [Source (Twig)](/templates/components/Badge.html.twig) • [daisyUI docs](https://daisyui.com/components/badge/)

Badges are used to inform the user of the status of specific data.

## 🚀 Example

```twig
<twig:Badge theme="primary" content="primary" />
```

```twig
<twig:Badge theme="secondary" outline>
   secondary
</twig:Badge>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `div` |
| `content` | The content (used when the block is not present). | `null\|string` |  | `null` |
| `theme` | The daisyUI theme. | `null\|string` |  | `null` |
| `size` | The size of the component (how large it will be displayed). | `null\|string` |  | `null` |
| `outline` | Whether the badge is shown outlined (transparent with border). | `null\|bool` |  | `false` |
