<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
class Note extends Model
{
    protected $table = 'notes';
    protected $fillable = ['task_id', 'body',];

    public function task()
    {
    return $this->belongsTo('App\Task');
    }
}
