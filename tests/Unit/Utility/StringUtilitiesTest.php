<?php

/*
 * Author : Maarten Verijdt (murtho@gmail.com)
 */

namespace Murtho\Tests\Unit\Utility;

use Murtho\Utility\StringUtilities;
use PHPUnit\Framework\TestCase;

/**
 * String Utilities Test
 */
final class StringUtilitiesTest extends TestCase
{
    /**
     * @param string $input
     * @param string $separator
     * @param string $expectedOutput
     *
     * @dataProvider provideCamelizeData
     * @test
     */
    public function stringCanBeCamelized(string $input, string $separator, string $expectedOutput)
    {
        $output = StringUtilities::camelize($input, $separator);

        static::assertEquals($expectedOutput, $output);
        static::assertIsString($output);
    }

    /**
     * @return array
     */
    public function provideCamelizeData(): array
    {
        return [
            ["camel_case", "_", "camelCase"],
            ["some.weird.setting", ".", "someWeirdSetting"],
            ["do-something-else", "-", "doSomethingElse"],
        ];
    }

    /**
     * @param string $input
     * @param string $separator
     * @param string $expectedOutput
     *
     * @dataProvider provideUncamelizeData
     * @test
     */
    public function stringCanBeUncamelized(string $input, string $separator, string $expectedOutput)
    {
        $output = StringUtilities::uncamelize($input, $separator);

        static::assertEquals($expectedOutput, $output);
        static::assertIsString($output);
    }

    /**
     * @return array
     */
    public function provideUncamelizeData(): array
    {
        return [
            ["camelCase", "_", "camel_case"],
            ["someWeirdSetting", "-", "some-weird-setting"],
            ["doSomethingElse", ".", "do.something.else"],
        ];
    }

    /**
     * @param string  $input
     * @param boolean $expectedOutput
     * @throws \Exception
     *
     * @dataProvider provideStringToBooleanData
     * @test
     */
    public function stringCanBeConvertedToBoolean(string $input, bool $expectedOutput)
    {
        $output = StringUtilities::stringToBoolean($input);

        static::assertEquals($expectedOutput, $output);
        static::assertIsBool($output);
    }

    /**
     * @return array
     */
    public function provideStringToBooleanData(): array
    {
        return [
            ["Y", true],
            ["N", false],
        ];
    }

    /**
     * @param boolean $input
     * @param string $expectedOutput
     * @throws \Exception
     *
     * @dataProvider provideBooleanToStringData
     * @test
     */
    public function booleanCanBeConvertedToString(bool $input, string $expectedOutput)
    {
        $output = StringUtilities::booleanToString($input);

        static::assertEquals($expectedOutput, $output);
        static::assertIsString($output);
    }

    /**
     * @return array
     */
    public function provideBooleanToStringData(): array
    {
        return [
            [true, "Y"],
            [false, "N"],
        ];
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param boolean $expectedOutput
     *
     * @dataProvider provideStringStartsWithData
     * @test
     */
    public function checkStringStartsWithIsCorrect(string $haystack, string $needle, bool $expectedOutput)
    {
        $output = StringUtilities::stringStartsWith($haystack, $needle);

        static::assertEquals($expectedOutput, $output);
        static::assertIsBool($output);
    }

    /**
     * @return array
     */
    public function provideStringStartsWithData(): array
    {
        return [
            ["check it out", "check", true],
            ["check it out", "it", false],
            ["check it out", "out", false],
        ];
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param boolean $expectedOutput
     *
     * @dataProvider provideStringEndsWithData
     * @test
     */
    public function checkStringEndsWithIsCorrect(string $haystack, string $needle, bool $expectedOutput)
    {
        $output = StringUtilities::stringEndsWith($haystack, $needle);

        static::assertEquals($expectedOutput, $output);
        static::assertIsBool($output);
    }

    /**
     * @return array
     */
    public function provideStringEndsWithData(): array
    {
        return [
            ["this works perfectly", "this", false],
            ["this works perfectly", "works", false],
            ["this works perfectly", "perfectly", true],
        ];
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param string $expectedOutput
     *
     * @dataProvider provideStringStartData
     * @test
     */
    public function checkStringStart(string $string, string $delimiter, string $expectedOutput)
    {
        $output = StringUtilities::stringStart($string, $delimiter);

        static::assertEquals($expectedOutput, $output);
        static::assertIsString($output);
    }

    /**
     * @return array
     */
    public function provideStringStartData(): array
    {
        return [
            ["file.exe", ".", "file"],
            ["template.html.twig", ".", "template"],
            ["product-retail-price", "-", "product"],
            ["device-weight", "-", "device"],
        ];
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param string $expectedOutput
     *
     * @dataProvider provideStringEndData
     * @test
     */
    public function checkStringEnd(string $string, string $delimiter, string $expectedOutput)
    {
        $output = StringUtilities::stringEnd($string, $delimiter);

        static::assertEquals($expectedOutput, $output);
        static::assertIsString($output);
    }

    /**
     * @return array
     */
    public function provideStringEndData(): array
    {
        return [
            ["file.exe", ".", "exe"],
            ["template.html.twig", ".", "twig"],
            ["product-retail-price", "-", "price"],
            ["device-weight", "-", "weight"],
        ];
    }

    /**
     * @param integer $length
     *
     * @dataProvider provideRandomStringLengthData
     * @test
     */
    public function randomStringCanBeGenerated(int $length)
    {
        $output = StringUtilities::randomString($length);

        static::assertIsString($output);
        static::assertEquals($length, strlen($output));
    }

    /**
     * @return array
     */
    public function provideRandomStringLengthData(): array
    {
        return [
            [1], [2], [4], [8], [16], [32], [48], [64], [128],
        ];
    }
}