<?php

namespace Http\Controllers;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private $categoryController;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoryController = new CategoryController();
    }

    public function testIndex()
    {
        $request = new Request();
        $request->search = null;
        $categories = $this->categoryController->index($request);
        $this->assertIsObject($categories);
    }

    public function testShow()
    {
        $category = Category::factory()->create();
        $response = $this->get('/category/' . $category->id);
        $response->assertOk();
        $response->assertViewIs('category.show');
        $response->assertViewHas('category');
    }

    public function testStore()
    {
        $request = new Request();
        $request->name = 'Category 1';
        $category = $this->categoryController->create($request);
        $this->assertIsObject($category);
    }

    public function testCreate()
    {
        $response = $this->get('/category/create');
        $response->assertOk();
        $response->assertViewIs('category.create');
    }

    public function testEdit()
    {
        $category = Category::factory()->create();
        $response = $this->get('/category/edit/' . $category->id);
        $response->assertOk();
        $response->assertViewIs('category.edit');
        $response->assertViewHas('category');
    }

    public function testUpdate()
    {
        $category = Category::factory()->create();
        $request = new Request();
        $request->name = 'Category 2';
        $category = $this->categoryController->update($request, $category->id);
        $this->assertIsObject($category);
    }

    public function testDestroy()
    {
        $category = Category::factory()->create();
        $response = $this->delete('/category/delete/' . $category->id);
        $response->assertRedirect('/category');
    }

    public function testActivate()
    {
        $category = Category::factory()->create();
        $response = $this->put('/category/activate/' . $category->id);
        $response->assertRedirect('/category');
    }
}
