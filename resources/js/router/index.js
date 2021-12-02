/*
 * This page will handle all the Vue routing within the application
 *
 * @author Chaps
 */

// Vue and Vue Router
import Vue from "vue";
import VueRouter from "vue-router";

// Register Vue Router
Vue.use(VueRouter);

// Backend: Settings
const SettingsIndex = () =>
    import("../components/backoffice/Setting/SettingMainComponent.vue");
const SettingsNavigations = () =>
    import("../components/backoffice/Setting/SettingNavigation.vue");
const SettingsCertificates = () =>
    import("../components/backoffice/Certification/CertificationIndex.vue");
const SettingsCertificationHolder = () =>
    import(
        "../components/backoffice/Certification/CertificationHolderIndex.vue"
    );
const SettingsMaterialType = () =>
    import("../components/backoffice/Material/MaterialTypeIndex.vue");
const SettingsHazardousSubstance = () =>
    import("../components/backoffice/Substance/HazardousSubstanceIndex.vue");
const SettingsEmployeeCount = () =>
    import("../components/backoffice/SystemData/EmployeeCountIndex.vue");
const SettingsUnitOfMeasure = () =>
    import("../components/backoffice/UnitOfMeasure/UnitOfMeasureList.vue");
const SettingsMachineType = () =>
    import("../components/backoffice/Machine/MachineTypeList.vue");
const SettingsMachineManufacturers = () =>
    import("../components/backoffice/Machine/MachineManufacturerList.vue");
const SettingsProcessType = () =>
    import("../components/backoffice/Machine/MachineProcessTypeList.vue");
const SettingsMaterial = () =>
    import("../components/backoffice/Material/MaterialIndex.vue");
const SettingsIndustryType = () =>
    import("../components/backoffice/IndustryType/IndustryTypeIndex.vue");
const SettingsBusinessCategory = () =>
    import(
        "../components/backoffice/BusinessCategory/BusinessCategoryIndex.vue"
    );
const SettingsProductCategory = () =>
    import("../components/backoffice/Product/ProductCategoryList.vue");
const SettingsTranslations = () =>
    import("../components/backoffice/Translations/TranslationsIndex.vue");
const SettingsCountry = () =>
    import("../components/backoffice/Country/CountryList.vue");
const SettingsSnsList = () =>
    import("../components/backoffice/Sns/SnsList.vue");
const SettingsQsaCriteria = () =>
    import("../components/backoffice/Qsa/QsaCriteriaIndex.vue");
const SettingsQsaType = () =>
    import("../components/backoffice/Qsa/QsaTypeIndex.vue");
const SettingsQsaList = () =>
    import("../components/backoffice/Qsa/QsaListIndex.vue");
const SettingsFactoryTypes = () =>
    import("../components/backoffice/Factory/FactoryTypeList.vue");
const SettingsAddressTypes = () =>
    import("../components/backoffice/Address/AddressTypeList.vue");
const SettingsCertificationTypes = () =>
    import("../components/backoffice/Certification/CertificationTypeList.vue");
const SettingsBusinessLevels = () =>
    import("../components/backoffice/BusinessLevel/BusinessLevelList.vue");
const SettingsContactRole = () =>
    import("../components/backoffice/SystemData/ContactRoleIndex.vue");
const SettingsArea = () =>
    import("../components/backoffice/Area/AreaIndex.vue");
const SettingComplexType = () =>
    import("../components/backoffice/Complex/ComplexTypeIndex.vue");
const SettingComplexLocation = () =>
    import("../components/backoffice/Complex/ComplexLocation.vue");
const SettingGlobalKeyword = () =>
    import("../components/backoffice/SystemData/GlobalKeywordIndex");
const SettingFormFieldManagement = () =>
    import(
        "../components/backoffice/FormFieldManagement/FormFieldManagementIndex"
    );
const SettingFormStatus = () =>
    import("../components/backoffice/FormSubmissionStatus/FormStatusIndex");
const SettingFormType = () =>
    import("../components/backoffice/FormType/FormTypeIndex");
const SettingSupplierStatus = () =>
    import("../components/backoffice/SupplierStatus/SupplierStatusIndex");
const SettingOperationCondition = () =>
    import(
        "../components/backoffice/OperationCondition/OperationConditionIndex"
    );
const SettingsProcessesComponent = () =>
    import("../components/backoffice/Processes/ProcessessIndex.vue");

//Contact List
const ContactMainComponent = () =>
    import("../components/supplier/Contact/ContactMainComponent");
const SupplierContactMain = () =>
    import("../components/supplier/SupplierContactMain");
const BuyerContactMain = () => import("../components/buyer/BuyerContactMain");
const SupplierContactDetails = () =>
    import("../components/supplier/Contact/SupplierContactDetails");

// Buyer
const BuyerFormTemplateIndex = () =>
    import("../components/buyer/BuyerFormTemplate/BuyerFormTemplateIndex.vue");
const BuyerFormTemplateBuilder = () =>
    import(
        "../components/buyer/BuyerFormTemplate/BuyerFormTemplateBuilder.vue"
    );

//Business List
const BusinessMainComponent = () =>
    import("../components/backoffice/Company/BusinessListMainComponent");
const BusinessList = () => import("../components/backoffice/BusinessList");
const BusinessDetailView = () =>
    import("../components/backoffice/Company/BusinessDetailView");

//Supplier Template Form
const SupplierFormDetails = () =>
    import("../components/supplier/RFQ/SupplierFormDetails");
const SupplierRfqList = () =>
    import("../components/supplier/RFQ/SupplierRfqList");

export default new VueRouter({
    linkActiveClass: "active",
    linkExactActiveClass: "",
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: "/",
            name: "Settings Index",
            component: SettingsIndex,
            children: [
                {
                    path: "/",
                    name: "Settings Navigation",
                    component: SettingsNavigations
                },
                {
                    path: "/system-data/industry-type",
                    name: "Settings Industry Type",
                    component: SettingsIndustryType,
                    props: true
                },
                {
                    path: "/system-data/certifications",
                    name: "Settings Certificates",
                    component: SettingsCertificates,
                    props: true
                },
                {
                    path: "/system-data/country",
                    name: "Settings Country",
                    component: SettingsCountry,
                    props: true
                },
                {
                    path: "/system-data/certification-holder",
                    name: "Settings Certification Holder",
                    component: SettingsCertificationHolder,
                    props: true
                },
                {
                    path: "/system-data/material-type",
                    name: "Settings Material Type",
                    component: SettingsMaterialType,
                    props: true
                },
                {
                    path: "/system-data/hazardous-substance",
                    name: "Settings Hazardous Substances",
                    component: SettingsHazardousSubstance,
                    props: true
                },
                {
                    path: "/system-data/employee-count",
                    name: "Settings Employee Count",
                    component: SettingsEmployeeCount,
                    props: true
                },
                {
                    path: "/system-data/unit-measure",
                    name: "Settings Unit Of Measure",
                    component: SettingsUnitOfMeasure,
                    props: true
                },
                {
                    path: "/system-data/machine-type",
                    name: "Settings Machine Type",
                    component: SettingsMachineType,
                    props: true
                },
                {
                    path: "/system-data/machine-manufacturer",
                    name: "Settings Machine Manufacturers",
                    component: SettingsMachineManufacturers,
                    props: true
                },
                {
                    path: "/system-data/machine-process-type",
                    name: "Settings Process Type",
                    component: SettingsProcessType,
                    props: true
                },
                {
                    path: "/system-data/material",
                    name: "Settings Material",
                    component: SettingsMaterial,
                    props: true
                },

                {
                    path: "/system-data/business-category",
                    name: "Settings Business Category",
                    component: SettingsBusinessCategory,
                    props: true
                },
                {
                    path: "/system-data/product-category",
                    name: "Settings Product Category",
                    component: SettingsProductCategory,
                    props: true
                },
                {
                    path: "/system-data/translations",
                    name: "Settings Translations",
                    component: SettingsTranslations,
                    props: true
                },
                {
                    path: "/system-data/sns-list",
                    name: "Settings SNS List",
                    component: SettingsSnsList,
                    props: true
                },
                {
                    path: "/system-data/qsa-criteria",
                    name: "Settings QSA Criteria",
                    component: SettingsQsaCriteria,
                    props: true
                },
                {
                    path: "/system-data/qsa-type",
                    name: "Settings QSA Type",
                    component: SettingsQsaType,
                    props: true
                },
                {
                    path: "/system-data/factory-types",
                    name: "Settings Factory Types",
                    component: SettingsFactoryTypes,
                    props: true
                },
                {
                    path: "/system-data/address-types",
                    name: "Settings Address Types",
                    component: SettingsAddressTypes,
                    props: true
                },
                {
                    path: "/system-data/certification-types",
                    name: "Settings Certification Types",
                    component: SettingsCertificationTypes,
                    props: true
                },
                {
                    path: "/system-data/qsa-list",
                    name: "Settings QSA List",
                    component: SettingsQsaList,
                    props: true
                },
                {
                    path: "/system-data/business-levels",
                    name: "Settings Business Levels",
                    component: SettingsBusinessLevels,
                    props: true
                },
                {
                    path: "/system-data/contact-role",
                    name: "Settings Role",
                    component: SettingsContactRole,
                    props: true
                },
                {
                    path: "/system-data/area",
                    name: "Settings Area",
                    component: SettingsArea,
                    props: true
                },
                {
                    path: "/system-data/complex-type",
                    name: "Settings Complex Type",
                    component: SettingComplexType,
                    props: true
                },
                {
                    path: "/system-data/complex-location",
                    name: "Settings Complex Location",
                    component: SettingComplexLocation,
                    props: true
                },
                {
                    path: "/system-data/keywords",
                    name: "Settings Global Keywords",
                    component: SettingGlobalKeyword,
                    props: true
                },
                {
                    path: "/system-data/form-field-management",
                    name: "Form Field Management",
                    component: SettingFormFieldManagement,
                    alias: [
                        "/system-data/form-field-management/form-field-group",
                        "/system-data/form-field-management/form-field"
                    ],
                    props: true
                },
                {
                    path: "/system-data/processes",
                    name: "Settings Processes",
                    component: SettingsProcessesComponent,
                    props: true
                },
                {
                    path: "/system-data/form-status",
                    name: "Settings Form Status",
                    component: SettingFormStatus,
                    props: true
                },
                {
                    path: "/system-data/form-type",
                    name: "Settings Form Type",
                    component: SettingFormType,
                    props: true
                },
                {
                    path: "/system-data/supplier-status",
                    name: "Settings Supplier Status",
                    component: SettingSupplierStatus,
                    props: true
                },
                {
                    path: "/system-data/operation-condition",
                    name: "Settings Operation Condition",
                    component: SettingOperationCondition,
                    props: true
                }
            ]
        },
        {
            path: "/list",
            name: "Contact List",
            props: true,
            component: ContactMainComponent,
            children: [
                {
                    path: "/slist",
                    name: "Supplier Contact List",
                    component: SupplierContactMain,
                    props: true
                },
                {
                    path: "/blist",
                    name: "Buyer Contact List",
                    component: BuyerContactMain,
                    props: true
                },
                {
                    path: "/view/:id",
                    name: "Contact Details",
                    component: SupplierContactDetails,
                    props: true
                }
            ]
        },
        {
            path: "/business",
            name: "Business Page",
            props: true,
            component: BusinessMainComponent,
            children: [
                {
                    path: "/business/list",
                    name: "Business List",
                    component: BusinessList,
                    props: true,
                    alias: "/business"
                },
                {
                    path: "/business/view/:id",
                    name: "Business Detail",
                    component: BusinessDetailView,
                    props: { config: { reloadData: false } }
                }
            ]
        },
        {
            path: "/buyer-form-template-list",
            name: "Buyer Form Template List",
            props: true,
            component: BuyerFormTemplateIndex
        },
        {
            path: "/buyer-form-template-list/:id",
            name: "Buyer Form Template Builder",
            props: true,
            component: BuyerFormTemplateBuilder
        },
        {
            path: "/supplier-rfq-list",
            name: "Supplier RFQ List",
            props: true,
            component: SupplierRfqList
        },
        {
            path: "/supplier-rfq-details/:id",
            name: "Supplier RFQ Details",
            props: true,
            component: SupplierFormDetails
        },


    ]
});
