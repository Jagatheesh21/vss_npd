<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];
    /**
     * The roles that belong to the Stage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sub_stages()
    {
        return $this->hasMany(SubStage::class);
    }
}
