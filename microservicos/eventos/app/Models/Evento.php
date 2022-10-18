<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'data'];

    public function getDataEvento() {
        $dataFormatada = new DateTime($this->attributes['data']);
        // echo $data->format('d-m-Y H:i:s');
        // return $this->attributes['data']
        return $dataFormatada;
    }

    public function setDataEvento($attr) {
        // return $this->attributes['price'] = $attr * 100;
        // Aqui deixar no formato para salvar no banco
    }
}
