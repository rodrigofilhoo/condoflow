<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class PessoaImovel extends Pivot
{
    use HasFactory;

    protected $table = 'pessoa_imovel';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'pessoa_id',
        'imovel_id',
        'tipo_vinculo',
        'data_inicio',
        'data_fim',
        'status',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
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
