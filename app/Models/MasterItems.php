<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterItems extends Authenticatable
{
    use SoftDeletes, HasFactory, HasRoles, Notifiable;
    // protected $table = 'master_items'; -- when table name is diff different than model name
    protected $fillable = ['item_name', 'status'];                                                        
    protected $guarded = ['id','user_id','category_id'];
    public $timestamps = true;
    protected $hidden = ['deleted_at'];
    protected $dates = ['deleted_at'];

    public function mastercategories()
    {
        return $this->belongsTo(MasterCategories::class,'category_id','id');
    }
}
