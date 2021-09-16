<?php

namespace Tests\Feature\OCR;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Assert as PHPUnit;

class OcrTest extends TestCase
{

    /** ****************** OCR Helpers ****************** */


    /**
     * Test get supported languages
     *
     * @return void
     */
    public function test_get_supported_languages()
    {
        $ocr = new \App\Modules\OCR\OCR();

        $lang = $ocr->supportedLanguages();

        PHPUnit::assertContains(
            'eng',
            $lang,
        );

    }


    /** ****************** OCR ****************** */


    /**
     * Test get supported languages
     *
     * @return void
     */
    public function test_scan_document()
    {
        $ocr = new \App\Modules\OCR\OCR();

        $location = $ocr->image(__DIR__ . '/test.png')->process('test.txt');

        PHPUnit::assertEquals(
            "/Users/mark.fluehmann/Documents/60.Technik/Code/cerbo/storage/app/ocr/test.txt",
            $location,
        );

        $content = file_get_contents($location);

        PHPUnit::assertTrue(
            strpos($content, 'Bundesrat') > 0
        );

    }
}

