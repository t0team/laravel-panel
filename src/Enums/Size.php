<?php

namespace T0team\LaravelPanel\Enums;

final class Size
{
    public const SMALL = 'sm';
    public const MEDIUM = 'md';
    public const LARGE = 'lg';
    public const EXTRA_LARGE = 'xl';


    /**
     * @return string[]
     */
    public static function available_sizes(): array
    {
        $reflection = new \ReflectionClass(self::class);

        /* @phpstan-ignore-next-line */
        return $reflection->getConstants();
    }

    public static function is_available_size(string $size): bool
    {
        return in_array($size, self::available_sizes());
    }
}
