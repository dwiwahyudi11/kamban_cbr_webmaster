<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionsLabel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions_label';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label', 
        'route', 
        'description', 
        'position'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    public $timestamps = false;

    public function permission() {
        return $this->hasMany('Spatie\Permission\Models\Permission', 'label_id', 'id');
    }
}
