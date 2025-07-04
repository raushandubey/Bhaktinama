<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;

    protected $fillable = ['email'];

    public function routeNotificationForMail()
    {
        // Return the admin email address
        return 'raushandubey2005@gmail.com';
    }
} 