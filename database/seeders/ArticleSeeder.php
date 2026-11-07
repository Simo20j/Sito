<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articoli = [
            1 => [
                "titolo" => "Super Mario Bros: La rivoluzione delle piattaforme",
                "tag" => "Console",
                "data" => "12 Ottobre 1985 • di Redazione",
                "testo" => "Rilasciato nel 1985 per il Nintendo Entertainment System (NES), Super Mario Bros. ha ridefinito il genere dei platform. Ideato da Shigeru Miyamoto, il gioco ha introdotto meccaniche di scorrimento laterale fluide, power-up iconici come il Super Fungo e il Fiore di Fuoco, e un level design magistrale che insegnava al giocatore le regole senza bisogno di tutorial testuali.<br><br>Ha inoltre rappresentato la salvezza per l'industria dei videogiochi dopo la grande crisi del mercato americano del 1983, consacrando Nintendo come leader globale del settore e rendendo Mario l'icona immortale che conosciamo oggi."
            ],
            2 => [
                "titolo" => "Street Fighter II: L'epoca d'oro dei cabinati",
                "tag" => "Arcade",
                "data" => "08 Marzo 1991 • di Redazione",
                "testo" => "Quando Capcom lanciò Street Fighter II nelle sale giochi nel 1991, il mondo dei cabinati cambiò per sempre. Non si trattava più solo di superare punteggi contro il computer, ma di sfidare direttamente la persona seduta accanto.<br><br>Con l'introduzione di mosse speciali eseguite tramite combinazioni di comandi, un roster di lottatori provenienti da tutto il mondo (da Ryu a Chun-Li) e un sistema di combattimento profondo e bilanciato, SFII ha dato ufficialmente vita al fenomeno globale dei giochi picchiaduro, riempiendo le sale giochi di intere generazioni di appassionati."
            ],
            3 => [
                "titolo" => "Sega Mega Drive vs Super Nintendo",
                "tag" => "16-Bit",
                "data" => "15 Novembre 1992 • di Redazione",
                "testo" => "La prima grande 'Console War' della storia moderna ha visto scontrarsi due giganti assoluti dell'era dei 16-bit: da una parte il Sega Mega Drive (Genesis negli USA), aggressivo e veloce con la sua mascotte Sonic; dall'altra il Super Nintendo (SNES), forte di una palette colori superiore, un chip audio rivoluzionario e capolavori senza tempo come Super Mario World e The Legend of Zelda: A Link to the Past.<br><br>Questa rivalità feroce non solo ha spinto l'hardware e la creatività degli sviluppatori al limite, ma ha anche dato forma al marketing videoludico moderno, dividendo i giocatori in fazioni contraffatte che resistono ancora oggi nei cuori dei retro-gamer."
            ]
        ];

        $dettagli = [
            1 => ['pubblicato_il' => '1985-10-12', 'estratto' => "Come il titolo di Shigeru Miyamoto sul NES ha salvato l'industria dei videogiochi dalla crisi del 1983..."],
            2 => ['pubblicato_il' => '1991-03-08', 'estratto' => "L'impatto culturale e competitivo del picchiaduro Capcom nelle sale giochi di tutto il mondo..."],
            3 => ['pubblicato_il' => '1992-11-15', 'estratto' => 'Sonic contro Mario: storia della prima e più iconica "Console War" degli anni \'90...'],
        ];

        foreach ($articoli as $id => $articolo) {
            Article::create([
                'titolo' => $articolo['titolo'],
                'tag' => $articolo['tag'],
                'autore' => 'Redazione',
                'pubblicato_il' => $dettagli[$id]['pubblicato_il'],
                'estratto' => $dettagli[$id]['estratto'],
                'testo' => str_replace('<br><br>', "\n\n", $articolo['testo']),
            ]);
        }
    }
}
