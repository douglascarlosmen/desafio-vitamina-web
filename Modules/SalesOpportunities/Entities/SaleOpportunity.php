<?php

namespace Modules\SalesOpportunities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Clients\Entities\Client;
use Modules\Products\Entities\Product;

class SaleOpportunity extends Model
{
    use HasFactory;

    protected $table = 'sales_opportunities';

    protected $fillable = [
        'title',
        'status',
        'client_id',
        'product_id'
    ];

    /**
     * Relationships
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Accessors
     */
    public function getFormattedStatusAttribute()
    {
        switch ($this->status) {
            case 'approved':
                $status = 'Aprovado';
                break;
            case 'refused':
                $status = 'Reprovado';
                break;
            default:
                $status = 'Em andamento';
        }

        return $status;
    }
}
