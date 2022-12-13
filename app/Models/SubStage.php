<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStage extends Model
{
    use HasFactory;
    protected $fillable = ['stage_id','name'];

    /**
     * Get the stage that owns the SubStage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
}
