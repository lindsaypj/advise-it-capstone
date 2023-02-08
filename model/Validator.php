<?php

class Validator {
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
}