<?php

namespace Filafly\Icons\Lucide\Tests;

use BladeUI\Icons\Factory;
use Filafly\Icons\Lucide\Enums\Lucide;
use Filafly\Icons\Lucide\LucideIcons;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Enums\IconSize;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\IconManager;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionClass;

class LucideIconsTest extends TestCase
{
    /**
     * Every alias Filament defines in its *IconAlias classes, read from the installed version.
     *
     * @return array<string, string> constant => alias
     */
    public static function filamentAliases(): array
    {
        $aliases = [];

        foreach (glob(dirname(__DIR__).'/vendor/filament/*/src/View/*IconAlias.php') as $file) {
            preg_match('/^namespace\s+([^;]+);/m', file_get_contents($file), $matches);
            $class = $matches[1].'\\'.basename($file, '.php');

            foreach ((new ReflectionClass($class))->getConstants() as $name => $alias) {
                $aliases[class_basename($class).'::'.$name] = $alias;
            }
        }

        return $aliases;
    }

    /**
     * Filament's own alias normalization, or the alias unchanged on 4.0 and 4.1,
     * which have no normalizeAlias() and no renamed keys.
     */
    private static function normalize(string $alias): string
    {
        return method_exists(IconManager::class, 'normalizeAlias')
            ? IconManager::normalizeAlias($alias)
            : $alias;
    }

    /** @return array<string, string> */
    private function iconMap(): array
    {
        $property = (new ReflectionClass(LucideIcons::class))->getProperty('iconMap');

        return $property->getValue(new LucideIcons);
    }

    public function test_it_finds_filaments_alias_classes(): void
    {
        $this->assertGreaterThan(150, count(self::filamentAliases()));
    }

    public function test_every_filament_alias_is_mapped(): void
    {
        $mapped = array_map(self::normalize(...), array_keys($this->iconMap()));

        $missing = array_filter(
            self::filamentAliases(),
            fn (string $alias): bool => ! in_array(self::normalize($alias), $mapped, true),
        );

        $this->assertSame([], $missing, 'Filament aliases with no Lucide icon: '.implode(', ', array_keys($missing)));
    }

    public function test_every_mapped_icon_is_a_lucide_enum_case(): void
    {
        foreach ($this->iconMap() as $alias => $icon) {
            $this->assertInstanceOf(Lucide::class, $icon, "{$alias} is not mapped to a Lucide case");
        }
    }

    public function test_every_enum_case_has_an_svg_in_blade_lucide_icons(): void
    {
        $factory = app(Factory::class);
        $missing = [];

        foreach (Lucide::cases() as $case) {
            try {
                $factory->svg($case->getIconForSize(IconSize::Medium));
            } catch (\Throwable) {
                $missing[] = $case->value;
            }
        }

        $this->assertSame([], $missing, 'Enum cases with no SVG: '.implode(', ', $missing));
    }

    public function test_enum_cases_resolve_to_the_lucide_blade_prefix(): void
    {
        $this->assertSame('lucide-trash-2', Lucide::Trash2->getIconForSize(IconSize::Small));
        $this->assertSame('lucide-arrow-down-0-1', Lucide::ArrowDown01->getIconForSize(IconSize::Large));
    }

    public function test_registering_replaces_filaments_icons(): void
    {
        LucideIcons::make()->registerIcons();

        $this->assertSame('lucide-search', FilamentIcon::resolve('panels::global-search.field'));
        $this->assertSame('lucide-trash-2', FilamentIcon::resolve('actions::delete-action'));
        $this->assertSame('lucide-bold', FilamentIcon::resolve('forms:components.rich-editor.toolbar.bold'));
        $this->assertSame('lucide-type', FilamentIcon::resolve('tables::filters.query-builder.constraints.text'));

        foreach (self::filamentAliases() as $constant => $alias) {
            $this->assertNotNull(FilamentIcon::resolve($alias), "{$constant} resolves to nothing");
            $this->assertStringStartsWith('lucide-', FilamentIcon::resolve($alias), "{$constant} is not a Lucide icon");
        }
    }

    public function test_the_plugin_registers_icons_when_a_panel_boots(): void
    {
        $panel = Panel::make()->id('admin')->default()->plugin(LucideIcons::make());
        Filament::registerPanel($panel);

        $this->assertSame('filafly-filament-lucide-icons', $panel->getPlugin('filafly-filament-lucide-icons')->getId());

        $panel->getPlugin('filafly-filament-lucide-icons')->boot($panel);

        $this->assertSame('lucide-house', FilamentIcon::resolve('panels::pages.dashboard.navigation-item'));
    }

    public function test_aliases_and_icons_can_be_overridden(): void
    {
        LucideIcons::make()
            ->overrideAlias('actions::delete-action', Lucide::Eraser)
            ->overrideIcons([Lucide::Search->value => Lucide::TextSearch])
            ->registerIcons();

        $this->assertSame('lucide-eraser', FilamentIcon::resolve('actions::delete-action'));
        $this->assertSame('lucide-trash-2', FilamentIcon::resolve('actions::force-delete-action'));
        $this->assertSame('lucide-text-search', FilamentIcon::resolve('tables::search-field'));
    }

    public function test_legacy_query_builder_keys_do_not_overwrite_an_override(): void
    {
        LucideIcons::make()
            ->overrideAlias('query-builder::constraints.text', Lucide::Star)
            ->registerIcons();

        $this->assertSame('lucide-star', FilamentIcon::resolve('query-builder::constraints.text'));
        $this->assertSame('lucide-hash', FilamentIcon::resolve('query-builder::constraints.number'));
    }

    public function test_legacy_query_builder_keys_are_kept_only_where_filament_uses_them(): void
    {
        $map = $this->iconMap();
        $legacy = 'tables::filters.query-builder.constraints.text';

        if (self::normalize($legacy) === $legacy) {
            $this->assertArrayHasKey($legacy, $map, 'Filament without the renamed keys still needs the legacy one');
        } else {
            $this->assertArrayNotHasKey($legacy, $map, 'The legacy key would overwrite the current one');
            $this->assertArrayHasKey(self::normalize($legacy), $map);
        }
    }

    public function test_rich_editor_toolbar_aliases_are_mapped(): void
    {
        // Filament's own toolbar constants (only in later 4.x releases), so a renamed
        // prefix shows up here instead of silently falling back to Heroicons.
        $toolbar = array_filter(
            self::filamentAliases(),
            fn (string $constant): bool => str_contains($constant, 'RICH_EDITOR_TOOLBAR_'),
            ARRAY_FILTER_USE_KEY,
        );

        if ($toolbar === []) {
            $this->markTestSkipped('This Filament version has no rich editor toolbar aliases.');
        }

        LucideIcons::make()->registerIcons();

        foreach ($toolbar as $constant => $alias) {
            $this->assertArrayHasKey($alias, $this->iconMap(), "{$constant} is not in the icon map");
            $this->assertStringStartsWith('lucide-', FilamentIcon::resolve($alias), "{$constant} is not a Lucide icon");
        }
    }

    #[DataProvider('styleCalls')]
    public function test_lucide_has_a_single_style(callable $call): void
    {
        $this->assertSame([], LucideIcons::make()->getAvailableStyleNames());

        $this->expectException(InvalidArgumentException::class);

        $call(LucideIcons::make());
    }

    public static function styleCalls(): array
    {
        return [
            'style()' => [fn (LucideIcons $icons) => $icons->style('solid')],
            'overrideStyleForAlias()' => [fn (LucideIcons $icons) => $icons->overrideStyleForAlias('tables::search-field', 'solid')],
        ];
    }
}
