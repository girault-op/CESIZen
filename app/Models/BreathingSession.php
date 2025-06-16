<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BreathingSession extends Model
{
    public function mode()
{
    return $this->belongsTo(BreathingMode::class, 'breathing_mode_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}
}