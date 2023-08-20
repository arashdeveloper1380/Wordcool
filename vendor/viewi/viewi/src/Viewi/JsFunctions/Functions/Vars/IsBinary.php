<?php

namespace Viewi\JsFunctions\Functions\Vars;

use Viewi\JsFunctions\BaseFunctionConverter;
use Viewi\JsTranslator;

class IsBinary extends BaseFunctionConverter
{
    public static string $name = 'is_binary';

    public static function convert(
        JsTranslator $translator,
        string $code,
        string $indentation
    ): string {
        $jsToInclude = __DIR__ . DIRECTORY_SEPARATOR . 'IsBinary.js';
        $translator->includeJsFile(self::$name, $jsToInclude);
        return $code . '(';
    }
}
