<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ocorrencia extends Model
{
    use HasFactory;

    protected $table = 'ocorrencias';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'descricao',
        'status',
        'prioridade',
        'imovel_id',
        'pessoa_id',
        'data_abertura',
        'data_conclusao',
        'resposta',
    ];

    protected $casts = [
        'data_abertura' => 'datetime',
        'data_conclusao' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'ABERTA',
        'prioridade' => 'NORMAL',
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
     * Relationship with multas
     */
    public function multas()
    {
        return $this->hasMany(Multa::class, 'ocorrencia_id');
    }
}
