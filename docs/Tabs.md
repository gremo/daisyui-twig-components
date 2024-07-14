# 🧩 Tabs
[Source (PHP)](/src/Twig/Components/Tabs.php) • [Source (Twig)](/templates/components/Tabs.html.twig) • [daisyUI docs](https://daisyui.com/components/tab/)

Tabs can be used to show a list of links in a tabbed format.

## 🚀 Example

Usage with links:

```twig
<twig:Tabs shape="lifted">
    <twig:Tab>Tab 1</twig:Tab>
    <twig:Tab active>Tab 2</twig:Tab>
    <twig:Tab>Tab 3</twig:Tab>
</twig:Tabs>
```

Usage with content (tab panels):

```twig
<twig:Tabs shape="boxed" size="sm">
    <twig:TabContent label="Tab 1" class="rounded-box p-6" active {{ ...tabAttributes }}>
        Content 1
    </twig:TabContent>
    <twig:TabContent label="Tab 2" class="rounded-box p-6" {{ ...tabAttributes }}>
        Content 2
    </twig:TabContent>
</twig:Tabs>
```

In order to work properly:

- Requires the content to be bound with `tabAttributes`

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `id` | The unique identifier for the tabs (if omitted, one will be randomly generated). | `null\|string` |  | `null` |
| `size` | The size of the component (how large it will be displayed). | `null\|string` |  | `null` |
| `shape` | The shape of the component (&quot;boxed&quot;, &quot;bordered&quot;, etc.). | `null\|string` |  | `null` |

## 📖 Related

- [Tab](Tab.md)
- [TabContent](TabContent.md)
