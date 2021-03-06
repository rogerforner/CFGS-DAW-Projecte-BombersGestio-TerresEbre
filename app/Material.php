<?php

namespace App;

use App\Containers;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referencia',
        'nom'
    ];

    /**
     * Eloquent: Relationships.
     **************************************************************************/
    /**
     * Container.
     * The containers that belong to the material.
     */
    public function containers()
    {
        return $this->belongsToMany(Container::class)
            ->withPivot('id','quantitat_prevista', 'quantitat', 'es_del_parc');
    }
}
