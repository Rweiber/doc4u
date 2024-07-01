<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = ['nome', 'especialidade_id']; 

    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class);
    }
}