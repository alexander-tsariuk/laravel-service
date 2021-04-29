<?php

namespace Modules\OurWorks\Entities;

use Illuminate\Database\Eloquent\Model;

class OurWorkTranslation extends Model {
    protected $table = 'our_work_translations';

    public $timestamps = false;

    protected $fillable = [
        'rowId',
        'name',
        'languageId',
        'meta_title',
        'meta_h1',
        'meta_keywords',
        'meta_description',
        'set_404',
        'set_noindex',
        'set_nofollow',
        'short_description'
    ];

    /**
     * Создаем переводы элемента раздела "Наши работы"
     * @param int $itemId
     * @param array $insertData
     * @return bool
     */
    protected function createTranslations(int $itemId, array $insertData) : bool {
        $count = (int)count($insertData);
        $saved = (int)0;

        if(!empty($insertData)) {
            foreach ($insertData as $languageId => $translation) {
                $translationItem = new OurWorkTranslation();

                $translationItem = $translationItem->fill([
                    'rowId' => $itemId,
                    'languageId' => $languageId,
                    'name' => $translation['name'],
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_h1' => $translation['meta_h1'] ?? null,
                    'meta_keywords' => $translation['meta_keywords'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
                    'set_404' => $translation['set_404'] ?? 0,
                    'set_noindex' => $translation['set_noindex'] ?? 0,
                    'set_nofollow' => $translation['set_nofollow'] ?? 0,
                    'short_description' => $translation['short_description'] ?? null,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved == $count;
    }
    /**
     * Обновляем переводы элемента раздела "Наши работы"
     * @param int $itemId
     * @param array $insertData
     * @return bool
     */
    protected function updateTranslations(int $itemId, array $insertData) : bool {
        $count = (int)count($insertData);
        $saved = (int)0;

        if(!empty($insertData)) {
            foreach ($insertData as $languageId => $translation) {
                $translationItem = parent::where('rowId', $itemId)->where('languageId', $languageId)->first();

                if(!$translationItem) {
                    $translationItem = new OurWorkTranslation();
                }

                $translationItem = $translationItem->fill([
                    'rowId' => $itemId,
                    'languageId' => $translationItem->languageId,
                    'name' => $translation['name'],
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_h1' => $translation['meta_h1'] ?? null,
                    'meta_keywords' => $translation['meta_keywords'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
                    'set_404' => $translation['set_404'],
                    'set_noindex' => $translation['set_noindex'],
                    'set_nofollow' => $translation['set_nofollow'],
                    'short_description' => $translation['short_description'] ?? null,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved >= $count ? true : false;
    }
}
