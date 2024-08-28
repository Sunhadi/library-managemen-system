<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    public function members():BelongsTo{
        return $this->belongsTo(Member::class);
    }

    public function books():BelongsTo{
        return $this->belongsTo(Book::class);
    }

    public function penalties():BelongsTo{
        return $this->belongsTo(Penalty::class);
    }
}
