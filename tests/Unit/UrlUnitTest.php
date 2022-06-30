<?php

namespace Tests;

use Tests\TestCase;
use App\Models\Url;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UrlUnitTest extends TestCase
{
  use DatabaseTransactions;

  protected $url;

  protected function setUp(): void
  {
    parent::setUp();
    $this->url = new Url;
  }
  
  public function test_url_can_be_created_with_empty_fields()
  {
    $data = [
      'id' => null,
      'url' => null,
      'identifier' => null,
      'short_url' => null,
    ];

    $this->expectException(\PDOException::class);
    
    $this->url->factory()->create($data); 
  }

  public function test_url_can_be_created_with_duplicated_fields()
  {
    $data = [
      'id' => 1,
      'url' => 'http://example.com',
      'identifier' => 'test-identifier',
    ];

    $this->expectException(\PDOException::class);
    
    $this->url->factory()->count(2)->create($data); 
  }

  public function test_clear_expired_urls_from_database() 
  {   
    $this->url->factory()->count(5)->create([
      'expiration' => '2022-01-01 00:00:01'
    ]);
    
    $this->artisan('command:wipe-expirated-urls');
    $urls = $this->url->all();
    $this->assertCount(0, $urls);
  }

  public function test_dont_clear_valid_urls_from_database() 
  {
    $this->url->factory()->count(5)->create();
    $this->artisan('command:wipe-expirated-urls');
    $urls = $this->url->all();
    $this->assertCount(5, $urls);
  }
}
