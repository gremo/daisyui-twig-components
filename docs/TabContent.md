# 🧩 TabContent
[Source (PHP)](/src/Twig/Components/TabContent.php) • [Source (Twig)](/templates/components/TabContent.html.twig)

Represents a tab panel and can be used as a child of the `Tabs` component.

## 🚀 Example

```twig
<twig:TabContent label="Tab 1" tab="my-tabs" class="rounded-box p-6">
    Content 1
</twig:TabContent>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| <b>`label`</b> | The text to show as label. | `string` | Yes | `null` |
| <b>`tab`</b> | The HTML ID of the tabs it refers to. | `string` | Yes | `null` |
| `active` | Whether the tab is active by default when the page loads. | `null\|bool` |  | `false` |

## 📖 Related

- [Tabs](Tabs.md)
