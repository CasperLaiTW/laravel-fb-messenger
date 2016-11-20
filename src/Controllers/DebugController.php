<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/19
 * Time: 下午5:38
 */

namespace Casperlaitw\LaravelFbMessenger\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\Factory;

/**
 * Class DebugController
 * @package Casperlaitw\LaravelFbMessenger\Controllers
 */
class DebugController extends Controller
{
    /**
     * @param Factory $factory
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Factory $factory)
    {
        return $factory->make('laravel-fb-messenger::debug');
    }
}
