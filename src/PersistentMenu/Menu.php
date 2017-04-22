<?php

namespace Casperlaitw\LaravelFbMessenger\PersistentMenu;

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\UrlButton;
use Closure;

/**
 * Class Menu
 * @package Casperlaitw\LaravelFbMessenger\PersistentMenu
 */
class Menu
{
    /**
     * @var array
     */
    public $menus = [];

    /**
     * @var array
     */
    protected $stack = [];

    /**
     * Get all menus
     *
     * @return array
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Menu is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->menus);
    }

    /**
     * Disable input
     */
    public function disableInput()
    {
        $this->createMenu(['composer_input_disabled' => true]);
    }

    /**
     * Create postback menu
     *
     * @param $text
     * @param string $payload
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException
     */
    public function postback($text, $payload = '')
    {
        $this->createMenu([
            'call_to_actions' => [
                (new Button(Button::TYPE_POSTBACK, $text, $payload))->toData(),
            ],
        ]);
    }

    /**
     * @param array $args
     */
    public function webUrl(...$args)
    {
        if (count($args) === 1 && $args[0] instanceof UrlButton) {
            $this->createMenu([
                'call_to_actions' => [
                    $args[0]->toData(),
                ],
            ]);
        } else {
            $this->createMenu([
                'call_to_actions' => [
                    (new UrlButton($args[0], $args[1]))->toData(),
                ],
            ]);
        }
    }

    /**
     * Nested menu
     *
     * @param $title
     * @param $menus
     */
    public function nested($title, $menus)
    {
        $nested = [
            'title' => $title,
            'type' => 'nested',
            'call_to_actions' => [],
        ];
        $this->stack[] = $nested;

        $this->loadMenus($menus);
        $this->createMenu(['call_to_actions' => [array_pop($this->stack)]]);
    }

    /**
     * Set locale menu
     *
     * @param $locale
     * @param $menus
     */
    public function locale($locale, $menus)
    {
        $this->stack[] = [
            'locale' => $locale,
        ];

        $this->loadMenus($menus);

        $this->menus[] = array_pop($this->stack);
    }

    /**
     * Load menu
     *
     * @param $menus
     */
    protected function loadMenus($menus)
    {
        if ($menus instanceof Closure) {
            $menus($this);
        }
    }

    /**
     * Create menu
     *
     * @param $menu
     */
    protected function createMenu($menu)
    {
        $this->mergeWithLastStack($menu);
    }

    /**
     * Merge menus to last menu stack
     *
     * @param $menu
     */
    protected function mergeWithLastStack($menu)
    {
        $stack = array_pop($this->stack);
        $this->stack[] = array_merge_recursive($stack, $menu);
    }
}
