<?php

namespace Modules\SalesOpportunities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Clients\Entities\Client;

class SaleOpportunity extends Model
{
    use HasFactory;

    protected $table = 'sales_opportunities';

    protected $fillable = [
        'title',
        'status',
        'client_id'
    ];

    /**
     * Relationships
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
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
