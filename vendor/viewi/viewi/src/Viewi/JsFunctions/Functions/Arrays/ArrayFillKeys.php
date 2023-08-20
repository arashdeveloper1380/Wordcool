<?php

namespace Viewi\JsFunctions\Functions\Arrays;

use Viewi\JsFunctions\BaseFunctionConverter;
use Viewi\JsTranslator;

class ArrayFillKeys extends BaseFunctionConverter
{
    public static string $name = 'array_fill_keys';

    public static function convert(
        JsTranslator $translator,
        string $code,
        string $indentation
    ): string {
        $jsToInclude = __DIR__ . DIRECTORY_SEPARATOR . 'ArrayFillKeys.js';
        $translator->includeJsFile(self::$name, $jsToInclude);
        return $code . '(';
    }
}
