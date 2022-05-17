<?php
namespace App\Tests;

use RuntimeException;
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

    public function test_play() {
        $rock = 1;
        $paper = 2;
        $scissors = 3;

        $round = Game::play($rock, $rock);
        $this->assertEquals([
            'result' => 'Égalité',
            'signs' => [
                'Jules' => $rock,
                'Flavien' => $rock,
            ]
        ], $round);

        $round = Game::play($rock, $paper);
        $this->assertEquals([
            'result' => 'Flavien',
            'signs' => [
                'Jules' => $rock,
                'Flavien' => $paper,
            ]
        ], $round);

        $round = Game::play($rock, $scissors);
        $this->assertEquals([
            'result' => 'Jules',
            'signs' => [
                'Jules' => $rock,
                'Flavien' => $scissors,
            ]
        ], $round);

        $round = Game::play($paper, $paper);
        $this->assertEquals([
            'result' => 'Égalité',
            'signs' => [
                'Jules' => $paper,
                'Flavien' => $paper,
            ]
        ], $round);

        $round = Game::play($paper, $rock);
        $this->assertEquals([
            'result' => 'Jules',
            'signs' => [
                'Jules' => $paper,
                'Flavien' => $rock,
            ]
        ], $round);

        $round = Game::play($paper, $scissors);
        $this->assertEquals([
            'result' => 'Flavien',
            'signs' => [
                'Jules' => $paper,
                'Flavien' => $scissors,
            ]
        ], $round);

        $round = Game::play($scissors, $scissors);
        $this->assertEquals([
            'result' => 'Égalité',
            'signs' => [
                'Jules' => $scissors,
                'Flavien' => $scissors,
            ]
        ], $round);

        $round = Game::play($scissors, $rock);
        $this->assertEquals([
            'result' => 'Flavien',
            'signs' => [
                'Jules' => $scissors,
                'Flavien' => $rock,
            ]
        ], $round);

        $round = Game::play($scissors, $paper);
        $this->assertEquals([
            'result' => 'Jules',
            'signs' => [
                'Jules' => $scissors,
                'Flavien' => $paper,
            ]
        ], $round);
    }
    
    public function test_cant_play() {
        $this->expectException(RuntimeException::class);
        Game::play(4, 5);
    }
}