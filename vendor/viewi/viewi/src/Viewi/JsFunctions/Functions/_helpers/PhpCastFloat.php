<?php

namespace Viewi\JsFunctions\Functions\_helpers;

use Viewi\JsFunctions\BaseFunctionConverter;
use Viewi\JsTranslator;

class PhpCastFloat extends BaseFunctionConverter
{
    public static string $name = '_php_cast_float';

    public static function convert(
        JsTranslator $translator,
        string $code,
        string $indentation
    ): string {
        $jsToInclude = __DIR__ . DIRECTORY_SEPARATOR . 'PhpCastFloat.js';
        $translator->includeJsFile(self::$name, $jsToInclude);
        return $code . '(';
    }
}
