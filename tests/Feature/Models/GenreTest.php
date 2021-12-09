<?php

namespace Tests\Feature\Models;

use App\Models\Genre;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use DatabaseMigrations;

    private $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Genre();
    }

    public function testList()
    {
        factory(Genre::class, 1)->create();

        $genres = $this->model->all();
        $this->assertCount(1, $genres);

        $genreKeys = array_keys($this->model->first()->getAttributes());
        $this->assertEqualsCanonicalizing([
            'id',
            'name',
            'is_active',
            'created_at',
            'updated_at',
            'deleted_at'
        ], $genreKeys);
    }

    public function testCreate()
    {
        $genre = $this->model->create(['name' => 'genre_teste_1']);
        $genre->refresh();
        $this->assertEquals(36, strlen($genre->id));
        $this->assertEquals('genre_teste_1', $genre->name);
        $this->assertTrue($genre->is_active);

        $genre = $this->model->create(['name' => 'genre_teste_1', 'is_active' => false]);
        $this->assertFalse($genre->is_active);

        $genre = $this->model->create(['name' => 'genre_teste_1', 'is_active' => true]);
        $this->assertTrue($genre->is_active);
    }

    public function testUpdate()
    {
        $genre = factory(Genre::class)->create(['is_active' => false]);

        $data = [
            'name' => 'test_name_updated',
            'is_active' => true
        ];

        $genre->update($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $genre->{$key});
        }
    }

    public function testeDelete()
    {
        $genre = factory(Genre::class)->create();
        $genre->delete();
        $this->assertNull($this->model->find($genre->id));

        $genre->restore();
        $this->assertNotNull($this->model->find($genre->id));
    }
}
