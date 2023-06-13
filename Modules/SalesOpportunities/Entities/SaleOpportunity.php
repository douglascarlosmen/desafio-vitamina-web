<?php

namespace Modules\SalesOpportunities\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleOpportunity extends Model
{
    use HasFactory;

    protected $table = 'sales_opportunities';

    protected $fillable = ['title', 'status'];

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
