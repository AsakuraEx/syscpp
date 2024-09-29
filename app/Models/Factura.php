<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    use HasFactory;
    protected $table = "facturas";
    protected $fillable = ['id', 'fechaFactura', 'facturador', 'totalFactura', 'estadoFactura', 'idProveedor'];
    
}
