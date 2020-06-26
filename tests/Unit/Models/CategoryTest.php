<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Carbon\Traits\Test;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    private $category;


    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function testIfUseTraits() {
        $traits = [
            SoftDeletes::class,
            Uuid::class
        ];
        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testFillableAttribute()
    {
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable,$this->category->getFillable());
    }

    public function testCastsAttribute()
    {
        $casts = [
            'id' => 'string',
            'is_active' => 'boolean'
        ];
        $this->assertEquals($casts, $this->category->getCasts());
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        foreach ($dates as $date){
            $this->assertContains($date, $this->category->getDates());
        }
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->category->incrementing);
    }
}
