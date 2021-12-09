<?php

namespace Tests\Unit\Models;

use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class GenreTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Genre();
    }

    public function testFillableAttribute()
    {
        $fillable = [
            'name',
            'is_active'
        ];

        $this->assertEquals($fillable, $this->model->getFillable());
    }

    public function testDatesAttribute()
    {
        $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        foreach ($dates as $date) {
            $this->assertContains($date, $this->model->getDates());
        }

        $this->assertCount(count($dates), $this->model->getDates());
    }

    public function testIfUseTraits()
    {
        $traits = [
            SoftDeletes::class, Uuid::class
        ];

        $genresTraits = array_keys(class_uses(Genre::class));

        $this->assertEquals($traits, $genresTraits);
    }

    public function testCasts()
    {
        $casts = ['id' => 'string'];

        $this->assertEquals($casts, $this->model->getCasts());
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->model->incrementing);
    }
}
