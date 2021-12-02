<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Cache::rememberForever('translations', function () {
            $translations = collect();
            $locales = config('app.languages');

            foreach ($locales as $key => $locale) { // suported locales
                $translations[$key] = [
                    'php' => $this->phpTranslations($key),
                    'json' => $this->jsonTranslations($key),
                ];
            }

            return $translations;
        });
    }

    private function phpTranslations($locale)
    {
        $path = resource_path("lang/$locale");

        if (\File::exists($path)) {
            return collect(\File::allFiles($path))->flatMap(function ($file) use ($locale) {
                $key = ($translation = $file->getBasename('.php'));

                return [$key => trans($translation, [], $locale)];
            });
        }

        collect([]);
    }

    private function jsonTranslations($locale)
    {
        $path = resource_path("lang/$locale.json");

        if (is_string($path) && is_readable($path)) {
            return json_decode(file_get_contents($path), true);
        }
       

        return [];
    }
}
