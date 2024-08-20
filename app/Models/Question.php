<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if($this->answers > 0){
            if ($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
}
