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

    static function shiftStartYear($plan, $startYear, $startQuarter) {
        // Sort years in ascending order (2000, 2001, 2002...)
        ksort($plan['schoolYears']);

        // Output variable
        $formattedYears = [];

        // Determine initial offset (Fall Quarter is 2020, while the rest are 2021)
        // This step is required to convert Calendar Year to School Year
        $incrementOffset = 0;
        if ($startQuarter === "AUTUMN") {
            $incrementOffset = 1;
        }
        // Store the plan data under the correct school years
        foreach ($plan['schoolYears'] as $schoolYear) {
            // Update calendar year for each quarter in each school year
            foreach($schoolYear as $key=>$quarter) {
                // ignore "render" property
                if (gettype($quarter) === "array") {
                    if ($key === "fall") {
                        $quarter['calendarYear'] = $startYear + $incrementOffset - 1;
                    } else {
                        $quarter['calendarYear'] = $startYear + $incrementOffset;
                    }
                }
            }
            // Render standard school year always
            $schoolYear['render'] = true;

            // Store school year in output array
            $formattedYears[$startYear+$incrementOffset] = $schoolYear;
            $incrementOffset++;
        }
        return $formattedYears;
    }
}