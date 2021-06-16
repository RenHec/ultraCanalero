<?php

namespace App\Models\Fase1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSend extends Model
{
    use HasFactory;

    public const INVITACION = 'Invitación';

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
    protected $table = 'email_send';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'title',
        'email',
        'send',
        'token',
        'description',
        'answer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i:s',
        'updated_at' => 'datetime:d/m/Y h:i:s',
        'send' => 'boolean',
        'answer' => 'boolean'
    ];

    public function person()
    {
        return $this->belongsTo(Persona::class, 'email', 'email');
    }
}
