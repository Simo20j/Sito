<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Review;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
        $this->actingAs(User::factory()->create(['nome' => 'Mario']));
    }

    public function test_home_lists_the_articles(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Ciao, <strong>Mario</strong>', false)
            ->assertSee('Street Fighter II')
            ->assertSee('12 Ottobre 1985 • di Redazione');
    }

    public function test_an_article_page_shows_its_text(): void
    {
        $article = Article::where('tag', 'Arcade')->first();

        $this->get("/articoli/{$article->id}")
            ->assertOk()
            ->assertSee('Quando Capcom lanciò Street Fighter II');
    }

    public function test_an_unknown_article_returns_404(): void
    {
        $this->get('/articoli/999')->assertNotFound();
    }

    public function test_timeline_pages_show_the_seeded_items(): void
    {
        $this->get('/console')->assertOk()->assertSee('Magnavox Odyssey')->assertSee('Sony PlayStation 2');
        $this->get('/videogiochi')->assertOk()->assertSee('Pong')->assertSee('The Sims');
    }

    public function test_seeding_twice_does_not_duplicate_content(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(3, Article::count());
    }

    public function test_a_review_can_be_published(): void
    {
        $this->post('/recensioni', ['titolo' => 'Bello', 'voto' => 4, 'commento' => 'Mi piace'])
            ->assertRedirect('/recensioni');

        $this->get('/recensioni')
            ->assertSeeInOrder(['Opinioni degli utenti (3)', 'Bello', 'Mario', '4/5', 'Sito fantastico!', 'Un tuffo nel passato']);
    }

    public function test_review_input_is_escaped_and_validated(): void
    {
        $this->post('/recensioni', ['titolo' => '<script>x</script>', 'voto' => 5, 'commento' => 'ok']);
        $this->get('/recensioni')->assertDontSee('<script>x</script>', false);

        $this->post('/recensioni', ['titolo' => 'x', 'voto' => 9, 'commento' => 'ok'])->assertSessionHasErrors('voto');
        $this->assertSame(3, Review::count());
    }
}
