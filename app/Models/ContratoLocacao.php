<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContratoLocacao extends Model
{
    use HasFactory;

    protected $table = 'contratos_locacao';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'imovel_id',
        'imobiliaria_id',
        'locatario_id',
        'data_inicio',
        'data_fim',
        'valor_aluguel',
        'valor_condominio',
        'status',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'valor_aluguel' => 'decimal:2',
        'valor_condominio' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'ATIVO',
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
     * Relationship with imobiliaria
     */
    public function imobiliaria()
    {
        return $this->belongsTo(Imobiliaria::class, 'imobiliaria_id');
    }

    /**
     * Relationship with locatario (usuario)
     */
    public function locatario()
    {
        return $this->belongsTo(User::class, 'locatario_id');
    }
}
