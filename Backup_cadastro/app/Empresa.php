<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = ['razao_social','endereco','cnpj','telefone'];
    protected $primaryKey = 'id_empresa';
    protected $dates = ['deleted_at'];

    public function usuarios() {
        return $this->hasMany('App\User','id_empresa');
    }
}
