<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    /**
     * @param string $title
     * @param class-string<\Illuminate\Database\Eloquent\Model> $modelClass
     * @param int|null $ignoreId
     */
    public static function generate(string $title, string $modelClass, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (
            $modelClass::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }
}
