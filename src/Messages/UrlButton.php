<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/14
 * Time: 下午11:26
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

/**
 * Class UrlButton
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class UrlButton extends Button
{

    /**
     * Compact height ratio
     */
    const TYPE_COMPACT = 'compact';

    /**
     * Tall height ratio
     */
    const TYPE_TALL = 'tall';

    /**
     * Full height ratio
     */
    const TYPE_FULL = 'full';

    /**
     * Use messenger
     *
     * @var bool
     */
    private $messenger = false;

    /**
     * Webview height ratio
     *
     * @var string
     */
    private $ratio;

    /**
     * Fallback url
     *
     * @var string
     */
    private $fallback;

    /**
     * User can share in the webiview
     *
     * @var bool
     */
    private $share = true;

    /**
     * UrlButton constructor.
     * @param $title
     * @param $url
     */
    public function __construct($title, $url)
    {
        parent::__construct(self::TYPE_WEB, $title, $url);
    }

    /**
     * Use messenger extensions
     *
     * @return $this
     */
    public function useMessengerExtensions()
    {
        $this->messenger = true;

        return $this;
    }

    /**
     * Set webview height ratio
     *
     * @param $value
     *
     * @return $this
     */
    public function setWebviewHeightRatio($value)
    {
        $this->ratio = $value;

        return $this;
    }

    /**
     * Set fallback url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setFallbackUrl($url)
    {
        $this->fallback = $url;

        return $this;
    }

    /**
     * Disable share
     *
     * @return $this
     */
    public function disableShare()
    {
        $this->share = false;

        return $this;
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        $data = [];
        if ($this->messenger) {
            $data['messenger_extensions'] = true;
        }

        if ($this->ratio !== null) {
            $data['webview_height_ratio'] = $this->ratio;
        }

        if ($this->fallback !== null) {
            $data['fallback_url'] = $this->fallback;
        }

        if (!$this->share) {
            $data['webview_share_button'] = 'hide';
        }

        return array_merge(parent::toData(), $data);
    }
}
