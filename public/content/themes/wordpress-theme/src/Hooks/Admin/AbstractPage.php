<?php

namespace WordpressTheme\Hooks\Admin;

use Illuminate\Support\Collection;
use WordpressTheme\Hooks\HookInterface;

abstract class AbstractPage implements HookInterface
{
    /**
     * The page's slug. Optional.
     *
     * @var string
     */
    protected $slug;

    /**
     * The page's title. Can be set with __construct(). Required.
     *
     * @var string
     */
    protected $title;

    /**
     * The slug of the parent page. Indicates a sub page. Optional.
     *
     * @var string
     */
    protected $parent;

    /**
     * The admin capability of the user. Defaults to 'manage_options'.
     *
     * @var string
     */
    protected $capability = 'manage_options';

    /**
     * The dash icon css class. Optional.
     *
     * @var string
     */
    protected $dashicon = 'dashicons-admin-generic';

    /**
     * The position of the main item. Optional.
     *
     * @var int|null
     */
    protected $position = null;

    /**
     * Array of class names of the tabs. Optional. Example:
     *
     * [
     *     \Namespace\To\SomeTab::class,
     * ]
     *
     * @var Collection
     */
    protected $tabs;

    /**
     * The path of the template file.
     *
     * @var string
     */
    private $view;

    /**
     * Calls the methods to apply hooks.
     */
    final public function apply()
    {
        $this->slug = $this->slug ? $this->slug : str_slug($this->title);

        $this->tabs = collect($this->tabs)->map(function ($tab) {
            return new $tab($this->slug);
        });

        $this->register();
        $this->_handle();
    }

    /**
     * Registers the page.
     */
    final private function register()
    {
        add_action('admin_menu', function () {
            if ($this->parent) {
                add_submenu_page(
                    $this->parent,
                    $this->title,
                    $this->title,
                    $this->capability,
                    $this->slug,
                    [$this, 'view']
                );
            } else {
                add_menu_page(
                    $this->title,
                    $this->title,
                    $this->capability,
                    $this->slug,
                    [$this, 'view'],
                    $this->dashicon,
                    $this->position
                );
            }
        });
    }

    /**
     * Echos the admin page.
     */
    public function view()
    {
        $class = str_replace(['WordpressTheme\\Hooks\\Admin\\Pages\\', '\\'], '', get_called_class());

        $this->view = kebab_case($class) . ($this->tabs->isNotEmpty() ? '-' . $this->getTab()->slug : '') . '.php';

        require path('/resources/views/admin/_page.php');
    }

    /**
     * Verifies the nonce and calls the handle method of the tab or page.
     */
    public function _handle()
    {
        add_action('admin_init', function () {
            if (!wp_verify_nonce(filter_input(INPUT_POST, '_wpnonce'), $this->slug . '_nonce')) {
                return;
            }

            $tab = $this->getTab();

            if ($tab && method_exists($tab, 'handle')) {
                $tab->handle();
            }

            if (method_exists($this, 'handle')) {
                $this->handle();
            }
        });
    }

    /**
     * Returns the selected tab.
     *
     * @return AbstractTab
     */
    private function getTab()
    {
        return $this->tabs->first(function (AbstractTab $tab) {
            return $tab->slug === filter_input(INPUT_GET, 'tab');
        }, $this->tabs->first());
    }
}
