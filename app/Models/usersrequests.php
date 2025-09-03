<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersrequests extends Model
{
    use HasFactory;
	protected $fillable = [
        'senderid',
		'hosterid',
		'hosterack',
		'hostercanceled'
    ];
}
