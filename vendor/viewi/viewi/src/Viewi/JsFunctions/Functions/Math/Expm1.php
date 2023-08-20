<?php

namespace Viewi\JsFunctions\Functions\Math;

use Viewi\JsFunctions\BaseFunctionConverter;
use Viewi\JsTranslator;

class Expm1 extends BaseFunctionConverter
{
    public static string $name = 'expm1';

    public static function convert(
        JsTranslator $translator,
        string $code,
        string $indentation
    ): string {
        $jsToInclude = __DIR__ . DIRECTORY_SEPARATOR . 'Expm1.js';
        $translator->includeJsFile(self::$name, $jsToInclude);
        return $code . '(';
    }
}
