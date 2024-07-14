# 🧩 Drawer
[Source (PHP)](/src/Twig/Components/Drawer.php) • [Source (Twig)](/templates/components/Drawer.html.twig) • [daisyUI docs](https://daisyui.com/components/drawer/)

Drawer is a grid layout that can show/hide a sidebar on the left or right side of the page.

## 🚀 Example

```twig
<twig:Drawer>
    <twig:DrawerContent>
        <!-- page content -->
        <twig:Button content="Open drawer" {{ ...buttonAttributes }} />
    </twig:DrawerContent>

    <twig:DrawerSide {{ ...sideAttributes }}>
        <div class="min-h-full w-80 bg-base-200 p-4">
            <!-- side content -->
        </div>
    </twig:DrawerSide>
</twig:Drawer>
```
In order to work properly:

- Requires the button to be a component with `as` prop and to be bound using `buttonAttributes`
- Requires the side to be bound using`sideAttributes`

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| <b>`id`</b> | The unique identifier for the drawer (if omitted, one will be randomly generated). | `string` | Yes | `null` |
| `as` | The HTML tag to use for rendering. | `string` |  | `div` |

## 📖 Related

- [DrawerContent](DrawerContent.md)
- [DrawerSide](DrawerSide.md)
