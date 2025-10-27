<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AgendamentoRecurso extends Model
{
    use HasFactory;

    protected $table = 'agendamentos_recursos';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'recurso_id',
        'pessoa_id',
        'imovel_id',
        'data_inicio',
        'data_fim',
        'status',
        'observacoes',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'AGENDADO',
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
     * Relationship with recurso
     */
    public function recurso()
    {
        return $this->belongsTo(RecursoCondominio::class, 'recurso_id');
    }

    /**
     * Relationship with pessoa (usuario)
     */
    public function pessoa()
    {
        return $this->belongsTo(User::class, 'pessoa_id');
    }

    /**
     * Relationship with imovel
     */
    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'imovel_id');
    }
}
