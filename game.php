<?php

const PIERRE = 1;
const FEUILLE = 2;
const CISEAUX = 3;

function getSign() {
    return mt_rand(1, 3);
}

function translateSign($sign) {
    switch ($sign) {
        case 1:
            return "Pierre";
        case 2:
            return "Feuille";
        case 3:
            return "Ciseaux";
        default:
            return "";
    }
}

function play($signJules, $signFlavien) {
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

$scores = [
    "Jules" => 0,
    "Flavien" => 0
];

echo "------ Début du jeu ------" . PHP_EOL;

while($scores['Jules'] !== 2 && $scores['Flavien'] !== 2) {
    echo "---------- Nouvelle manche ----------" . PHP_EOL;
    $result = play(getSign(), getSign());

    echo "Jules : " . translateSign($result['signs']['Jules']) . PHP_EOL;
    echo "Flavien : " . translateSign($result['signs']['Flavien']) . PHP_EOL;
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