<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imoveis';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'condominio_id',
        'bloco_id',
        'numero',
        'andar',
        'tipo',
        'area_m2',
        'qtde_vagas',
        'proprietario_id',
        'status_locacao',
    ];

    protected $casts = [
        'area_m2' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'status_locacao' => 'DISPONIVEL',
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
     * Relationship with bloco
     */
    public function bloco()
    {
        return $this->belongsTo(Bloco::class, 'bloco_id');
    }

    /**
     * Relationship with proprietario (usuario)
     */
    public function proprietario()
    {
        return $this->belongsTo(User::class, 'proprietario_id');
    }

    /**
     * Relationship with pessoa_imovel (many to many with users)
     */
    public function pessoas()
    {
        return $this->belongsToMany(User::class, 'pessoa_imovel', 'imovel_id', 'pessoa_id')
                    ->withPivot(['tipo_vinculo', 'data_inicio', 'data_fim', 'status'])
                    ->withTimestamps();
    }

    /**
     * Relationship with veiculos
     */
    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'imovel_id');
    }

    /**
     * Relationship with contratos de locacao
     */
    public function contratosLocacao()
    {
        return $this->hasMany(ContratoLocacao::class, 'imovel_id');
    }

    /**
     * Relationship with multas
     */
    public function multas()
    {
        return $this->hasMany(Multa::class, 'imovel_id');
    }

    /**
     * Relationship with agendamentos de recursos
     */
    public function agendamentosRecursos()
    {
        return $this->hasMany(AgendamentoRecurso::class, 'imovel_id');
    }
}
