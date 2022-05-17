<?php
namespace App\Tests;

use Kybasu\Shifumi\Game;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    public function test_getSign(): void {
        $sign = Game::getSign();
        $this->assertContains($sign, ['1', '2', '3']);
    }
}