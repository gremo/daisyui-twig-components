# 🧩 Accordion
[daisyUI docs](https://daisyui.com/components/accordion/) •
[Source (PHP)](/src/Twig/Components/Accordion.php) •
[Source (Twig)](/templates/components/Accordion.html.twig)

Accordion is used for showing and hiding content but only one item can stay open at a time.

## 🚀 Examples

> [!NOTE]
> Accordion children must be `Collapse` elements, which need to be bound using `collapseAttributes`.

> [!NOTE]
> Accordion will not render any wrapper element if `as` is `null` or if no attributes are passed.

```twig
<twig:Accordion>
    <twig:Collapse title="How do I create an account?" title:class="font-semibold">
        <twig:CollapseContent class="text-sm">
            Click the "Sign Up" button in the top right corner and follow the registration process.
        </twig:CollapseContent>
    </twig:Collapse>

    <twig:Collapse title="I forgot my password. What should I do?" title:class="font-semibold">
        <twig:CollapseContent class="text-sm">
            Click on "Forgot Password" on the login page and follow the instructions sent to your email.
        </twig:CollapseContent>
    </twig:Collapse>

    <twig:Collapse title="How do I update my profile information?" title:class="font-semibold">
        <twig:CollapseContent class="text-sm">
            Go to "My Account" settings and select "Edit Profile" to make changes.
        </twig:CollapseContent>
    </twig:Collapse>
</twig:Accordion>
```

## ⚙️ Props

| Prop | Description                                                              | Type             | Default                     |
|:-----|:-------------------------------------------------------------------------|:-----------------|:----------------------------|
| `as` | The HTML tag to use for rendering.                                       | `null \| string` | `null`                      |
| `id` | The unique identifier for the accordion (randomly generated if omitted). | `string`         | `accordion-<random number>` |

## 📖 Related

- [Collapse](Collapse.md)
