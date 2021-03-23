<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model {
    public $timestamps = false;

    protected $fillable = [
        'heading_text',
        'description',
        'rowId',
        'languageId'
    ];

    /**
     * Создаем переводы слайда
     * @param int $itemID
     * @param array $insertData
     * @return bool
     */
    protected function createTranslations(int $itemId, array $insertData) : bool {
        $count = (int)count($insertData);
        $saved = (int)0;

        if(!empty($insertData)) {
            foreach ($insertData as $languageId => $translation) {
                $translationItem = new SlideTranslation();

                $translationItem = $translationItem->fill([
                    'rowId' => $itemId,
                    'languageId' => $languageId,
                    'heading_text' => $translation['heading_text'],
                    'description' => $translation['description'] ?? null,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved == $count;
    }

    /**
     * Обновляем переводы слайда
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
                    $translationItem = new SlideTranslation();
                }

                $translationItem = $translationItem->fill([
                    'rowId' => $itemId,
                    'languageId' => $translationItem->languageId,
                    'heading_text' => $translation['heading_text'],
                    'description' => $translation['description'] ?? null,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved >= $count ? true : false;
    }
}
