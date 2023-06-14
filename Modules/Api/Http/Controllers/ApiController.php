<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\SalesOpportunities\Contracts\Services\SaleOpportunityServiceInterface;

class ApiController extends Controller
{
    private $service;

    public function __construct(SaleOpportunityServiceInterface $saleOpportunityService)
    {
        $this->service = $saleOpportunityService;
    }

    public function salesOpportunities(Request $request)
    {
        try {
            return response()->json([
                'data' => $this->service->getAllSalesOpportunities($request->all())
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao obter as oportunidades de venda pela API: ' . $e->getMessage());
            return response()->json([
                'error' => 'Não foi possível obter as oportunidades de venda'
            ], 500);
        }
    }
}
