<?php

namespace App\Models\Fase1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'names',
        'surnames',
        'email',
        'phone',
        'whatsapp',
        'telegram',
        'birthday',
        'information'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birthday'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i:s',
        'updated_at' => 'datetime:d/m/Y h:i:s',
        'deleted_at' => 'datetime:d/m/Y h:i:s',
        'birthday' => 'date:d/m/Y',
        'information' => 'boolean'
    ];

    public function commissions()
    {
        return $this->belongsToMany(PersonaComision::class, 'id', 'person_id');
    }
}
