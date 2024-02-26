<?php

namespace Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function testIndex()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/category');
        $response->assertViewIs('category.index');
        $response->assertViewHas('categories');
    }

    public function testShow()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->get('/category/' . $category->id);
        $response = $this->get('/category/' . $category->id);
        $response->assertViewIs('category.show');
        $response->assertViewHas('category');
    }

    public function testStore()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/category/create');
        $response->name = 'Category 1';
        $category = $this->actingAs($user)->post('/category/create');
        $this->assertIsObject($category);
    }

    public function testCreate()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/category/create');
        $response = $this->get('/category/create');
        $response->assertViewIs('category.create');
    }

    public function testEdit()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->get('/category/create');
        $response = $this->get('/category/edit/' . $category->id);
        $response->assertViewIs('category.edit');
        $response->assertViewHas('category');
    }

    public function testUpdate()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->get('/category/create');
        $response->name = 'Category 2';
        $category = $this->actingAs($user)->put('/category/edit/' . $category->id);
        $this->assertIsObject($category);
    }

    public function testDestroy()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/category/create');
        $category = Category::factory()->create();
        $response = $this->delete('/category/delete/' . $category->id);
        $response->assertRedirect('/category');
    }

    public function testActivate()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/category/create');
        $category = Category::factory()->create();
        $response = $this->put('/category/activate/' . $category->id);
        $response->assertRedirect('/category');
    }
}
