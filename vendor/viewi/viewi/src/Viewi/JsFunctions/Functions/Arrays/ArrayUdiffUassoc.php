<?php

namespace Viewi\JsFunctions\Functions\Arrays;

use Viewi\JsFunctions\BaseFunctionConverter;
use Viewi\JsTranslator;

class ArrayUdiffUassoc extends BaseFunctionConverter
{
    public static string $name = 'array_udiff_uassoc';

    public static function convert(
        JsTranslator $translator,
        string $code,
        string $indentation
    ): string {
        $jsToInclude = __DIR__ . DIRECTORY_SEPARATOR . 'ArrayUdiffUassoc.js';
        $translator->includeJsFile(self::$name, $jsToInclude);
        return $code . '(';
    }
}
