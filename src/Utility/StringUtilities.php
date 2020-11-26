<?php

/*
 * Author : Maarten Verijdt (murtho@gmail.com)
 */

namespace Murtho\Utility;

/**
 * StringUtilities
 */
class StringUtilities
{
    /**
     * Camelize
     *
     * Converts a string to camelCase
     *
     * @param string $input     The string to convert
     * @param string $separator The separator
     * @return string The camelized output
     */
    public static function camelize(string $input, string $separator = "_"): string
    {
        $output = str_replace($separator, '', ucwords($input, $separator));

        return lcfirst($output);
    }

    /**
     * Uncamelize
     *
     * Reverts a camelized string
     *
     * @param string $input     The string to convert
     * @param string $separator The separator
     * @return string The uncamelized output
     */
    public static function uncamelize(string $input, string $separator = "_"): string
    {
        $output = preg_replace('/(?<!^)[A-Z]/', $separator . '$0', $input);

        return strtolower($output);
    }

    /**
     * Boolean To String
     *
     * @param boolean $boolean
     * @param array   $map
     * @return string
     * @throws \Exception
     */
    public static function booleanToString(bool $boolean, array $map = null): string
    {
        if (null === $map) {
            $map = [
                1 => "Y",
                0 => "N",
            ];
        }

        if (0 !== count(array_diff_key(array_flip([1, 0]), $map))) {
            throw new \Exception("character map is incomplete");
        }

        return $map[intval($boolean)];
    }

    /**
     * String To Boolean
     *
     * @param string $string
     * @param array  $map
     * @return boolean
     * @throws \Exception
     */
    public static function stringToBoolean(string $string, array $map = null): bool
    {
        if (null === $map) {
            $map = [
                1 => "Y",
                0 => "N",
            ];
        }

        if (0 !== count(array_diff_key(array_flip([1, 0]), $map))) {
            throw new \Exception("character map is incomplete");
        }

        switch ($string) {
            case $map[1]:
                return true;
            case $map[0]:
                return false;
            default:
                throw new \Exception("invalid char provided");
        }
    }

    /**
     * String Starts With
     *
     * @param string $haystack
     * @param string $needle
     * @return boolean
     */
    public static function stringStartsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);

        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * String Ends With
     *
     * @param string $haystack
     * @param string $needle
     * @return boolean
     */
    public static function stringEndsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);

        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * String Start
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function stringStart(string $string, string $delimiter): string
    {
        $parts = explode($delimiter, $string);

        return array_shift($parts);
    }

    /**
     * String End
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function stringEnd(string $string, string $delimiter): string
    {
        $parts = explode($delimiter, $string);

        return array_pop($parts);
    }

    /**
     * Random String
     *
     * @param integer $length
     * @return string
     */
    public static function randomString(int $length): string
    {
        $string = "";

        for ($i = strlen($string); $i < $length; $i += 32) {
            try {
                $string .= md5(random_bytes($length));
            }
            catch (\Exception $exception) {
                $string .= md5(uniqid("", true));
            }
        }

        return substr($string, 0, $length);
    }
}