<?php
/**
 * User: casperlai
 * Date: 2016/9/2
 * Time: 下午5:47
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Exceptions\NotOptionsException;
use Casperlaitw\LaravelFbMessenger\Exceptions\OptionNotComparedException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\PersistentMenuMessage;

/**
 * Class PersistentMenuCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class PersistentMenuCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:menus {--type=* : Menu type} {--name=* : Menu name} '.
        '{--url=* : Menu url or payload} {--d | delete : Delete the menus}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set menus';

    /**
     * @var array
     */
    private $typeList = [Button::TYPE_POSTBACK, Button::TYPE_WEB];

    /**
     * @var array
     */
    private $buttons = [];

    /**
     * @var array
     */
    private $types = [];

    /**
     * @var array
     */
    private $names = [];

    /**
     * @var array
     */
    private $urls = [];

    /**
     * Execute command
     */
    public function handle()
    {
        // If delete is true, skip to check or valid options.
        if ($this->option('delete')) {
            $this->send();
            return;
        }
        $this->types = $this->option('type');
        $this->names = $this->option('name');
        $this->urls = $this->option('url');

        try {
            if (!$this->valid()) {
                return;
            }
        } catch (OptionNotComparedException $ex) {
            $this->error('The options did not compare.');
            return;
        } catch (NotOptionsException $ex) {
            $this->interactiveMode();
        }

        $this->createButton();
        $this->send();
    }

    /**
     * Send to api
     */
    private function send()
    {
        $persistent = new PersistentMenuMessage($this->buttons);
        if ($this->option('delete')) {
            $persistent->useDelete();
        }
        $this->comment($this->handler->send($persistent)->getResponse());
    }

    /**
     * Valid persistent menu's params
     *
     * @return bool
     * @throws NotOptionsException
     * @throws OptionNotComparedException
     */
    private function valid()
    {
        if (count($this->types) === 0 && count($this->names) === 0 && count($this->urls) === 0) {
            throw new NotOptionsException;
        }
        if (count($this->types) !== count($this->names) || count($this->names) !== count($this->urls)) {
            throw new OptionNotComparedException;
        }
        if (count($this->types) > 5) {
            $this->error('The menu buttons is limitd to 5');
            return false;
        }
        foreach ($this->types as $type) {
            if (!str_contains($type, $this->typeList)) {
                $this->error("Please check type, type only {$this->getTypeListToString()}");
                return false;
            }
        }
        return true;
    }

    /**
     * Create message buttons
     */
    private function createButton()
    {
        foreach ($this->types as $key => $type) {
            $this->buttons[] =new Button($type, $this->names[$key], $this->urls[$key]);
        }
    }

    /**
     * Work on interactive mode
     */
    private function interactiveMode()
    {
        $exit = !$this->option('quiet');
        $count = 0;
        while ($exit) {
            if ($count === 5) {
                $this->comment('The menu buttons is limitd to 5');
                return;
            }

            $this->types[] = $this->anticipate(
                "Input your menu button type [{$this->getTypeListToString()}]",
                $this->typeList
            );
            $this->names[] = $this->ask('Input your menu name');
            $this->urls[] = $this->ask('Input your url or postback');
            $exit = $this->choice('Do you add more menu button?', ['No', 'Yes']) === 'No' ? false : true;
            $count = count($this->types);
            $this->comment("You are creating buttons ({$count}/5)");
        }
    }

    /**
     * Type List to string
     * @return string
     */
    private function getTypeListToString()
    {
        return implode('|', $this->typeList);
    }
}
