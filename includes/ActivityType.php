<?php

class ActivityType {
    private static $types = [
        'education',
        'recreational',
        'social',
        'diy',
        'charity',
        'cooking',
        'relaxation',
        'music',
        'busywork',
    ];

    public static function getAllTypes(): array {
        return self::$types;
    }

    public static function getType (string $type): string|null {
        foreach(self::$types as $_type) {
            if ((strtolower($type) == strtolower($_type))) {
                return $_type;
            }
        }

        return null;
    }
}