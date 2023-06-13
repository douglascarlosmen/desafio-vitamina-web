<?php

namespace Modules\SalesOpportunities\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\SalesOpportunities\Contracts\Services\SaleOpportunityServiceInterface;
use Modules\SalesOpportunities\Http\Requests\SaleOpportunityStoreRequest;

class SalesOpportunitiesController extends Controller
{
    private $service;

    public function __construct(SaleOpportunityServiceInterface $saleOpportunityService)
    {
        $this->service = $saleOpportunityService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $salesOpportunities = $this->service->getAllSalesOpportunities();
        return view('salesopportunities::index', ['salesOpportunities' => $salesOpportunities]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('salesopportunities::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SaleOpportunityStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->service->saveNewSaleOpportunity($request->except('_token'));
            DB::commit();

            return redirect()->route('sale_opportunity.index')->with('status', 'sale-opportunity-created');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao cadastrar nova oportunidade: ' . $e->getMessage());
        }
    }

    public function approve(int $saleOpportunityId)
    {
        try {
            DB::beginTransaction();
            $this->service->changeSaleOpportunityStatus($saleOpportunityId, 'approved');
            DB::commit();

            return redirect()->route('sale_opportunity.index')->with('status', 'sale-opportunity-approved');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao aprovar oportunidade: ' . $e->getMessage());
        }
    }

    public function refuse(int $saleOpportunityId)
    {
        try {
            DB::beginTransaction();
            $this->service->changeSaleOpportunityStatus($saleOpportunityId, 'refused');
            DB::commit();

            return redirect()->route('sale_opportunity.index')->with('status', 'sale-opportunity-refused');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao recusar oportunidade: ' . $e->getMessage());
        }
    }
}
