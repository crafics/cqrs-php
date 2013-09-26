<?php
/*
 * This file is part of the Cqrs package.
 * (c) Manfred Weber <manfred.weber@gmail.com> and Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Test\Integration\Test3;

use Cqrs\Adapter\AdapterTrait;
use Cqrs\Command\CommandInterface;

class Test3CommandHandler
{
    use AdapterTrait;

    public function handleCommand(CommandInterface $command)
    {
        if ($command instanceof Test3Command) {
            $command->edit();
        }
    }  
}