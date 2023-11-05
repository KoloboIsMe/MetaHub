<?php
const UNALLOWED_REGEX = [
    '/SELECT/i', '/INSERT/i', '/UPDATE/i', '/DELETE/i', '/=/i', '/rm/i',
    '/mkdir/i', '/sudo/i', '/DROP/i', '/\\\\/', '/\//'
];
const SUSPICIOUS_REGEX = [
    '/\n/', '/\r/', '/\t/', '/\v/', '/\x00/'
];

function hardSanitize(string &$string) : string {
    // Hard sanitize a string to make sure it cannot harm the application in any way
    // Delete anything in the string that matches the SUSPICIOUS_REGEX patterns
    softSanitize($string);
    foreach (SUSPICIOUS_REGEX as $regex) {
        $string = preg_replace($regex, '', $string);
    }

    return $string;
}

function softSanitize(string &$string) : string {
    // Soft sanitize a string to make sure it cannot harm the application in any way
    // Delete any characters that match the UNALLOWED_REGEX patterns
    foreach (UNALLOWED_REGEX as $regex) {
        $string = preg_replace($regex, '', $string);
    }
    return $string;
}