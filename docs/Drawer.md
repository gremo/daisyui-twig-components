# 🧩 Drawer
[daisyUI docs](https://daisyui.com/components/drawer/) •
[Drawer source (PHP)](/src/Twig/Components/Drawer.php) •
[Drawer source (Twig)](/templates/components/Drawer.html.twig) •
[DrawerContent source (Twig)](/templates/components/DrawerContent.html.twig) •
[DrawerSide source (Twig)](/templates/components/DrawerSide.html.twig)

Drawer is a grid layout that can show/hide a sidebar on the left or right side of the page.

## 🚀 Examples

> [!NOTE]
> Drawer toggle must be a component that supports `as` prop and to be bound using `toggleAttributes`.

```twig
<twig:Drawer>
    <twig:DrawerContent class="min-h-svh">
        <twig:Button {{ ...toggleAttributes }}>
            Open drawer
        </twig:Button>

        <!-- All your page content goes here -->
    </twig:DrawerContent>

    <twig:DrawerSide>
        <!-- Sidebar content (menu or anything) -->
    </twig:DrawerSide>
</twig:Drawer>
```

## ⚙️ `Drawer` props

| Prop | Description                                                           | Type     | Default                  |
|:-----|:----------------------------------------------------------------------|:---------|:-------------------------|
| `as` | The HTML tag to use for rendering.                                    | `string` | `div`                    |
| `id` | The unique identifier for the drawer (randomly generated if omitted). | `string` | `drawer-<random number>` |

The component supports the following nested attributes:

- `input:*`: input element

## ⚙️ `DrawerContent` props

| Prop | Description                        | Type     | Default |
|:-----|:-----------------------------------|:---------|:--------|
| `as` | The HTML tag to use for rendering. | `string` | `div`   |

## ⚙️ `DrawerSide` props

| Prop | Description                        | Type     | Default |
|:-----|:-----------------------------------|:---------|:--------|
| `as` | The HTML tag to use for rendering. | `string` | `div`   |

The component supports the following nested attributes:

- `overlay:*`: for the label element

## ⚙️ `DrawerContent` props

| Prop | Description                        | Type     | Default |
|------|------------------------------------|:---------|:--------|
| `as` | The HTML tag to use for rendering. | `string` | `div`   |
