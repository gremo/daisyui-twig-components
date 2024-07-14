# 🧩 DrawerSide
[Source (PHP)](/src/Twig/Components/DrawerSide.php) • [Source (Twig)](/templates/components/DrawerSide.html.twig)

Represents drawer side and can be used as a child of the `Drawer` component.

## 🚀 Example

```twig
<twig:DrawerSide drawer="my-drawer">
    Side content
</twig:DrawerSide>
```
- Supports nested attributes for the overlay

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `as` | The HTML tag to use for rendering. | `string` |  | `div` |
| <b>`drawer`</b> | The HTML ID of the drawer it refers to. | `string` | Yes | `null` |

## 📖 Related

- [Drawer](Drawer.md)
