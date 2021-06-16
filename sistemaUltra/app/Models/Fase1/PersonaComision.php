<?php

namespace App\Models\Fase1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonaComision extends Model
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
    protected $table = 'person_commission';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'person_id',
        'commission_id',
        'leader',
        'firm'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i:s',
        'updated_at' => 'datetime:d/m/Y h:i:s',
        'deleted_at' => 'datetime:d/m/Y h:i:s',
        'leader' => 'boolean'
    ];

    /**
     * Get the firm's link base64 photo.
     *
     * @return string
     */
    public function getFirmBase64Attribute()
    {
        $imagen = Storage::disk('firma')->exists($this->firm); //Preguntamos si la imagen existe creada local

        if (!$imagen) { //Si la imagen no existe
            return null;
        }

        $imagen = Storage::disk('firma')->get($this->firm); //Seleccionar la imagen
        return "data:application/jpg;base64," . base64_encode($imagen);
    }

    public function person()
    {
        return $this->belongsTo(Persona::class, 'person_id', 'id');
    }

    public function commission()
    {
        return $this->belongsTo(Comision::class, 'commission_id', 'id');
    }
}
