<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    public function transactions():HasMany{
        return $this->hasMany(Transaction::class);
    }

    public function visitors():HasMany{
        return $this->hasMany(Visitor::class);
    }
}
