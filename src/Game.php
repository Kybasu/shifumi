<?php

namespace Kybasu\Shifumi;

const PIERRE = 1;
const FEUILLE = 2;
const CISEAUX = 3;


abstract class Game {

    public static function getSign(): int {
        return random_int(1, 3);
    }

    public static function translateSign($sign): string {
        return match ($sign) {
            1 => "Pierre",
            2 => "Feuille",
            3 => "Ciseaux",
            default => "",
        };
    }

    public static function play($signJules, $signFlavien): array {
        $signs = [
            'Jules' => $signJules,
            'Flavien' => $signFlavien,
        ];

        if ($signs['Jules'] === $signs['Flavien']) {
            return [
                'result' => 'Égalité',
                'signs' => $signs,
            ];
        }
        if (($signs['Jules'] === FEUILLE && $signs['Flavien'] === PIERRE) || ($signs['Jules'] === CISEAUX && $signs['Flavien'] === FEUILLE) || ($signs['Jules'] === PIERRE && $signs['Flavien'] === CISEAUX)) {
            return [
                'result' => 'Jules',
                'signs' => $signs,
            ];
        }
        return [
            'result' => 'Flavien',
            'signs' => $signs,
        ];
    }
}