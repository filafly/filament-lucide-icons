<?php

/**
 * Regenerates src/Enums/Lucide.php from the SVGs shipped by mallardduck/blade-lucide-icons.
 *
 * Run after `composer update` picks up a new blade-lucide-icons release:
 *   php bin/generate-icon-cases.php
 */
$root = dirname(__DIR__);
$svgPath = "{$root}/vendor/mallardduck/blade-lucide-icons/resources/svg/icons";

if (! is_dir($svgPath)) {
    fwrite(STDERR, "SVG directory not found: {$svgPath}. Run composer install first.\n");
    exit(1);
}

$names = array_map(fn ($file) => basename($file, '.svg'), glob("{$svgPath}/*.svg"));
sort($names);

$cases = [];
foreach ($names as $name) {
    $parts = array_map('ucfirst', array_filter(preg_split('/[^a-zA-Z0-9]+/', $name), 'strlen'));
    $caseName = implode('', $parts);

    if (preg_match('/^[0-9]/', $caseName)) {
        $caseName = 'Icon'.$caseName;
    }

    if (isset($cases[$caseName])) {
        fwrite(STDERR, "Duplicate case name {$caseName} for {$name} and {$cases[$caseName]}\n");
        exit(1);
    }

    $cases[$caseName] = $name;
}

$lines = implode("\n", array_map(
    fn ($case, $name) => "    case {$case} = '{$name}';",
    array_keys($cases),
    $cases,
));

$enum = <<<PHP
<?php

namespace Filafly\Icons\Lucide\Enums;

use Filament\Support\Contracts\ScalableIcon;
use Filament\Support\Enums\IconSize;

enum Lucide: string implements ScalableIcon
{
{$lines}

    public function getIconForSize(IconSize \$size): string
    {
        return match (\$size) {
            default => "lucide-\$this->value",
        };
    }
}

PHP;

file_put_contents("{$root}/src/Enums/Lucide.php", $enum);

echo 'Generated '.count($cases)." Lucide cases\n";
