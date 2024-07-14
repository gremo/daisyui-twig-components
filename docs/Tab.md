# 🧩 Tab
[Source (PHP)](/src/Twig/Components/Tab.php) • [Source (Twig)](/templates/components/Tab.html.twig)

Represents a tab and can be used as a child of the `Tabs` component.

## 🚀 Example

```twig
<twig:Tab as="button">
    Content 1
</twig:Tab>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `a` |
| `active` | Whether the tab is active by default when the page loads. | `null\|bool` |  | `false` |

## 📖 Related

- [Tabs](Tabs.md)
