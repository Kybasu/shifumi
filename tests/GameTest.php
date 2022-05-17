<?php
namespace App\Tests;

use Kybasu\Shifumi\Game;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    public function test_getSign(): void {
        $sign = Game::getSign();
        $this->assertContains($sign, [1, 2, 3]);
    }

    public function test_translateSign(): void {
        $sign1 = Game::translateSign(1);
        $this->assertEquals('Pierre', $sign1);
        $sign2 = Game::translateSign(2);
        $this->assertEquals('Feuille', $sign2);
        $sign3 = Game::translateSign(3);
        $this->assertEquals('Ciseaux', $sign3);
        $sign = Game::translateSign(random_int(4, 100));
        $this->assertEquals('', $sign);
    }
}