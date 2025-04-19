# 🧩 Steps
[daisyUI docs](https://daisyui.com/components/steps/) •
[Source (PHP)](/src/Twig/Components/Steps.php) •
[Source (Twig)](/templates/components/Steps.html.twig)

Steps can be used to show a list of steps in a process.

## 🚀 Examples

```twig
<twig:Steps>
    <twig:Step color="primary">Register</twig:Step>
    <twig:Step color="primary">Choose plan</twig:Step>
    <twig:Step>Purchase</twig:Step>
    <twig:Step>Receive Product</twig:Step>
</twig:Steps>
```

Step with content and icon:

```twig
<twig:Steps>
    <twig:Step color="neutral" content="Step 1" icon="?" />
    <twig:Step color="neutral" content="Step 2" icon="!" />
    <twig:Step color="neutral" content="Step 3" icon="✓" />
    <twig:Step color="neutral" content="Step 4" icon="✕" />
    <twig:Step color="neutral" content="Step 5" icon="★" />
    <twig:Step color="neutral" content="Step 6" icon="" />
    <twig:Step color="neutral" content="Step 7" icon="●" />
</twig:Steps>
```

Alternative syntax:

```twig
<twig:Steps>
    <twig:Step color="neutral">
        <twig:StepIcon content="😕" /> Step 1
    </twig:Step>
    <twig:Step color="neutral">
        <twig:StepIcon content="😃" /> Step 2
    </twig:Step>
    <twig:Step color="neutral">
        <twig:StepIcon content="😍" /> Step 3
    </twig:Step>
</twig:Steps>
```

## ⚙️ `Steps` props

| Prop        | Description                                      | Type           | Default |
|:------------|:-------------------------------------------------|:---------------|:--------|
| `as`        | The HTML tag to use for rendering.               | `null\|string` | `ul`    |
| `direction` | The component layout ("vertical", "horizontal"). | `null\|string` | `null`  |

## ⚙️ `Step` props

| Prop      | Description                                       | Type           | Default |
|:----------|:--------------------------------------------------|:---------------|:--------|
| `as`      | The HTML tag to use for rendering.                | `null\|string` | `null`  |
| `content` | The content (used when the block is not present). | `null\|string` | `null`  |
| `color`   | The component color ("info", "error", etc.).      | `null\|string` | `null`  |
| `icon`    | The icon content.                                 | `null\|string` | `null`  |
