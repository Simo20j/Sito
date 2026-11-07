<?php

namespace Database\Seeders;

use App\Models\Generation;
use Illuminate\Database\Seeder;

class GenerationSeeder extends Seeder
{
    public function run(): void
    {
        $generazioni = [
            [
                "generazione" => "Prima Generazione (1972)",
                "descrizione" => "L'alba dei videogiochi domestici, sistemi basati su circuiti analogici.",
                "console" => [
                    ["nome" => "Magnavox Odyssey", "anno" => "1972", "tipo" => "Hardware analogico", "descrizione" => "La prima console per videogiochi casalinga della storia, ideata da Ralph Baer."]
                ]
            ],
            [
                "generazione" => "Seconda Generazione (1976 - 1982)",
                "descrizione" => "L'introduzione delle cartucce intercambiabili e dei microprocessori.",
                "console" => [
                    ["nome" => "Atari 2600", "anno" => "1977", "tipo" => "8-bit", "descrizione" => "La console che ha reso celebre l'uso delle cartucce e ha definito un'intera epoca."]
                ]
            ],
            [
                "generazione" => "Terza Generazione (1983 - 1987) - Era 8-bit",
                "descrizione" => "Il risveglio dell'industria dopo la crisi del 1983, dominata da Nintendo e Sega.",
                "console" => [
                    ["nome" => "Nintendo NES (Famicom)", "anno" => "1983", "tipo" => "8-bit", "descrizione" => "Ha salvato il mercato globale introducendo capolavori immortali come Super Mario Bros."],
                    ["nome" => "Sega Master System", "anno" => "1985", "tipo" => "8-bit", "descrizione" => "La risposta diretta di Sega al dominio incontrastato del NES."]
                ]
            ],
            [
                "generazione" => "Quarta Generazione (1987 - 1993) - Era 16-bit",
                "descrizione" => "La famosissima 'Console War' tra grafica a 16-bit, colori brillanti e velocità.",
                "console" => [
                    ["nome" => "NEC PC Engine (TurboGrafx-16)", "anno" => "1987", "tipo" => "16-bit", "descrizione" => "Una delle prime console a 16-bit compatta e potente."],
                    ["nome" => "Sega Mega Drive (Genesis)", "anno" => "1988", "tipo" => "16-bit", "descrizione" => "Il celebre 16-bit di casa Sega reso iconico dalla velocità e da Sonic."],
                    ["nome" => "Super Nintendo (SNES)", "anno" => "1990", "tipo" => "16-bit", "descrizione" => "Il capolavoro Nintendo con palette cromatica avanzata e chip sonoro rivoluzionario."]
                ]
            ],
            [
                "generazione" => "Quinta Generazione (1994 - 1998) - Era 32/64-bit e CD",
                "descrizione" => "Il passaggio epocale alla grafica tridimensionale (3D) e ai supporti in CD-ROM.",
                "console" => [
                    ["nome" => "Sony PlayStation", "anno" => "1994", "tipo" => "32-bit / CD", "descrizione" => "Il debutto trionfale di Sony che ha consacrato il formato CD-ROM."],
                    ["nome" => "Sega Saturn", "anno" => "1994", "tipo" => "32-bit / CD", "descrizione" => "Console focalizzata sull'eccellenza dei conversioni arcade."],
                    ["nome" => "Nintendo 64", "anno" => "1996", "tipo" => "64-bit", "descrizione" => "La rivoluzione del 3D poligonale con levette analogiche e capolavori storici."]
                ]
            ],
            [
                "generazione" => "Sesta Generazione (1998 - 2000+)",
                "descrizione" => "L'era moderna del retro-gaming avanzato, con lettori DVD e connettività di rete.",
                "console" => [
                    ["nome" => "Sega Dreamcast", "anno" => "1998", "tipo" => "128-bit", "descrizione" => "Pioniera del gioco online e ultima console prodotta da Sega."],
                    ["nome" => "Sony PlayStation 2", "anno" => "2000", "tipo" => "128-bit / DVD", "descrizione" => "La console più venduta della storia, dotata di lettore DVD integrato."]
                ]
            ]
        ];

        foreach ($generazioni as $gen) {
            Generation::create([
                'nome' => $gen['generazione'],
                'descrizione' => $gen['descrizione'],
            ])->consoles()->createMany($gen['console']);
        }
    }
}
