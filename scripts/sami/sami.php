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
    ->in($dir = __DIR__.'/../../src');

$versions = GitVersionCollection::create($dir)
    ->add('sami', 'sami');

return new Sami($iterator, array(
    'versions'             => $versions,
    'title'                => 'Laravel Facebook Messenger API',
    'build_dir'            => __DIR__.'/build/sf2/%version%',
    'cache_dir'            => __DIR__.'/cache/sf2/%version%',
    'default_opened_level' => 2,
));