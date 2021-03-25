<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model {

    public $timestamps = false;

    protected $fillable = [
        'rowId',
        'name',
        'languageId',
        'content',
        'meta_h1',
        'meta_title',
        'meta_keywords',
        'meta_description'
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
                $translationItem = new ProjectTranslation();

                $translationItem = $translationItem->fill([
                    'rowId' => $itemId,
                    'languageId' => $languageId,
                    'name' => $translation['name'],
                    'content' => $translation['content'] ?? null,
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_h1' => $translation['meta_h1'] ?? null,
                    'meta_keywords' => $translation['meta_keywords'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
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
                    $translationItem = new ProjectTranslation();
                }

                $translationItem = $translationItem->fill([
                    'rowId' => $itemId,
                    'languageId' => $translationItem->languageId,
                    'name' => $translation['name'],
                    'content' => $translation['content'] ?? null,
                    'meta_title' => $translation['meta_title'] ?? null,
                    'meta_h1' => $translation['meta_h1'] ?? null,
                    'meta_keywords' => $translation['meta_keywords'] ?? null,
                    'meta_description' => $translation['meta_description'] ?? null,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved >= $count ? true : false;
    }
}
