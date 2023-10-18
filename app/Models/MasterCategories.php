<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterCategories extends Authenticatable
{
    use SoftDeletes, HasFactory, HasRoles, Notifiable;
    // protected $table = 'master_categories'; -- when table name is diff different than model name
    protected $fillable = ['category_name'];                                                        
    protected $guarded = ['id','user_id'];
    public $timestamps = true;
    protected $hidden = ['deleted_at'];
    protected $dates = ['deleted_at'];

    public function masteritems()
    {
        return $this->hasMany(MasterItems::class,'id','category_id');
    }
}
