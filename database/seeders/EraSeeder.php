<?php

namespace Database\Seeders;

use App\Models\Era;
use Illuminate\Database\Seeder;

class EraSeeder extends Seeder
{
    public function run(): void
    {
        $era_videogiochi = [
            [
                "era" => "Le Origini e le Sale Giochi (Anni '70)",
                "descrizione" => "La nascita del settore con i primi arcade elettromeccanici e i grandi classici da bar.",
                "giochi" => [
                    ["titolo" => "Pong", "anno" => "1972", "piattaforma" => "Arcade / Atari", "descrizione" => "Il videogioco che ha dato inizio all'industria commerciale, simulando il tennistavolo."],
                    ["titolo" => "Space Invaders", "anno" => "1978", "piattaforma" => "Arcade / Taito", "descrizione" => "Un fenomeno globale che ha definito il genere degli sparatutto a scorrimento e scatenato una carenza di monete in Giappone."]
                ]
            ],
            [
                "era" => "L'Era d'Oro degli Arcade e 8-bit (Anni '80)",
                "descrizione" => "Personaggi iconici, colonne sonore a 8-bit e il passaggio definitivo nelle case dei giocatori.",
                "giochi" => [
                    ["titolo" => "Pac-Man", "anno" => "1980", "piattaforma" => "Arcade / Namco", "descrizione" => "L'icona pop per eccellenza che ha rivoluzionato il gaming introducendo il concetto di mascotte."],
                    ["titolo" => "Super Mario Bros.", "anno" => "1985", "piattaforma" => "NES", "descrizione" => "Il capolavoro che ha stabilito i canoni moderni del genere platform e consacrato Nintendo."],
                    ["titolo" => "The Legend of Zelda", "anno" => "1986", "piattaforma" => "NES", "descrizione" => "Ha introdotto il concetto di esplorazione libera e salvataggio dei progressi su cartuccia."]
                ]
            ],
            [
                "era" => "La Rivoluzione dei 16-bit (Fine '80 - Anni '90)",
                "descrizione" => "Grafica ricca di colori, sprite dettagliati e la nascita dei picchiaduro competitivi.",
                "giochi" => [
                    ["titolo" => "Sonic the Hedgehog", "anno" => "1991", "piattaforma" => "Sega Mega Drive", "descrizione" => "Velocità pura e stile accattivante per la mascotte Sega che ha sfidato il dominio di Mario."],
                    ["titolo" => "Street Fighter II", "anno" => "1991", "piattaforma" => "Arcade / SNES", "descrizione" => "Il padre di tutti i picchiaduro a incontri moderni, pioniere della scena competitiva."],
                    ["titolo" => "Super Mario World", "anno" => "1990", "piattaforma" => "SNES", "descrizione" => "Uno dei platform 2D più perfetti di sempre, famoso per l'introduzione del dinosauro Yoshi."]
                ]
            ],
            [
                "era" => "Il Passaggio al 3D e il formato CD (Anni '90 - 2000)",
                "descrizione" => "Mondi tridimensionali, narrazione cinematografica e colonne sonore memorizzate su CD-ROM.",
                "giochi" => [
                    ["titolo" => "Super Mario 64", "anno" => "1996", "piattaforma" => "Nintendo 64", "descrizione" => "La pietra miliare che ha insegnato a tutta l'industria come gestire il movimento 3D e la telecamera."],
                    ["titolo" => "Final Fantasy VII", "anno" => "1997", "piattaforma" => "PlayStation", "descrizione" => "L'JRPG che ha sdoganato il genere in Occidente grazie a filmati in computer grafica e una trama epica."],
                    ["titolo" => "Metal Gear Solid", "anno" => "1998", "piattaforma" => "PlayStation", "descrizione" => "Il capolavoro stealth di Hideo Kojima che ha unito il videogioco alla regia cinematografica."]
                ]
            ],
            [
                "era" => "L'Alba del Nuovo Millennio (Anno 2000)",
                "descrizione" => "L'evoluzione verso mondi aperti e meccaniche di gioco sempre più complesse.",
                "giochi" => [
                    ["titolo" => "Diablo II", "anno" => "2000", "piattaforma" => "PC", "descrizione" => "Uno degli action RPG più influenti della storia, famoso per la sua atmosfera cupa e il sistema di loot."],
                    ["titolo" => "The Sims", "anno" => "2000", "piattaforma" => "PC", "descrizione" => "La rivoluzione dei simulatori di vita ideata da Will Wright che ha conquistato milioni di giocatori nel mondo."]
                ]
            ]
        ];

        foreach ($era_videogiochi as $era) {
            Era::create([
                'nome' => $era['era'],
                'descrizione' => $era['descrizione'],
            ])->games()->createMany($era['giochi']);
        }
    }
}
