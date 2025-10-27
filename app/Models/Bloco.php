<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bloco extends Model
{
    use HasFactory;

    protected $table = 'blocos';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'condominio_id',
        'total_andares',
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
     * Relationship with condominio
     */
    public function condominio()
    {
        return $this->belongsTo(Condominio::class, 'condominio_id');
    }

    /**
     * Relationship with imoveis
     */
    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'bloco_id');
    }

    /**
     * Relationship with vagas de estacionamento
     */
    public function vagasEstacionamento()
    {
        return $this->hasMany(VagaEstacionamento::class, 'bloco_id');
    }
}
