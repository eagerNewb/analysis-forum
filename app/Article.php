<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function comments(){
        
        return $this->hasMany(Comment::class);
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public function User(){
        
        return $this->hasOne(User::class);
    }

    protected $table = 'articles';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'body', 'user_id'];
}
