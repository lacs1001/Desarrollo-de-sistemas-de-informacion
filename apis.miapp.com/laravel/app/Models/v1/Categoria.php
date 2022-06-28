<?php
 
namespace App\Models\v1;
 
use Illuminate\Database\Eloquent\Model;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\SoftDeletes;

 
class Categoria extends Model
{
    use HasUUID;
    use SoftDeletes;

    //protected $connection= 'pgsql_categorias';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorias';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $uuidFieldName = 'id';
}