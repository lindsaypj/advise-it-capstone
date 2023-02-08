<?php

/**
 * Static class containing methods to format data for rendering
 */
class Formatter
{
    static function formatTime(int $time)
    {
        // Get current timestamp and format
        $fmt = datefmt_create(
            'en_US',
            IntlDateFormatter::SHORT,
            IntlDateFormatter::MEDIUM,
            'America/Los_Angeles',
            IntlDateFormatter::GREGORIAN
        );
        return datefmt_format($fmt, $time);
    }
}