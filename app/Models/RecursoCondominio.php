<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RecursoCondominio extends Model
{
    use HasFactory;

    protected $table = 'recursos_condominio';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'DISPONIVEL',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Relationship with agendamentos
     */
    public function agendamentos()
    {
        return $this->hasMany(AgendamentoRecurso::class, 'recurso_id');
    }
}
