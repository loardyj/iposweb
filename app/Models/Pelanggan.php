<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_supel';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAuthPassword()
    {
        return Hash::make($this->telepon);
    }

    protected function kodeKantor(): Attribute
    {
        $kantor = 'UTM';

        if (str_contains($this->nama, '-')) { 
            $kantor = explode('-', $this->nama);
            $kantor = array_pop($kantor);
            $kantor = str_replace(' ', '', $kantor);
        }

        return Attribute::make(
            get: fn () => $kantor,
        );
    }

    protected function namaKantor(): Attribute
    {
        $value = Kantor::where('kodekantor', $this->kodeKantor)->value('namakantor');

        return Attribute::make(
            get: fn () => $value,
        );
    }

    protected function WAKantor(): Attribute
    {
        $value = Kantor::where('kodekantor', $this->kodeKantor)->value('whatsapp');

        return Attribute::make(
            get: fn () => $value,
        );
    }

    protected function levelHarga(): Attribute
    {
        $value = GrupPelanggan::where('kgrup', $this->kgrup)->value('levelharga');

        return Attribute::make(
            get: fn () => $value,
        );
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        // 'name',
        // 'email',
        // 'telepon',
    ];    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            // 'password' => 'hashed',
        ];
    }
}
