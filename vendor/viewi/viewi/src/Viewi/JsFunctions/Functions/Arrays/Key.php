<?php

namespace Viewi\JsFunctions\Functions\Arrays;

use Viewi\JsFunctions\BaseFunctionConverter;
use Viewi\JsTranslator;

class Key extends BaseFunctionConverter
{
    public static string $name = 'key';

    public static function convert(
        JsTranslator $translator,
        string $code,
        string $indentation
    ): string {
        $jsToInclude = __DIR__ . DIRECTORY_SEPARATOR . 'Key.js';
        $translator->includeJsFile(self::$name, $jsToInclude);
        return $code . '(';
    }
}
