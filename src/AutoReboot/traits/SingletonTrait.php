<?php

namespace AutoReboot\traits;

trait SingletonTrait {

    private static self $instance;

    public static function getInstance(): self {
        return self::$instance;
    }

    public static function setInstance(self $instance): void {
        self::$instance = $instance;
    }

    protected function __clone(): void {

    }

    public function __wakeup(): void {

    }
}
