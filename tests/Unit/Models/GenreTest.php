<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenreTest extends TestCase
{
    private $genre;


    protected function setUp(): void
    {
        parent::setUp();
        $this->genre = new Genre();
    }

    public function testIfUseTraits() {
        $traits = [
            SoftDeletes::class,
            Uuid::class
        ];
        $genreTraits = array_keys(class_uses(Genre::class));
        $this->assertEquals($traits, $genreTraits);
    }

    public function testFillableAttribute()
    {
        $fillable = ['name', 'is_active'];
        $this->assertEquals($fillable,$this->genre->getFillable());
    }

    public function testCastsAttribute()
    {
        $casts = [
            'id' => 'string',
            'is_active' => 'boolean'
        ];
        $this->assertEquals($casts, $this->genre->getCasts());
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        foreach ($dates as $date){
            $this->assertContains($date, $this->genre->getDates());
        }
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->genre->incrementing);
    }
}
