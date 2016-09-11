<?php
require __DIR__.'/vendor/autoload.php';

/**
 * User: casperlai
 * Date: 2016/9/11
 * Time: 上午1:59
 */

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = __DIR__.'/project/src');

return new Sami($iterator, array(
    'title'                => 'Laravel Facebook Messenger API',
    'build_dir'            => __DIR__.'/build/',
    'cache_dir'            => __DIR__.'/cache/',
    'default_opened_level' => 1,
));