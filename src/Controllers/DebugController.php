<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/19
 * Time: 下午5:38
 */

namespace Casperlaitw\LaravelFbMessenger\Controllers;

use Illuminate\Routing\Controller;

/**
 * Class DebugController
 * @package Casperlaitw\LaravelFbMessenger\Controllers
 */
class DebugController extends Controller
{
    /**
     *
     */
    public function index()
    {
        return view('laravel-fb-messenger::debug');
    }
}