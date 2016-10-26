<?php
require __DIR__.'/vendor/autoload.php';

/**
 * User: casperlai
 * Date: 2016/9/11
 * Time: 上午1:59
 */

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = __DIR__.'/project/src');

$versions = GitVersionCollection::create($dir)
    ->add('1.1', '1.1')
    ->add('master', 'Master');

return new Sami($iterator, array(
    'title'                => 'Laravel Facebook Messenger API',
    'versions'             => $versions,
    'build_dir'            => __DIR__.'/build/%version%',
    'cache_dir'            => __DIR__.'/cache/%version%',
    'default_opened_level' => 2,
    'remote_repository' => new GitHubRemoteRepository('CasperLaiTW/laravel-fb-messenger', dirname($dir)),
));
