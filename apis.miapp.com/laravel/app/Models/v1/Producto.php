<?php
 
namespace App\Models\v1;
 
use Illuminate\Database\Eloquent\Model;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Producto extends Model
{
    use HasUUID;
    use SoftDeletes;

    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $uuidFieldName = 'id';
    
}