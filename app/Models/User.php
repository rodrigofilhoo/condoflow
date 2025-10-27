<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\CustomAuthenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model implements Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, AuthenticatableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'ativo' => true,
        'tipo_pessoa' => 'FISICA',
        'tipo_documento' => 'CPF',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'email',
        'senha_hash',
        'tipo_pessoa',
        'tipo_documento',
        'telefone',
        'data_nascimento',
        'cpf',
        'ativo',
        'grupo_id',
        'two_factor_code',
        'two_factor_expires_at',
        'two_factor_enabled',
        'email_verified_at',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha_hash',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date',
            'ativo' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'two_factor_expires_at' => 'datetime',
            'two_factor_enabled' => 'boolean',
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Relationship with grupos
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    /**
     * Relationship with imoveis
     */
    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'proprietario_id');
    }

    /**
     * Generate a two factor authentication code for the user.
     *
     * @return void
     */
    public function generateTwoFactorCode()
    {
        // Generate a random 6 digit code
        $this->two_factor_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Set expiry time - 10 minutes from now
        $this->two_factor_expires_at = now()->addMinutes(10);
        
        $this->save();
    }

    /**
     * Reset the two factor authentication code.
     *
     * @return void
     */
    public function resetTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        
        $this->save();
    }

    /**
     * Check if the two factor authentication code has expired.
     *
     * @return bool
     */
    public function isTwoFactorCodeExpired()
    {
        return $this->two_factor_expires_at->isPast();
    }
}
