<?php

class Validator {
    private static int $_MAX_SCHOOL_YEAR = 2040;
    static function validToken(string $token) {
        // validate length
        if (strlen($token) != 6) {
            return false;
        }

        // Allowed chars (letters and numbers)
        if (!ctype_alnum($token)) {
            return false;
        }

        return true;
    }

    static function validLink($name, $link) {
        // Validate Name
        if (strlen($name) < 3) {
            return false;
        }
        // Validate Link
        if (substr($link, 0, 7) !== "http://" && substr($link, 0, 8) !== "https://") {
            return false;
        }
        if (strlen($link) < 12) {
            return false;
        }
        return true;
    }

    static function validYears($schoolYears) {
        $minYear = DataLayer::getCurrentSchoolYear() - 2;

        foreach($schoolYears as $year=>$schoolYear) {
            if ($year > self::$_MAX_SCHOOL_YEAR || $year < $minYear) {
                return false;
            }
        }
        return true;
    }
}