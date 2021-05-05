<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslations extends Model {

    public $timestamps = false;

    protected $fillable = [
        'menuItemId',
        'label',
        'languageId'
    ];

    /**
     * Создаем переводы страницы
     * @param int $itemID
     * @param array $insertData
     * @return bool
     */
    protected function createTranslations(int $itemId, array $insertData) : bool {
        $count = (int)count($insertData);
        $saved = (int)0;

        if(!empty($insertData)) {
            foreach ($insertData as $languageId => $translation) {
                $translationItem = new MenuItemTranslations();

                $translationItem = $translationItem->fill([
                    'menuItemId' => $itemId,
                    'label' => $translation['label'],
                    'languageId' => $languageId,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved == $count;
    }

    /**
     * Обновляем переводы страницы
     * @param int $itemId
     * @param array $insertData
     * @return bool
     */
    protected function updateTranslations(int $itemId, array $insertData) : bool {
        $count = (int)count($insertData);
        $saved = (int)0;

        if(!empty($insertData)) {
            foreach ($insertData as $languageId => $translation) {
                $translationItem = parent::where('menuItemId', $itemId)->where('languageId', $languageId)->first();

                if(!$translationItem) {
                    $translationItem = new MenuItemTranslations();
                }

                $translationItem = $translationItem->fill([
                    'menuItemId' => $itemId,
                    'label' => $translation['label'],
                    'languageId' => $languageId,
                ]);

                if($translationItem->save()) {
                    $saved += 1;
                }
            }
        }

        return $saved >= $count ? true : false;
    }
}
