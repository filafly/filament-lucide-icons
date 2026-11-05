<?php

namespace Filafly\Icons\Lucide;

use Filafly\Icons\IconSet;
use Filafly\Icons\Lucide\Enums\Lucide;
use Filament\Support\Icons\IconManager;

class LucideIcons extends IconSet
{
    protected string $pluginId = 'filafly-filament-lucide-icons';

    protected mixed $iconEnum = Lucide::class;

    protected string $iconPrefix = 'lucide';

    public function __construct()
    {
        // Filament 4.1+ renames the 4.0 tables:: query builder keys to query-builder::
        // when they're registered. Registering both would let the legacy key overwrite
        // an overrideAlias() on the current one, so keep a legacy key only where
        // Filament still treats it as its own alias.
        if (! method_exists(IconManager::class, 'normalizeAlias')) {
            return;
        }

        foreach (array_keys($this->iconMap) as $alias) {
            $normalized = IconManager::normalizeAlias($alias);

            if ($normalized !== $alias && array_key_exists($normalized, $this->iconMap)) {
                unset($this->iconMap[$alias]);
            }
        }
    }

    /**
     * Every Filament 4 and 5 icon alias, mapped to a Lucide icon.
     *
     * Keys are the alias strings rather than the *IconAlias constants, because
     * several constants (rich editor toolbar, multi-factor auth, callouts, query
     * builder) only exist in later 4.x releases. String keys keep the map loadable
     * on every Filament version the package supports.
     */
    protected array $iconMap = [
        // Panels
        'panels::auth.multi-factor.app.actions.disable' => Lucide::ShieldOff,
        'panels::auth.multi-factor.app.actions.disable.modal' => Lucide::ShieldOff,
        'panels::auth.multi-factor.app.actions.disable.notification' => Lucide::ShieldOff,
        'panels::auth.multi-factor.app.actions.regenerate-recovery-codes' => Lucide::RefreshCw,
        'panels::auth.multi-factor.app.actions.regenerate-recovery-codes.modal' => Lucide::RefreshCw,
        'panels::auth.multi-factor.app.actions.regenerate-recovery-codes.notification' => Lucide::KeyRound,
        'panels::auth.multi-factor.app.actions.set-up' => Lucide::ShieldCheck,
        'panels::auth.multi-factor.app.actions.set-up.modal' => Lucide::ShieldCheck,
        'panels::auth.multi-factor.app.actions.set-up.notification' => Lucide::ShieldCheck,
        'panels::auth.multi-factor.email.actions.disable' => Lucide::MailX,
        'panels::auth.multi-factor.email.actions.disable.modal' => Lucide::MailX,
        'panels::auth.multi-factor.email.actions.disable.notification' => Lucide::MailX,
        'panels::auth.multi-factor.email.actions.set-up' => Lucide::MailCheck,
        'panels::auth.multi-factor.email.actions.set-up.modal' => Lucide::MailCheck,
        'panels::auth.multi-factor.email.actions.set-up.notification' => Lucide::MailCheck,
        'panels::global-search.field' => Lucide::Search,
        'panels::pages.dashboard.actions.filter' => Lucide::Funnel,
        'panels::pages.dashboard.navigation-item' => Lucide::House,
        'panels::pages.password-reset.request-password-reset.actions.login' => Lucide::ArrowLeft,
        'panels::pages.password-reset.request-password-reset.actions.login.rtl' => Lucide::ArrowRight,
        'panels::resources.pages.edit-record.navigation-item' => Lucide::SquarePen,
        'panels::resources.pages.manage-related-records.navigation-item' => Lucide::LayoutGrid,
        'panels::resources.pages.view-record.navigation-item' => Lucide::Eye,
        'panels::sidebar.collapse-button' => Lucide::ChevronLeft,
        'panels::sidebar.collapse-button.rtl' => Lucide::ChevronRight,
        'panels::sidebar.expand-button' => Lucide::ChevronRight,
        'panels::sidebar.expand-button.rtl' => Lucide::ChevronLeft,
        'panels::sidebar.group.collapse-button' => Lucide::ChevronUp,
        'panels::sidebar.open-database-notifications-button' => Lucide::Bell,
        'panels::sub-navigation.mobile-menu.button' => Lucide::ChevronDown,
        'panels::tenant-menu.billing-button' => Lucide::CreditCard,
        'panels::tenant-menu.profile-button' => Lucide::Settings,
        'panels::tenant-menu.registration-button' => Lucide::Plus,
        'panels::tenant-menu.toggle-button' => Lucide::ChevronsUpDown,
        'panels::theme-switcher.dark-button' => Lucide::Moon,
        'panels::theme-switcher.light-button' => Lucide::Sun,
        'panels::theme-switcher.system-button' => Lucide::Monitor,
        'panels::topbar.close-sidebar-button' => Lucide::X,
        'panels::topbar.group.toggle-button' => Lucide::ChevronDown,
        'panels::topbar.open-database-notifications-button' => Lucide::Bell,
        'panels::topbar.open-sidebar-button' => Lucide::Menu,
        'panels::user-menu.logout-button' => Lucide::LogOut,
        'panels::user-menu.profile-item' => Lucide::CircleUser,
        'panels::user-menu.toggle-button' => Lucide::ChevronDown,
        'panels::widgets.account.logout-button' => Lucide::LogOut,
        'panels::widgets.filament-info.open-documentation-button' => Lucide::BookOpen,
        'panels::widgets.filament-info.open-github-button' => Lucide::Github,

        // Actions
        'actions::action-group' => Lucide::EllipsisVertical,
        'actions::create-action.grouped' => Lucide::Plus,
        'actions::delete-action' => Lucide::Trash2,
        'actions::delete-action.grouped' => Lucide::Trash2,
        'actions::delete-action.modal' => Lucide::Trash2,
        'actions::detach-action' => Lucide::Unlink,
        'actions::detach-action.modal' => Lucide::Unlink,
        'actions::dissociate-action' => Lucide::Unlink,
        'actions::dissociate-action.modal' => Lucide::Unlink,
        'actions::edit-action' => Lucide::SquarePen,
        'actions::edit-action.grouped' => Lucide::SquarePen,
        'actions::export-action.grouped' => Lucide::Download,
        'actions::force-delete-action' => Lucide::Trash2,
        'actions::force-delete-action.grouped' => Lucide::Trash2,
        'actions::force-delete-action.modal' => Lucide::Trash2,
        'actions::import-action.grouped' => Lucide::Upload,
        'actions::modal.confirmation' => Lucide::TriangleAlert,
        'actions::replicate-action' => Lucide::Copy,
        'actions::replicate-action.grouped' => Lucide::Copy,
        'actions::restore-action' => Lucide::RotateCcw,
        'actions::restore-action.grouped' => Lucide::RotateCcw,
        'actions::restore-action.modal' => Lucide::RotateCcw,
        'actions::view-action' => Lucide::Eye,
        'actions::view-action.grouped' => Lucide::Eye,

        // Forms
        'forms::components.builder.actions.clone' => Lucide::Copy,
        'forms::components.builder.actions.collapse' => Lucide::ChevronUp,
        'forms::components.builder.actions.delete' => Lucide::Trash2,
        'forms::components.builder.actions.edit' => Lucide::SquarePen,
        'forms::components.builder.actions.expand' => Lucide::ChevronDown,
        'forms::components.builder.actions.move-down' => Lucide::ArrowDown,
        'forms::components.builder.actions.move-up' => Lucide::ArrowUp,
        'forms::components.builder.actions.reorder' => Lucide::GripVertical,
        'forms::components.checkbox-list.search-field' => Lucide::Search,
        'forms::components.file-upload.editor.actions.drag-crop' => Lucide::Crop,
        'forms::components.file-upload.editor.actions.drag-move' => Lucide::Move,
        'forms::components.file-upload.editor.actions.flip-horizontal' => Lucide::FlipHorizontal2,
        'forms::components.file-upload.editor.actions.flip-vertical' => Lucide::FlipVertical2,
        'forms::components.file-upload.editor.actions.move-down' => Lucide::CircleArrowDown,
        'forms::components.file-upload.editor.actions.move-left' => Lucide::CircleArrowLeft,
        'forms::components.file-upload.editor.actions.move-right' => Lucide::CircleArrowRight,
        'forms::components.file-upload.editor.actions.move-up' => Lucide::CircleArrowUp,
        'forms::components.file-upload.editor.actions.rotate-left' => Lucide::RotateCcw,
        'forms::components.file-upload.editor.actions.rotate-right' => Lucide::RotateCw,
        'forms::components.file-upload.editor.actions.zoom-100' => Lucide::ScanSearch,
        'forms::components.file-upload.editor.actions.zoom-in' => Lucide::ZoomIn,
        'forms::components.file-upload.editor.actions.zoom-out' => Lucide::ZoomOut,
        'forms::components.key-value.actions.delete' => Lucide::Trash2,
        'forms::components.key-value.actions.reorder' => Lucide::GripVertical,
        'forms::components.modal-table-select.actions.select' => Lucide::MousePointerClick,
        'forms::components.repeater.actions.clone' => Lucide::Copy,
        'forms::components.repeater.actions.collapse' => Lucide::ChevronUp,
        'forms::components.repeater.actions.delete' => Lucide::Trash2,
        'forms::components.repeater.actions.expand' => Lucide::ChevronDown,
        'forms::components.repeater.actions.move-down' => Lucide::ArrowDown,
        'forms::components.repeater.actions.move-up' => Lucide::ArrowUp,
        'forms::components.repeater.actions.reorder' => Lucide::GripVertical,
        'forms::components.rich-editor.panels.custom-block.delete-button' => Lucide::Trash2,
        'forms::components.rich-editor.panels.custom-block.edit-button' => Lucide::SquarePen,
        'forms::components.rich-editor.panels.custom-blocks.close-button' => Lucide::X,
        'forms::components.rich-editor.panels.merge-tags.close-button' => Lucide::X,
        'forms::components.select.actions.create-option' => Lucide::Plus,
        'forms::components.select.actions.edit-option' => Lucide::SquarePen,
        'forms::components.text-input.actions.copy' => Lucide::Copy,
        'forms::components.text-input.actions.hide-password' => Lucide::EyeOff,
        'forms::components.text-input.actions.show-password' => Lucide::Eye,
        'forms::components.toggle-buttons.boolean.false' => Lucide::X,
        'forms::components.toggle-buttons.boolean.true' => Lucide::Check,

        // Forms: rich editor toolbar (Filament's own aliases use a single colon here)
        'forms:components.rich-editor.toolbar.align-center' => Lucide::TextAlignCenter,
        'forms:components.rich-editor.toolbar.align-end' => Lucide::TextAlignEnd,
        'forms:components.rich-editor.toolbar.align-justify' => Lucide::TextAlignJustify,
        'forms:components.rich-editor.toolbar.align-start' => Lucide::TextAlignStart,
        'forms:components.rich-editor.toolbar.attach-files' => Lucide::Paperclip,
        'forms:components.rich-editor.toolbar.blockquote' => Lucide::TextQuote,
        'forms:components.rich-editor.toolbar.bold' => Lucide::Bold,
        'forms:components.rich-editor.toolbar.bullet-list' => Lucide::List,
        'forms:components.rich-editor.toolbar.clear_formatting' => Lucide::RemoveFormatting,
        'forms:components.rich-editor.toolbar.code' => Lucide::Code,
        'forms:components.rich-editor.toolbar.code-block' => Lucide::SquareCode,
        'forms:components.rich-editor.toolbar.custom-blocks' => Lucide::Blocks,
        'forms:components.rich-editor.toolbar.details' => Lucide::ListCollapse,
        'forms:components.rich-editor.toolbar.grid' => Lucide::Columns2,
        'forms:components.rich-editor.toolbar.grid_add_column_after' => Lucide::BetweenVerticalStart,
        'forms:components.rich-editor.toolbar.grid_add_column_before' => Lucide::BetweenVerticalEnd,
        'forms:components.rich-editor.toolbar.grid_delete' => Lucide::Grid2x2X,
        'forms:components.rich-editor.toolbar.grid_delete_column' => Lucide::Grid2x2X,
        'forms:components.rich-editor.toolbar.h1' => Lucide::Heading1,
        'forms:components.rich-editor.toolbar.h2' => Lucide::Heading2,
        'forms:components.rich-editor.toolbar.h3' => Lucide::Heading3,
        'forms:components.rich-editor.toolbar.h4' => Lucide::Heading4,
        'forms:components.rich-editor.toolbar.h5' => Lucide::Heading5,
        'forms:components.rich-editor.toolbar.h6' => Lucide::Heading6,
        'forms:components.rich-editor.toolbar.highlight' => Lucide::Highlighter,
        'forms:components.rich-editor.toolbar.horizontal-rule' => Lucide::Minus,
        'forms:components.rich-editor.toolbar.italic' => Lucide::Italic,
        'forms:components.rich-editor.toolbar.lead' => Lucide::AArrowUp,
        'forms:components.rich-editor.toolbar.link' => Lucide::Link,
        'forms:components.rich-editor.toolbar.merge-tags' => Lucide::Braces,
        'forms:components.rich-editor.toolbar.ordered-list' => Lucide::ListOrdered,
        'forms:components.rich-editor.toolbar.paragraph' => Lucide::Pilcrow,
        'forms:components.rich-editor.toolbar.redo' => Lucide::Redo2,
        'forms:components.rich-editor.toolbar.small' => Lucide::AArrowDown,
        'forms:components.rich-editor.toolbar.strike' => Lucide::Strikethrough,
        'forms:components.rich-editor.toolbar.subscript' => Lucide::Subscript,
        'forms:components.rich-editor.toolbar.superscript' => Lucide::Superscript,
        'forms:components.rich-editor.toolbar.table' => Lucide::Table,
        'forms:components.rich-editor.toolbar.table_add_column_after' => Lucide::BetweenVerticalStart,
        'forms:components.rich-editor.toolbar.table_add_column_before' => Lucide::BetweenVerticalEnd,
        'forms:components.rich-editor.toolbar.table_add_row_after' => Lucide::BetweenHorizontalStart,
        'forms:components.rich-editor.toolbar.table_add_row_before' => Lucide::BetweenHorizontalEnd,
        'forms:components.rich-editor.toolbar.table_delete' => Lucide::Trash2,
        'forms:components.rich-editor.toolbar.table_delete_column' => Lucide::TableColumnsSplit,
        'forms:components.rich-editor.toolbar.table_delete_row' => Lucide::TableRowsSplit,
        'forms:components.rich-editor.toolbar.table_merge_cells' => Lucide::TableCellsMerge,
        'forms:components.rich-editor.toolbar.table_split_cell' => Lucide::TableCellsSplit,
        'forms:components.rich-editor.toolbar.table_toggle_header_cell' => Lucide::Table2,
        'forms:components.rich-editor.toolbar.table_toggle_header_row' => Lucide::Table2,
        'forms:components.rich-editor.toolbar.text-color' => Lucide::Baseline,
        'forms:components.rich-editor.toolbar.underline' => Lucide::Underline,
        'forms:components.rich-editor.toolbar.undo' => Lucide::Undo2,

        // Infolists
        'infolists::components.icon-entry.false' => Lucide::CircleX,
        'infolists::components.icon-entry.true' => Lucide::CircleCheck,

        // Notifications
        'notifications::database.modal.empty-state' => Lucide::BellOff,
        'notifications::notification.close-button' => Lucide::X,
        'notifications::notification.danger' => Lucide::CircleAlert,
        'notifications::notification.info' => Lucide::Info,
        'notifications::notification.success' => Lucide::CircleCheck,
        'notifications::notification.warning' => Lucide::TriangleAlert,

        // Query builder (Filament 4.0 used the tables:: prefix for the constraints)
        'query-builder::add-rule-action' => Lucide::Plus,
        'query-builder::constraints.boolean' => Lucide::ToggleLeft,
        'query-builder::constraints.date' => Lucide::Calendar,
        'query-builder::constraints.number' => Lucide::Hash,
        'query-builder::constraints.relationship' => Lucide::Link,
        'query-builder::constraints.select' => Lucide::ChevronsUpDown,
        'query-builder::constraints.text' => Lucide::Type,
        'query-builder::or-group.add-group-action' => Lucide::ListPlus,
        'query-builder::or-group.block' => Lucide::Layers,
        'tables::filters.query-builder.constraints.boolean' => Lucide::ToggleLeft,
        'tables::filters.query-builder.constraints.date' => Lucide::Calendar,
        'tables::filters.query-builder.constraints.number' => Lucide::Hash,
        'tables::filters.query-builder.constraints.relationship' => Lucide::Link,
        'tables::filters.query-builder.constraints.select' => Lucide::ChevronsUpDown,
        'tables::filters.query-builder.constraints.text' => Lucide::Type,

        // Schemas
        'schema::components.callout.danger' => Lucide::CircleAlert,
        'schema::components.callout.info' => Lucide::Info,
        'schema::components.callout.success' => Lucide::CircleCheck,
        'schema::components.callout.warning' => Lucide::TriangleAlert,
        'schema::components.tabs.dropdown-trigger-button' => Lucide::ChevronDown,
        'schema::components.tabs.more-tabs-button' => Lucide::Ellipsis,
        'schema::components.wizard.completed-step' => Lucide::Check,

        // Support
        'badge.delete-button' => Lucide::X,
        'breadcrumbs.separator' => Lucide::ChevronRight,
        'breadcrumbs.separator.rtl' => Lucide::ChevronLeft,
        'modal.close-button' => Lucide::X,
        'pagination.first-button' => Lucide::ChevronsLeft,
        'pagination.first-button.rtl' => Lucide::ChevronsRight,
        'pagination.last-button' => Lucide::ChevronsRight,
        'pagination.last-button.rtl' => Lucide::ChevronsLeft,
        'pagination.next-button' => Lucide::ChevronRight,
        'pagination.next-button.rtl' => Lucide::ChevronLeft,
        'pagination.previous-button' => Lucide::ChevronLeft,
        'pagination.previous-button.rtl' => Lucide::ChevronRight,
        'section.collapse-button' => Lucide::ChevronUp,

        // Tables
        'tables::actions.column-manager' => Lucide::Columns3Cog,
        'tables::actions.disable-reordering' => Lucide::Check,
        'tables::actions.enable-reordering' => Lucide::ArrowDownUp,
        'tables::actions.filter' => Lucide::Funnel,
        'tables::actions.group' => Lucide::LayoutList,
        'tables::actions.open-bulk-actions' => Lucide::EllipsisVertical,
        'tables::columns.collapse-button' => Lucide::ChevronDown,
        'tables::columns.icon-column.false' => Lucide::CircleX,
        'tables::columns.icon-column.true' => Lucide::CircleCheck,
        'tables::empty-state' => Lucide::X,
        'tables::filters.remove-all-button' => Lucide::X,
        'tables::grouping.collapse-button' => Lucide::ChevronUp,
        'tables::header-cell.sort-asc-button' => Lucide::ChevronUp,
        'tables::header-cell.sort-button' => Lucide::ChevronsUpDown,
        'tables::header-cell.sort-desc-button' => Lucide::ChevronDown,
        'tables::reorder.handle' => Lucide::GripVertical,
        'tables::search-field' => Lucide::Search,

        // Widgets
        'widgets::chart-widget.empty-state' => Lucide::ChartNoAxesColumn,
        'widgets::chart-widget.filter' => Lucide::Funnel,
    ];
}
