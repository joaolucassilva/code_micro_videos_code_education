<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Traits\Uuid;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    private $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Category();
    }

    public function testFillableAttribute()
    {
        $fillable = [
            'name',
            'description',
            'is_active'
        ];

        $this->assertEquals($fillable, $this->model->getFillable());
    }

    public function testDatesAttribute()
    {
        $dates = ['created_at', 'updated_at', 'deleted_at'];
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

        $categoryTraits = array_keys(class_uses(Category::class));

        $this->assertEquals($traits, $categoryTraits);
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
