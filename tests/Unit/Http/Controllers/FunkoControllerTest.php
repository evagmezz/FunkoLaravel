<?php

namespace Http\Controllers;

use App\Http\Controllers\FunkoController;
use App\Models\Funko;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class FunkoControllerTest extends TestCase
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
        $response = $this->get('/funkos');
        $response->assertViewIs('funkos.index');
    }

    public function testShow()
    {
        $funko = Funko::factory()->create();
        $response = $this->get('/funkos/' . $funko->id);
        $response->assertViewIs('funkos.show');
        $response->assertViewHas('funko');
    }

    public function testStore()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $request = new Request();
        $request->name = 'Funko 2';
        $request->price = 20;
        $request->stock = 10;
        $request->category_id = $category->id;
        $funko = $this->actingAs($user)->post('/funkos/create', $request->toArray());
        $this->assertIsObject($funko);
    }

    public function testCreate()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $response = $this->actingAs($user)->get('/funkos/create');
        $response->assertViewIs('funkos.create');
    }

    public function testEdit()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $funko = Funko::factory()->create();
        $response = $this->actingAs($user)->get('/funkos/edit/' . $funko->id);
        $response->assertViewIs('funkos.edit');
    }

    public function testUpdate()
    {
        $funko = Funko::factory()->create();
        $user = User::factory()->create(['role' => 'admin']);
        $request = new Request();
        $request->name = 'Funko 2';
        $request->price = 20;
        $request->stock = 10;
        $request->category_id = $funko->category_id;
        $funko = $this->actingAs($user)->put('/funkos/edit/' . $funko->id, $request->toArray());
        $this->assertIsObject($funko);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $funko = Funko::factory()->create();
        $response = $this->actingAs($user)->delete('/funkos/delete/' . $funko->id);
        $response->assertRedirect();
    }
}
