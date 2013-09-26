<?php
/*
 * This file is part of the Cqrs package.
 * (c) Manfred Weber <manfred.weber@gmail.com> and Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Test\Integration\Test5;

use Cqrs\Message;
use Cqrs\Event\EventInterface;

class Test5Event extends Message implements EventInterface
{
    public $callback;
    protected $edited = false;

    public function edit() {
        $this->edited = true;
    }

    public function isEdited() {
        return $this->edited;
    }
}
