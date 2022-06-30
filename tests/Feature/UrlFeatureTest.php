<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Url;

class UrlFeatureTest extends TestCase
{
  use DatabaseTransactions;

  protected $url;

  protected function setUp(): void
  {
    parent::setUp();
    $this->url = new Url;
  }
  
  public function test_creating_short_url_by_route()
  {
    $data = [
      'url' => 'https://google.com',
      'expiration' => 3,
    ];

    $this->call('POST','/api/newShortUrl/',$data)
      ->assertStatus(201);
    
    $urls = $this->url->all();
    $this->assertCount(1, $urls);
  }

  public function test_if_short_url_can_redirect()
  {
    $url = $this->url->factory()->create([
      'id' => 1002,
      'url' => 'https://google.com'
    ]);

    $this->call('GET','/api/redirect/',['identifier' => $url->identifier])
      ->assertStatus(302)
      ->assertRedirect($url->url);
  }
}
