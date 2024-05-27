<?php

class Config {
    private static string $activityAPI = 'https://bored-api.appbrewery.com/filter';

    public static function getActivityAPI(): string {
        return self::$activityAPI;
    }
}