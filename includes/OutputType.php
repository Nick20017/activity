<?php

enum OutputTypeEnum {
    case file;
    case console;
}

class OutputType {
    public static function getAllTypes(): array {
        $result = [];

        foreach(OutputTypeEnum::cases() as $case) {
            $result[] = $case->name;
        }

        return $result;
    }

    public static function getType (string $type): OutputTypeEnum|null {
        foreach(OutputTypeEnum::cases() as $case) {
            if (strtolower($type) == strtolower($case->name)) {
                return $case;
            }
        }

        return null;
    }
}