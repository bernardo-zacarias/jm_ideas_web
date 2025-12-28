<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; 

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'precio_laminado',
        'medida',
        'precio_mayoreo',
        'precio_mayoreo_laminado',
        'cantidad_mayoreo',
        'tiene_laminado',
        'material',
        'stock',
        'imagen',
        'categoria_id',
        'orden',
    ];

    /**
     * Relación: Un producto pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
