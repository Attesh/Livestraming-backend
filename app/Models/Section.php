<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Section extends Model
{
    protected $table = 'section';

    protected $primaryKey = 'id';

    protected $fillable = [
        'section', 
        'course_id', 
        'user_id', 
        'language', 
        'section', 
        'status', 
        'created_at', 
        'updated_at',
    ];

    // Define relationships
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
