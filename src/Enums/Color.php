<?php

namespace T0team\LaravelPanel\Enums;

final class Color
{
    public const THEME = 'theme'; // theme color
    public const PRIMARY = 'primary';
    public const SECONDARY = 'secondary';
    public const SUCCESS = 'success';
    public const DANGER = 'danger';
    public const WARNING = 'warning';
    public const INFO = 'info';
    public const LIGHT = 'light';
    public const DARK = 'dark';
    public const LINK = 'link';


    /**
     * @return string[]
     */
    public static function available_colors(): array
    {
        $reflection = new \ReflectionClass(self::class);

        /* @phpstan-ignore-next-line */
        return $reflection->getConstants();
    }

    public static function is_available_color(string $color): bool
    {
        return in_array($color, self::available_colors());
    }
}
