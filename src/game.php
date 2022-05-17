<?php

const PIERRE = 1;
const FEUILLE = 2;
const CISEAUX = 3;

abstract class Game {

    static function getSign(): int
    {
        return mt_rand(1, 3);
    }

    static function translateSign($sign): string
    {
        return match ($sign) {
            1 => "Pierre",
            2 => "Feuille",
            3 => "Ciseaux",
            default => "",
        };
    }

    static function play($signJules, $signFlavien) {
        $signs = [
            'Jules' => $signJules,
            'Flavien' => $signFlavien,
        ];

        if($signs['Jules'] === $signs['Flavien']) {
            return [
                'result' => 'Égalité',
                'signs' => $signs,
            ];
        }
        if(($signs['Jules'] === FEUILLE && $signs['Flavien'] === PIERRE) || ($signs['Jules'] === CISEAUX && $signs['Flavien'] === FEUILLE) ||($signs['Jules'] === PIERRE && $signs['Flavien'] === CISEAUX)) {
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


$scores = [
    "Jules" => 0,
    "Flavien" => 0
];

echo "------ Début du jeu ------" . PHP_EOL;

while($scores['Jules'] !== 2 && $scores['Flavien'] !== 2) {
    echo "---------- Nouvelle manche ----------" . PHP_EOL;
    $result = Game::play(Game::getSign(), Game::getSign());

    echo "Jules : " . Game::translateSign($result['signs']['Jules']) . PHP_EOL;
    echo "Flavien : " . Game::translateSign($result['signs']['Flavien']) . PHP_EOL;
    switch ($result['result']) {
        case "Jules":
        case "Flavien":
            echo $result['result'] . " gagne la manche !" . PHP_EOL;
            $scores[$result['result']]++;
            break;
        default:
            echo "Égalité !" . PHP_EOL;
            break;
    }
}

echo "---------- Fin du jeu ----------" . PHP_EOL;
echo "Jules a gagné " . $scores['Jules'] . " fois" . PHP_EOL;
echo "Flavien a gagné " . $scores['Flavien'] . " fois" . PHP_EOL;
$winner = $scores['Jules'] > $scores['Flavien'] ? "Jules" : "Flavien";
echo "Le gagnant est " . $winner . " !" . PHP_EOL;