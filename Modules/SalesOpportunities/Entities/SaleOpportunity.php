<?php

namespace Modules\SalesOpportunities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleOpportunity extends Model
{
    use HasFactory;

    protected $table = 'sales_opportunities';

    protected $fillable = ['title'];
}
