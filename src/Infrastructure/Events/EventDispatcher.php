<?php
namespace App\Infrastructure\Events;

class EventDispatcher
{
    private static array $listeners = [];

    public static function addListener(string $eventClass, callable $listener): void
    {
        self::$listeners[$eventClass][] = $listener;
    }

    public static function dispatch(object $event): void
    {
        $eventClass = get_class($event);

        if (!isset(self::$listeners[$eventClass])) {
            return;
        }

        foreach (self::$listeners[$eventClass] as $listener) {
            $listener($event);
        }
    }
}
