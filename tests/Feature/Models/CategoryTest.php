<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    private $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Category();
    }

    public function testList()
    {
        factory(Category::class, 1)->create();

        $categories = $this->model->all();

        $this->assertCount(1, $categories);

        $categoryKey = array_keys($this->model->first()->getAttributes());
        $this->assertEqualsCanonicalizing([
            'id',
            'name',
            'description',
            'is_active',
            'created_at',
            'updated_at',
            'deleted_at'
        ], $categoryKey);
    }

    public function testCreate()
    {
        $category = $this->model->create(['name' => 'test1']);
        $category->refresh();
        $this->assertEquals('test1', $category->name);
        $this->assertNull($category->description);
        $this->assertTrue($category->is_active);

        $category = $this->model->create(['name' => 'test1', 'description' => null]);
        $this->assertNull($category->description);

        $category = $this->model->create(['name' => 'test1', 'description' => 'description1']);
        $this->assertEquals('description1', $category->description);

        $category = $this->model->create(['name' => 'test1', 'is_active' => false]);
        $this->assertFalse($category->is_active);

        $category = $this->model->create(['name' => 'test1', 'is_active' => true]);
        $this->assertTrue($category->is_active);
    }

    public function testUpdate()
    {
        $category = factory(Category::class)->create([
            'description' => 'teste_description',
            'is_active' => false
        ]);

        $data = [
            'name' => 'test_name_updated',
            'description' => 'test_description_updated',
            'is_active' => true
        ];

        $category->update($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $category->{$key});
        }
    }
}
