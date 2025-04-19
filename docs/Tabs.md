# 🧩 Tabs
[daisyUI docs](https://daisyui.com/components/tab/) •
[Source (PHP)](/src/Twig/Components/Tabs.php) •
[Tabs source (Twig)](/templates/components/Tabs.html.twig) •
[Tab source (Twig)](/templates/components/Tab.html.twig) •

Tabs can be used to show a list of links in a tabbed format.

## 🚀 Examples

```twig
<twig:Tabs style="lift">
    <twig:Tab class="p-6" label="Tab 1" active>
        Tab content 1
    </twig:Tab>

    <twig:Tab class="p-6" label="Tab 2">
        Tab content 2
    </twig:Tab>

    <twig:Tab class="p-6" label="Tab 3">
        Tab content 3
    </twig:Tab>
</twig:Tabs>
```

## ⚙️ `Tabs` props

| Prop        | Description                                                         | Type           | Default                |
|:------------|:--------------------------------------------------------------------|:---------------|:-----------------------|
| `as`        | The HTML tag to use for rendering.                                  | `null\|string` | `div`                  |
| `id`        | The unique identifier for the tabs (randomly generated if omitted). | `string`       | `tabs-<random number>` |
| `placement` | The component position ("top", "bottom").                           | `null\|string` | `null`                 |
| `size`      | The size of the component ("lg", "md", etc.).                       | `null\|string` | `null`                 |
| `style`     | The component style ("box", "border", etc.).                        | `null\|string` | `null`                 |

## ⚙️ `Tab` props

| Prop       | Description                                         | Type           | Default |
|:-----------|:----------------------------------------------------|:---------------|:--------|
| `as`       | The HTML tag to use for rendering.                  | `null\|string` | `div`   |
| `label`    | The text to show (also used as `aria-label` value). | `string`       |         |
| `active`   | Marks the content as active (i.e., visible).        | `bool`         | `false` |
| `disabled` | Marks the content as disabled.                      | `bool`         | `false` |

The component supports the following nested attributes:

- `input:*`: for the input element

## 📖 Related

- [Dock](Dock.md)
- [Menu](Menu.md)
- [Steps](Steps.md)
