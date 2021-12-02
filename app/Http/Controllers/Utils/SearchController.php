<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\{State};
use App\Repositories\Certification\{CertificationHolderRepository, CertificationTypeRepository};
use App\Repositories\Material\{MaterialTypeRepository, MaterialRepository};
use App\Repositories\IndustryType\IndustryTypeRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\SystemData\UnitOfMeasureRepository;
use App\Repositories\Machine\MachineTypeRepository;
use App\Repositories\Machine\MachineManufacturerRepository;
use App\Repositories\Machine\MachineProcessTypeRepository;
use App\Repositories\QSA\QsaCriteriaRepository;
use App\Repositories\QSA\QsaTypeRepository;
use App\Repositories\SystemData\ContactRoleRepository;
use App\Repositories\Category\BusinessCategoryRepository;
use App\Repositories\Complex\{ComplexLocationRepository, ComplexTypeRepository};
use App\Repositories\User\AuditTrailRepository;



class SearchController extends Controller
{
    public function __construct(
        MaterialTypeRepository $materialTypeRepository,
        UnitOfMeasureRepository $unitOfMeasureRepository,
        ProductCategoryRepository $productCategoryRepository,
        MachineTypeRepository $machineTypeRepository,
        MachineManufacturerRepository $machineManufacturerRepository,
        MachineProcessTypeRepository $machineProcessTypeRepository,
        QsaCriteriaRepository $qsaCriteriaRepository,
        QsaTypeRepository $qsaTypeRepository,
        ContactRoleRepository $contactRoleRepository,
        IndustryTypeRepository $industryTypeRepository,
        CertificationTypeRepository $certificationTypeRepository,
        BusinessCategoryRepository $businessCategoryRepository,
        MaterialRepository $materialRepository,
        ComplexLocationRepository $complexLocationRepository,
        ComplexTypeRepository $complexTypeRepository,
        AuditTrailRepository $auditTrailRepository
    ) {
        $this->materialTypeRepository = $materialTypeRepository;
        $this->unitOfMeasureRepository = $unitOfMeasureRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->machineTypeRepository = $machineTypeRepository;
        $this->machineManufacturerRepository = $machineManufacturerRepository;
        $this->machineProcessTypeRepository = $machineProcessTypeRepository;
        $this->qsaCriteriaRepository = $qsaCriteriaRepository;
        $this->qsaTypeRepository = $qsaTypeRepository;
        $this->contactRoleRepository = $contactRoleRepository;
        $this->industryTypeRepository = $industryTypeRepository;
        $this->certificationTypeRepository = $certificationTypeRepository;
        $this->businessCategoryRepository = $businessCategoryRepository;
        $this->materialRepository = $materialRepository;
        $this->complexLocationRepository = $complexLocationRepository;
        $this->complexTypeRepository = $complexTypeRepository;
        $this->auditTrailRepository = $auditTrailRepository;
    }

    public function getStates(Request $request, $country_id)
    {
        $states = State::select()->localeTranslation();

        // if ($request->has('country_id')) {
        //     $states->where('country_id', $request->input('country_id'));
        // }

        if ($country_id != null) {
            $states->where('country_id', $country_id);
        }

        // return $states->get()->toArray();
        return response()->json([
            'states' => $states->get()
        ], 200);
    }

    public function getMetaData(Request $request)
    {

        $toLoad = $request->input('toLoad');
        if($toLoad && is_array($toLoad)){

            if (in_array('certification_holder', $toLoad)) {
                $meta['certification_holder'] = (new CertificationHolderRepository())->getAll();
            }

            if (in_array('certification_types', $toLoad)) {
                $meta['certification_types'] = $this->certificationTypeRepository->getCertificationTypes();
            }

            if (in_array('material_type', $toLoad)) {
                $meta['material_type'] = $this->materialTypeRepository->all();
            }

            if (in_array('industry_type', $toLoad)) {
                $meta['industry_type'] = $this->industryTypeRepository->getIndustryTypes();
            }

            if (in_array('unit_measure', $toLoad)) {
                $meta['unit_measure'] = $this->unitOfMeasureRepository->all();
            }

            if (in_array('product_category', $toLoad)) {
                $meta['product_category'] = $this->productCategoryRepository->all();
            }

            if (in_array('machine_type', $toLoad)) {
                $meta['machine_type'] = $this->machineTypeRepository->all();
            }

            if (in_array('machine_manaufacturer', $toLoad)) {
                $meta['machine_manaufacturer'] = $this->machineManufacturerRepository->all();
            }

            if (in_array('machine_process_type', $toLoad)) {
                $meta['machine_process_type'] = $this->machineProcessTypeRepository->allWithTrans();
            }

            if (in_array('qsa_criteria', $toLoad)) {
                $meta['qsa_criteria'] = $this->qsaCriteriaRepository->all();
            }

            if (in_array('qsa_type', $toLoad)) {
                $meta['qsa_type'] = $this->qsaTypeRepository->all();
            }

            if (in_array('contact_role', $toLoad)) {
                $meta['contact_role'] = $this->contactRoleRepository->all();
            }

            if (in_array('factory_type', $toLoad)) {
                $meta['factory_type'] = __get_factory_types();
            }

            if (in_array('address_types', $toLoad)) {
                $meta['address_types'] = __get_address_types();
            }

            if (in_array('countries', $toLoad)) {
                $meta['countries'] = __get_country_list();
            }

            if (in_array('employee_counts', $toLoad)) {
                $meta['employee_counts'] = __get_employee_counts();
            }

            if (in_array('certifications', $toLoad)) {
                $meta['certifications'] = \App\Repositories\Business\BusinessCertificationRepository::getCertifications();
            }

            if (in_array('business_category', $toLoad)) {
                $param = (object) ['type' => 'detail'];
                $meta['business_category'] = $this->businessCategoryRepository->getCategoryList($param);
            }

            if (in_array('materials', $toLoad)) {
                $meta['materials'] = $this->materialRepository->allWithTrans();
            }

            if (in_array('complex_type', $toLoad)) {
                $meta['complex_type'] = $this->complexTypeRepository->model()->localeTranslation()->get();
            }

            if (in_array('complex_location', $toLoad)) {
                $meta['complex_location'] = $this->complexLocationRepository->model()->localeTranslation()->get();
            }

            if (in_array('recent_search', $toLoad)) {
                $meta['recent_search'] = $this->auditTrailRepository->getRecentSearch($request);
            }

            if (in_array('common_search', $toLoad) || (in_array('recent_search', $toLoad) && count($meta['recent_search']) == 0 )) {
                $meta['common_search'] = $this->auditTrailRepository->getCommonSearch($request);
            }

        }
        return $meta;
    }
}
