<?php

namespace App\Helpers;

class PseudoHelper
{
    public static function generate()
    {
        $adjectifs = ['Fougueux', 'Mystérieux', 'Drôle', 'Serein', 'Discret', 'Intrépide'];
        $animaux = ['Tigre', 'Renard', 'Chat', 'Lynx', 'Panda', 'Chouette'];
        $num = rand(100, 999);

        return $adjectifs[array_rand($adjectifs)].$animaux[array_rand($animaux)].$num;
    }
}
