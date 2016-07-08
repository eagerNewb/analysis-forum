<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public function user()
	{
    //belongsTo('User', 'local_key', 'parent_key'); so:
    	return $this->belongsTo(User::class);
	}
	protected $table = 'comments';
	protected $primaryKey = 'id';
    protected $fillable = ['body','article_id','user_id'];

}
