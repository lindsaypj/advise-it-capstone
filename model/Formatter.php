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

    static function addToSortedLinks($links, $newName, $newAddress) {
        $newLink['name'] = $newName;
        $newLink['link'] = $newAddress;

        // Loop over links
        for ($i = 0; $i < count($links); $i++) {

            // Check if new link goes before index
            if (strcmp($links[$i]['name'], $newLink['name']) >= 0) {
                // Insert at index (PASS NEWLINK AS ARRAY OF 1)
                array_splice($links, $i, 0, [$newLink]);
                return $links;
            }
        }
        $links[] = $newLink;
        return $links;
    }

    static function removeLink($links, $deleteLink) {
        // Loop over links
        for ($i = 0; $i < count($links); $i++) {

            // Check if found delete link
            if (strcmp($links[$i]['name'], $deleteLink) === 0) {
                // Remove link
                array_splice($links, $i, 1);
                return $links;
            }
        }
        return $links;
    }
}