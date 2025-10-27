<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Condominio extends Model
{
    use HasFactory;

    protected $table = 'condominios';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'endereco',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'cnpj',
        'inscricao_estadual',
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
     * Relationship with blocos
     */
    public function blocos()
    {
        return $this->hasMany(Bloco::class, 'condominio_id');
    }

    /**
     * Relationship with imoveis
     */
    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'condominio_id');
    }

    /**
     * Relationship with vagas de estacionamento
     */
    public function vagasEstacionamento()
    {
        return $this->hasMany(VagaEstacionamento::class, 'condominio_id');
    }
}
