<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['date'];

    public function getFormmatedDateAttribute()
    {
        return $this->date->format('F j, Y');
    }

    public function getFormmatedStartTimeAttribute()
    {
        return $this->date->format('g:ia');
    }
    
    public function getTicketPriceInDollarsAttribute()
    {
        return number_format($this->ticket_price / 100 , 2);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

}
