# 🧩 Swap
[Source (PHP)](/src/Twig/Components/Swap.php) • [Source (Twig)](/templates/components/Swap.html.twig) • [daisyUI docs](https://daisyui.com/components/swap/)

Swap allows you to toggle the visibility of two elements using a checkbox or a class name.

## 🚀 Example

```twig
<twig:Swap on="ON" off="OFF" on:class="text-success" off:class="text-error" />
```

```twig
<twig:Swap class="text-4xl" active>
    <twig:block name="on">
        🥳 Happy
    </twig:block>
    <twig:block name="off">
        😭 Sad
    </twig:block>
</twig:Swap>
```

## ⚙️ Props

| Prop     | Description | Type        | Required   | Default |
| -------- | ----------- | :---------: | :--------: | ------- |
| `on` | The &quot;on&quot; content of the swap (used when the block is not present). | `null\|string` |  | `null` |
| `off` | The &quot;off&quot; content of the swap (used when the block is not present). | `null\|string` |  | `null` |
| `effect` | The effect to use (&quot;rotate&quot;, &quot;flip&quot;, etc.). | `null\|string` |  | `null` |
| `active` | Whether the swap is active when the page loads. | `null\|bool` |  | `null` |
