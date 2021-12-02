<?php

/****************************************
 * Methods registered here are global.
 * Make sure to prefix the method with __,
 * just to make sure we avoid conflict.
 */

/**
 * Checks whether the given data is a null or undefined in type string
 *
 * @param $data <mixed> - the data to be checked
 * @param $returnNull <boolean> - whether to return a boolean value if data is null or undefined
 *
 * @return <mixed>
 */
function __is_null_undefined($data, $returnNull = true)
{
    $isInvalid = in_array($data, ['null', 'undefined']);

    if ($isInvalid) {
        return $returnNull ? null : $data;
    }

    return $data;
}

/**
 * Returns a Carbon Instance in UTC
 *
 * @return <Carbon>
 */
function __utc_time_now()
{
    date_default_timezone_set('UTC');

    return (new \Carbon())->now();
}

/**
 * Get list of countries.
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_country_list($select = null)
{
    $countries = \App\Model\Country::select(['id', 'country_code', 'name'])->localeTranslation();

    if ($select) {
        $countries->select($select);
    }

    $countries = $countries->get()->toArray();

    return $countries;
}

/**
 * Get list of address types
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_address_types($select = null)
{
    $addressTypes = \App\Model\Setting\AddressType::select(['id', 'name', 'description']);

    if ($select) {
        $addressTypes->select($select);
    }

    $addressTypes = $addressTypes->get()->toArray();

    return $addressTypes;
}

/**
 * Get list of factory
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_factory_types($select = null)
{
    $addressTypes = \App\Model\Setting\FactoryType::select(['id', 'name', 'description']);

    if ($select) {
        $addressTypes->select($select);
    }

    $addressTypes = $addressTypes->get()->toArray();

    return $addressTypes;
}

/**
 * Get list of industry types
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_industry_types($select = null)
{
    $industryTypes = \App\Model\IndustryType::select(['id', 'name', 'description']);

    if ($select) {
        $industryTypes->select($select);
    }

    $industryTypes = $industryTypes->get()->toArray();

    return $industryTypes;
}

/**
 * Get list of business categories
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_business_categories($select = null)
{
    $categories = \App\Model\BusinessCategory::select(['id', 'name', 'description'])
        ->localeTranslation();

    if ($select) {
        $categories->select($select);
    }

    $categories = $categories->get()->toArray();

    return $categories;
}

/**
 * Get list of employee counts
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_employee_counts($select = null)
{
    $categories = \App\Model\EmployeeCount::select(['id', 'name', 'description'])
        ->localeTranslation();

    if ($select) {
        $categories->select($select);
    }

    $categories = $categories->get()->toArray();

    return $categories;
}

/**
 * Get list of social media platforms
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_sns_list($select = null)
{
    $categories = \App\Model\Setting\SnsList::select(['id', 'name', 'website', 'color']);

    if ($select) {
        $categories->select($select);
    }

    $categories = $categories->get()->toArray();

    return $categories;
}

/**
 * Insert new line character to a string in every word count interval.
 *
 * @param $string <string>
 * @param $wordCount <int> - word count interval. Note this is +1 from the string index.
 *
 * @return <string>
 */
function __insert_new_line_char(string $string, int $wordCount)
{
    if (!$string) {
        return '';
    }

    $exploded = explode(" ", $string);

    $count = 0;
    foreach ($exploded as $key => $word) {
        $count++;

        if ($count == $wordCount) {
            $exploded[$key] = $word . "\n";
            $count = 0;
        }
    }

    return implode(" ", $exploded);
}

/**
 * Get list of user types
 *
 * @param $select <string> - if present, it will return the columns specified
 *
 * @return <array>
 */
function __get_user_types($select = null)
{
    $userTypes = \App\Model\UserType::select(['id', 'name', 'code']);

    if ($select) {
        $userTypes->select($select);
    }

    $userTypes = $userTypes->get()->toArray();

    return $userTypes;
}

function __get_complex_types()
{
    $complex = \App\Model\ComplexType::select(['id', 'name'])
        ->localeTranslation();

    $complex = $complex->get();

    return $complex;
}

function __get_complex_locations()
{
    $complex = \App\Model\ComplexLocation::select(['id', 'name'])
        ->localeTranslation();

    $complex = $complex->get();

    return $complex;
}

function __get_usage_area()
{

    $area = \App\Model\UsageArea::select(['id', 'name']);

    $area = $area->get();

    return $area;
}

function ___get_suppliers($query)
{
    if($query) {
        $supplier = \App\Model\Business::whereDoesntHave('userBusiness')
            ->whereNull('deleted_at')
            ->where(function ($q) use ($query) {
                $q->orWhere('legal_name', 'LIKE', "%$query%");
            })->select(['id', 'legal_name'])->limit(5);
    }

    return $supplier->get();
}


function _remove_special_char($term, $required = true)
{
    // removing symbols used by MySQL
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    $term = str_replace($reservedSymbols, '', $term);
    return $term;
}

/**
 * Replaces spaces with full text search wildcards
 *
 * @param string $term
 * @return string
 */
function _full_text_wildcards($term, $required = true)
{
    // removing symbols used by MySQL
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    $term = str_replace($reservedSymbols, '', $term);

    $words = explode(' ', $term);

    foreach($words as $key => $word) {
        /*
         * applying + operator (required word) only big words
         * because smaller ones are not indexed by mysql
         */
        if(strlen($word) >= 3) {
            $words[$key] = "";
            if($required) $words[$key] = '+';
            $words[$key] .= $word . '*';
        }
    }

    $searchTerm = implode( ' ', $words);

    return $searchTerm;
}

function _remove_char_with_len($term, $length)
{
    $words = explode(' ', $term);

    $termWord = [];
    foreach($words as $key => $word) {
        if(strlen($word) >= $length) {
            array_push($termWord, $word);
        }
    }

    $searchTerm = implode( ' ', $termWord);

    return $searchTerm;
}

function __get_form_types()
{

    $form_types = \App\Model\FormType::whereNull('deleted_at')->select(['id', 'name']);

    return $form_types->get();
}

function __get_form_status()
{

    $form_status = \App\Model\FormSubmissionStatus::whereNull('deleted_at')->select(['id', 'name']);

    return $form_status->get();

}

function __check_table_column_exist($table, $columns){
    $getTableColumns = __get_table_columns($table);
    if(in_array($columns, $getTableColumns)){
        return true;
    }
    return false;
}

function __get_table_columns($table) {
    $columns = \Illuminate\Support\Facades\DB::getSchemaBuilder()->getColumnListing($table);
    return $columns;
}
