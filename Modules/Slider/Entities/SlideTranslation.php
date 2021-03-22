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

    protected function createTranslations(int $itemID, array $insertData) : bool {
        $count = (int)count($insertData);
        $saved = (int)0;

        if(!empty($insertData)) {
            foreach ($insertData as $languageId => $translation) {
                $translationItem = new SlideTranslation();

                $translationItem = $translationItem->fill([
                    'rowId' => $itemID,
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

}
