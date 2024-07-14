# 🧩 DropdownContent
[Source (PHP)](/src/Twig/Components/DropdownContent.php) • [Source (Twig)](/templates/components/DropdownContent.html.twig)

Represents dropdown content and can be used as a child of the `Dropdown` component.

## 🚀 Example

```twig
<twig:DropdownContent class="card card-compact bg-primary text-primary-content z-[1] w-64 p-2 shadow">
    <div class="card-body">
        <h3 class="card-title">Card title!</h3>
        <p>you can use any element as a dropdown.</p>
    </div>
</twig:DrawerContent>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `div` |

## 📖 Related

- [Dropdown](Dropdown.md)
