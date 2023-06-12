<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hasUser()
    {
        $hasUser = false;

        $user = User::where('client_id', $this->id)->where('status', 'active')->first();

        if (isset($user)) {
            if ($user->status === 'active') {
                $hasUser = true;
            }  
        }

        return $hasUser;

    }
}
