# Changelog

## v1.0.2 - 2026-11-06

- Docs only: the README no longer compares this package with other Lucide packages. It now says plainly that the package registers Blade's `lucide` icon prefix, so any other package registering that prefix has to be removed first.
- No code changes.

## v1.0.1 - 2026-11-05

- No change to which icons you get.
- The plugin now calls the parent constructor, so it keeps working if Filament Icons adds one.
- Tests run on Filament 4 releases before 4.2 (no `IconManager::normalizeAlias()`), and check that every rich editor toolbar alias is a Lucide icon.

## v1.0.0 - 2026-11-05

- First release: Lucide icons for every Filament 4 and 5 UI icon alias (223 in Filament 5.11), registered with `LucideIcons::make()`.
- `Lucide` enum with all 2,287 Lucide icons from mallardduck/blade-lucide-icons 2.x.
- `overrideAlias()`, `overrideAliases()`, `overrideIcon()` and `overrideIcons()` from Filament Icons.
