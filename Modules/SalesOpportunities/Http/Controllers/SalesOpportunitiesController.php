<?php

namespace Modules\SalesOpportunities\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\SalesOpportunities\Contracts\Services\SaleOpportunityServiceInterface;
use Modules\SalesOpportunities\Helpers\SaleOpportunitiesDataHelper;
use Modules\SalesOpportunities\Http\Requests\SaleOpportunityStoreRequest;

class SalesOpportunitiesController extends Controller
{
    private $service;
    private $dataHelper;

    public function __construct(
        SaleOpportunityServiceInterface $saleOpportunityService,
        SaleOpportunitiesDataHelper $saleOpportunitiesDataHelper
    ) {
        $this->service = $saleOpportunityService;
        $this->dataHelper = $saleOpportunitiesDataHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $salesOpportunities = $this->service->getAllSalesOpportunities($request->all());
        $sellers = $this->dataHelper->sellersObjectToSelectFilter();

        return view('salesopportunities::index', [
            'salesOpportunities' => $salesOpportunities,
            'sellers' => $sellers,
            'date_filter' => $request->date_filter,
            'seller_filter' => $request->seller_filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $clientsAutocompleteData = $this->dataHelper->buildClientsObjectToAutocomplete();
        $productsAutocompleteData = $this->dataHelper->buildProductsObjectToAutocomplete();
        $sellersAutocompleteData = $this->dataHelper->buildProductsObjectToAutocomplete();

        return view('salesopportunities::create', [
            'clientsAutocompleteData' => $clientsAutocompleteData,
            'productsAutocompleteData' => $productsAutocompleteData,
            'sellersAutocompleteData' => $sellersAutocompleteData
        ]);
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
