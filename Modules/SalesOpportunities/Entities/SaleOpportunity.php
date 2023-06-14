<?php

namespace Modules\SalesOpportunities\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Clients\Entities\Client;
use Modules\Products\Entities\Product;
use Modules\Sellers\Entities\Seller;
use Illuminate\Database\Eloquent\Builder;
use Modules\SalesOpportunities\Helpers\FormatHelper;

class SaleOpportunity extends Model
{
    use HasFactory;

    protected $table = 'sales_opportunities';

    protected $fillable = [
        'title',
        'status',
        'client_id',
        'product_id',
        'seller_id'
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

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
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

    /**
     * Scopes
     */
    public function scopeFilters(Builder $query, array $filters)
    {
        return $query->when((isset($filters['date_filter']) && !empty($filters['date_filter'])), function ($q) use ($filters) {
            $carbonDatesArray = FormatHelper::daterangepickerStringToCarbonDates($filters['date_filter']);
            return $q->whereBetween('created_at', $carbonDatesArray);
        })
        ->when((isset($filters['seller_filter']) && !empty($filters['seller_filter'])), function ($q) use ($filters) {
            return $q->where('seller_id', $filters['seller_filter']);
        });
    }

    /**
     * Functions
     */
    public function tableRowClass()
    {
        switch ($this->status) {
            case 'approved':
                $class = 'table-success';
                break;
            case 'refused':
                $class = 'table-danger';
                break;
            default:
                $class = 'table-warning';
        }

        return $class;
    }
}
