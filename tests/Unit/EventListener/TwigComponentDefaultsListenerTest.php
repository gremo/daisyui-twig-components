<?php

namespace Gremo\DaisyUITwigComponents\Tests\Unit\EventListener;

use Gremo\DaisyUITwigComponents\EventListener\TwigComponentDefaultsListener;
use Gremo\DaisyUITwigComponents\Tests\Fixtures\Component\Foo;
use PHPUnit\Framework\TestCase;
use Symfony\UX\TwigComponent\ComponentMetadata;
use Symfony\UX\TwigComponent\Event\PreMountEvent;

class TwigComponentDefaultsListenerTest extends TestCase
{
    public function testIgnoreExternalComponents(): void
    {
        $event = new PreMountEvent(new \stdClass(), ['foo' => 'baz'], new ComponentMetadata(['key' => 'Foo']));

        $listener = new TwigComponentDefaultsListener(['Foo' => ['foo' => 'bar']]);
        $listener->onPreMount($event);

        $this->assertSame($event->getData(), ['foo' => 'baz']);
    }

    /**
     * @testWith [{"foo": false}, {}, {"foo": false}]
     *           [{"foo": "bar"}, {"foo": null}, {"foo": null}]
     *           [{"bar": null}, {"bar": false}, {"bar": false}]
     *           [{"bar": 2}, {"bar": 0}, {"bar": 0}]
     */
    public function testHonorComponentData(array $defaults, array $data, array $expected): void
    {
        $event = new PreMountEvent(new Foo(), $data, new ComponentMetadata(['key' => 'Foo']));

        $listener = new TwigComponentDefaultsListener(['Foo' => $defaults]);
        $listener->onPreMount($event);

        $this->assertSame($event->getData(), $expected);
    }

    /**
     * @testWith [{}, {}, {}]
     *           [{"foo": "bar"}, {}, {"foo": "bar"}]
     *           [{}, {"foo": "bar"}, {"foo": "bar"}]
     *           [{"foo": "bar", "bar": "baz"}, {"foo": "baz"}, {"foo": "baz", "bar": "baz"}]
     */
    public function testSetComponentData(array $defaults, array $data, array $expected): void
    {
        $event = new PreMountEvent(new Foo(), $data, new ComponentMetadata(['key' => 'Foo']));

        $listener = new TwigComponentDefaultsListener(['Foo' => $defaults]);
        $listener->onPreMount($event);

        $this->assertSame($event->getData(), $expected);
    }
}
