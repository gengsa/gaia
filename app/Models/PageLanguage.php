<?php
namespace Gaia\Models;

class PageLanguage extends ModelBase
{
    protected $table = 'page_language';

    /**
     * @return PageLanguageType
     */
    public function pageLanguageType()
    {
        return $this->belongsTo('Gaia\Models\PageLanguageType', 'type_id');
    }
}
