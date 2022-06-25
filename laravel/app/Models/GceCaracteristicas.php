<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GceCaracteristicas extends Model
{
    use HasFactory;

    protected $fillable = [
        'gce_nombre_equipo',
        'gce_board',
        'gce_case',
        'gce_procesador',
        'gce_grafica',
        'gce_ram',
        'gce_disco_duro',
        'gce_teclado',
        'gce_mouse',
        'gce_pantalla',
        'gce_estado',
    ];
}
