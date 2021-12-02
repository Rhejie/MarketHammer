<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\Setting\Translation;
use App\Http\Controllers\Controller;
use App\Repositories\Translation\TranslationRepository;
use App\Http\Requests\BackOffice\Translation\{StoreTranslation, UpdateTranslation};

class TranslationController extends Controller
{
    /**
     * The abstraction layer for the translation module
     *
     * @var BusinessCertificationRepository
     */
    private $translationRepository;

    public function __construct(TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslation $request)
    {
        \DB::beginTransaction();
        try {
            $translation = $this->translationRepository->create($request->all());

            if ($translation) {
                \DB::commit();

                $className = $this->resourceItem();

                return new $className($translation);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslation $request, $id)
    {
        $model = Translation::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $translation = $this->translationRepository->update($request->all(), $id);

                if ($translation) {
                    \DB::commit();

                    $className = $this->resourceItem();

                    return new $className($translation);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $translation = $this->translationRepository->delete($id);

        return $translation;
    }

    /**
     * This method will return the list of queried translations
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getTranslations(Request $request)
    {
        $searchString = $request->input('searchString');
        $status = $request->input('is_active');

        $translations = Translation::select();

        if ($searchString) {
            $translations->where(function ($q) use ($searchString) {
                $q->where('en', 'like', "%$searchString%");
                $q->orWhere('ko', 'like', "%$searchString%");
                $q->orWhere('zh', 'like', "%$searchString%");
                $q->orWhere('jp', 'like', "%$searchString%");
                $q->orWhere('de_de', 'like', "%$searchString%");
                $q->orWhere('key', 'like', "%$searchString%");
            });
        }

        $translations = $translations->orderBy('id', 'DESC')->paginate($request->input('size'));

        return $translations;
    }

    /**
     * API endpoing in syncing the translations from the DB to the translations files
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <boolean>
     */
    public function syncTranslations(Request $request)
    {
        $translations = Translation::get()->toArray();

        $lanEn = fopen(base_path() . '/resources/lang/en.json', "w");
        $langKo = fopen(base_path() . '/resources/lang/ko.json', "w");
        $langZh = fopen(base_path() . '/resources/lang/zh.json', "w");
        $langJp = fopen(base_path() . '/resources/lang/jp.json', "w");
        $langDede = fopen(base_path() . '/resources/lang/de_de.json', "w");

        $enContent = "{";
        $koContent = "{";
        $zhContent = "{";
        $jpContent = "{";
        $dedeContent = "{";

        $count = count($translations);
        foreach ($translations as $key => $trans) {
            $isLast = ($key + 1) === $count;

            $enContent .= PHP_EOL . "\t" . '"' . $trans['key'] . '"' . ": " . '"' . ($trans['en'] ?: '') . '"' . ($isLast ? '' : ',');
            $koContent .= PHP_EOL . "\t" . '"' . $trans['key'] . '"' . ": " . '"' . ($trans['ko'] ?: '') . '"' . ($isLast ? '' : ',');
            $zhContent .= PHP_EOL . "\t" . '"' . $trans['key'] . '"' . ": " . '"' . ($trans['zh'] ?: '') . '"' . ($isLast ? '' : ',');
            $jpContent .= PHP_EOL . "\t" . '"' . $trans['key'] . '"' . ": " . '"' . ($trans['jp'] ?: '') . '"' . ($isLast ? '' : ',');
            $dedeContent .= PHP_EOL . "\t" . '"' . $trans['key'] . '"' . ": " . '"' . ($trans['de_de'] ?: '') . '"' . ($isLast ? '' : ',');
        }

        $enContent .= PHP_EOL . "}";
        $koContent .= PHP_EOL . "}";
        $zhContent .= PHP_EOL . "}";
        $jpContent .= PHP_EOL . "}";
        $dedeContent .= PHP_EOL . "}";

        fwrite($lanEn, $enContent);
        fwrite($langKo, $koContent);
        fwrite($langZh, $zhContent);
        fwrite($langJp, $jpContent);
        fwrite($langDede, $dedeContent);

        \Artisan::call('cache:clear');

        return true;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Translation\TranslationResource::class;
    }
}
