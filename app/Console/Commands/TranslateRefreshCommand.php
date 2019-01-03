<?php
namespace Gaia\Console\Commands;

use Illuminate\Support\Facades\Storage;
use Gaia\Models\PageLanguage;
use Gaia\Services\Language\G11N;

class TranslateRefreshCommand extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh translate file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Begin refresh translate files.');
        $batch = 200;
        $lang2Translations = [];
        $jsLang2Translations = [];

        PageLanguage::with('pageLanguageType')->chunk($batch, function ($pageLanguages) use (&$lang2Translations, &$jsLang2Translations) {
            foreach ($pageLanguages as $pageLanguage) {
                $key = $pageLanguage->pageLanguageType->type . '_' . $pageLanguage->key;
                foreach (G11N::$langId2Code as $langId => $langCode) {
                    $field = 'translate_' . $langCode;
                    $lang2Translations[$langCode][$key] = $pageLanguage->$field;
                    if ($pageLanguage->js_use) {
                        $jsLang2Translations[$langCode][$key] = $pageLanguage->$field;
                    }
                }
            }
        });

        foreach ($lang2Translations as $langCode => $translations) {
            $this->info("Write php {$langCode} translate file.");
            $contents = empty($translations) ? '{}' : json_encode($translations, JSON_PRETTY_PRINT);
            Storage::disk('local')->put("lang/{$langCode}.json", $contents);
        }

        $this->info('Write js translate file.');
        $jsContents = 'var translate_content = ' . (empty($jsLang2Translations) ? '{}' : json_encode($jsLang2Translations, JSON_PRETTY_PRINT)) . ';';
        Storage::disk('local')->put('public/page_translate.js', $jsContents);
        $this->info('Down.');
    }
}
