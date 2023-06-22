<?php

/**
 * mix
 *
 * @param  array $color_1
 * @param  array $color_2
 * @param  int $weight
 *
 * @return array
 */
function mix($color_1 = [0, 0, 0], $color_2 = [0, 0, 0], $weight = 0.5)
{
    $f = function ($x) use ($weight) {
        return $weight * $x;
    };

    $g = function ($x) use ($weight) {
        return (1 - $weight) * $x;
    };

    $h = function ($x, $y) {
        return round($x + $y);
    };

    return array_map($h, array_map($f, $color_1), array_map($g, $color_2));
}

/**
 * tint
 *
 * @param  string|array $color
 * @param  int $weight
 *
 * @return string|array
 */
function tint($color, $weight = 0.5)
{
    $t = $color;

    if (is_string($color)) {
        $t = hex2rgb($color);
    }

    $u = mix([255, 255, 255], $t, $weight);

    if (is_string($color)) {
        return rgb2hex($u);
    }

    return $u;
}

/**
 * shade
 *
 * @param  string|array $color
 * @param  int $weight
 *
 * @return string|array
 */
function shade($color, $weight = 0.5)
{
    $t = $color;

    if (is_string($color)) {
        $t = hex2rgb($color);
    }

    $u = mix([0, 0, 0], $t, $weight);

    if (is_string($color)) {
        return rgb2hex($u);
    }

    return $u;
}

/**
 * hex2rgb
 *
 * @param  string $hex
 *
 * @return array
 */
function hex2rgb($hex)
{
    $f = function ($x) {
        return hexdec($x);
    };

    return array_map($f, str_split(str_replace('#', '', $hex), 2));
}

/**
 * rgb2hex
 *
 * @param  array $rgb
 *
 * @return string
 */
function rgb2hex($rgb)
{
    $f = function ($x) {
        return str_pad(dechex($x), 2, '0', STR_PAD_LEFT);
    };

    return '#' . implode('', array_map($f, $rgb));
}
