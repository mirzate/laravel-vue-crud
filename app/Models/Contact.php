<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;
    
    protected $table = 'contacts';

    protected $fillable = [
        'value',
        'customer_id',
        'contact_type_id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContactType::class,'contact_type_id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
