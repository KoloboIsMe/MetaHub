<?php
const UNALOWED_REGEX = [
    'SELECT', 'INSERT', 'UPDATE', 'DELETE', '=', '/', '\'', '"', '\\', 'rm',
    'mkdir', 'sudo',
];
const SUSPICIOUS_REGEX = [
    "/\n/","/\r/", "/\t/", "/\v/", "/\x00/", '/SELECT/', '/INSERT/', '/UPDATE/'
];
function hardSanitize(string &$string) : string
    // Hard sanitize a string to make sure it cannot harm the application in any way
    // Delete anything in the string that is in the UNALOWED_REGEX constant
{
    softSanitize($string);
    foreach (SUSPICIOUS_REGEX as $regex)
    {
        if(preg_match("$regex",$string))
        {
           $string = str_replace("$regex", '', $string);
        }
    }

    return $string;
}
function softSanitize(string &$string) : string
    // Soft sanitize a string to make sure it cannot harm the application in any way
    // Delete any unusual characters that can cause harm
{
    foreach (UNALOWED_REGEX as $regex)
    {
        if(preg_match("/i/$regex/",$string))
        {
            $string = str_replace("/i/$regex/", '', $string);
        }
    }
    return str_replace(UNALOWED_REGEX, '', $string);
}