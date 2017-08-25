<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'todo_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function todo() {
      return $this->belongsTo('App\Todo');
    }
}
