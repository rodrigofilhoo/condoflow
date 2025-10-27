<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Multa extends Model
{
    use HasFactory;

    protected $table = 'multas';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'imovel_id',
        'pessoa_id',
        'ocorrencia_id',
        'motivo',
        'valor',
        'status',
        'data_multa',
        'data_pagamento',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_multa' => 'date',
        'data_pagamento' => 'date',
        'created_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'PENDENTE',
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
     * Relationship with imovel
     */
    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'imovel_id');
    }

    /**
     * Relationship with pessoa (usuario)
     */
    public function pessoa()
    {
        return $this->belongsTo(User::class, 'pessoa_id');
    }

    /**
     * Relationship with ocorrencia
     */
    public function ocorrencia()
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }
}
