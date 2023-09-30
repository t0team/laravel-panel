<?php

namespace T0team\LaravelPanel;

use Illuminate\Support\Str;

class Helper
{
    public static function value(mixed $data, ?string $key): mixed
    {
        if (is_null($key)) return null;

        return collect(explode('->', $key))->reduce(function ($carry, string $item) {
            $item = Str::of($item)->trim();

            if ($item->contains('()')) {
                $key = $item->before('()')->value();

                return $carry?->{$key}();
            }

            if ($item->contains('(') && $item->contains(')')) {
                $key = $item->before('(')->value();
                $params = $item->between('(', ')')->explode(',')->map(function ($param) {
                    return Str::of($param)->trim()->replaceMatches('/^["\'](.*)["\']$/', '$1');
                });

                return $carry?->{$key}(...$params->toArray());
            }

            return $carry?->{$item->value()};
        }, $data);
    }

    public static function needed(mixed $data, array $needed): array
    {
        if (empty($data)) return $needed;

        return collect($needed)
            ->map(fn ($need) => self::value($data, $need))
            ->filter()
            ->values()
            ->toArray();
    }
}
