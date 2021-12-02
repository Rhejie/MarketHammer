<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        \DB::table('country')->delete();

        \DB::table('country')->insert([
            [
                "country_code" => "AD",
                "name" => "Andorra",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AE",
                "name" => "United Arab Emirates",
                "currency" => "AED",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AF",
                "name" => "Afghanistan",
                "currency" => "AFN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AG",
                "name" => "Antigua and Barbuda",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AI",
                "name" => "Anguilla",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AL",
                "name" => "Albania",
                "currency" => "ALL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AM",
                "name" => "Armenia",
                "currency" => "AMD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AN",
                "name" => "Netherlands Antilles",
                "currency" => null
,
"created_at" => \Carbon::now()->format('Y-m-d H:i:s')            ],
            [
                "country_code" => "AO",
                "name" => "Angola",
                "currency" => "AOA",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AQ",
                "name" => "Antarctica",
                "currency" => ""
,
"created_at" => \Carbon::now()->format('Y-m-d H:i:s')            ],
            [
                "country_code" => "AR",
                "name" => "Argentina",
                "currency" => "ARS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AS",
                "name" => "American Samoa",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AT",
                "name" => "Austria",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AU",
                "name" => "Australia",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AW",
                "name" => "Aruba",
                "currency" => "AWG",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AX",
                "name" => "Aland Islands",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "AZ",
                "name" => "Azerbaijan",
                "currency" => "AZN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BA",
                "name" => "Bosnia and Herzegovina",
                "currency" => "BAM",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BB",
                "name" => "Barbados",
                "currency" => "BBD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BD",
                "name" => "Bangladesh",
                "currency" => "BDT",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BE",
                "name" => "Belgium",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BF",
                "name" => "Burkina Faso",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BG",
                "name" => "Bulgaria",
                "currency" => "BGN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BH",
                "name" => "Bahrain",
                "currency" => "BHD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BI",
                "name" => "Burundi",
                "currency" => "BIF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BJ",
                "name" => "Benin",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BL",
                "name" => "Saint Barthélemy",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BM",
                "name" => "Bermuda",
                "currency" => "BMD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BN",
                "name" => "Brunei",
                "currency" => "BND",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BO",
                "name" => "Bolivia",
                "currency" => "BOB",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BQ",
                "name" => "Bonaire, Saint Eustatius and Saba ",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BR",
                "name" => "Brazil",
                "currency" => "BRL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BS",
                "name" => "Bahamas",
                "currency" => "BSD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BT",
                "name" => "Bhutan",
                "currency" => "BTN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BV",
                "name" => "Bouvet Island",
                "currency" => "NOK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BW",
                "name" => "Botswana",
                "currency" => "BWP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BY",
                "name" => "Belarus",
                "currency" => "BYR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "BZ",
                "name" => "Belize",
                "currency" => "BZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CA",
                "name" => "Canada",
                "currency" => "CAD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CC",
                "name" => "Cocos Islands",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CD",
                "name" => "Democratic Republic of the Congo",
                "currency" => "CDF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CF",
                "name" => "Central African Republic",
                "currency" => "XAF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CG",
                "name" => "Republic of the Congo",
                "currency" => "XAF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CH",
                "name" => "Switzerland",
                "currency" => "CHF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CI",
                "name" => "Ivory Coast",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CK",
                "name" => "Cook Islands",
                "currency" => "NZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CL",
                "name" => "Chile",
                "currency" => "CLP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CM",
                "name" => "Cameroon",
                "currency" => "XAF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CN",
                "name" => "China",
                "currency" => "CNY",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CO",
                "name" => "Colombia",
                "currency" => "COP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CR",
                "name" => "Costa Rica",
                "currency" => "CRC",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CS",
                "name" => "Serbia and Montenegro",
                "currency" => null
,
"created_at" => \Carbon::now()->format('Y-m-d H:i:s')            ],
            [
                "country_code" => "CU",
                "name" => "Cuba",
                "currency" => "CUP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CV",
                "name" => "Cape Verde",
                "currency" => "CVE",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CW",
                "name" => "Curaçao",
                "currency" => "ANG",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CX",
                "name" => "Christmas Island",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CY",
                "name" => "Cyprus",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "CZ",
                "name" => "Czech Republic",
                "currency" => "CZK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "DE",
                "name" => "Germany",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "DJ",
                "name" => "Djibouti",
                "currency" => "DJF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "DK",
                "name" => "Denmark",
                "currency" => "DKK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "DM",
                "name" => "Dominica",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "DO",
                "name" => "Dominican Republic",
                "currency" => "DOP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "DZ",
                "name" => "Algeria",
                "currency" => "DZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "EC",
                "name" => "Ecuador",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "EE",
                "name" => "Estonia",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "EG",
                "name" => "Egypt",
                "currency" => "EGP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "EH",
                "name" => "Western Sahara",
                "currency" => "MAD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ER",
                "name" => "Eritrea",
                "currency" => "ERN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ES",
                "name" => "Spain",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ET",
                "name" => "Ethiopia",
                "currency" => "ETB",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "FI",
                "name" => "Finland",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "FJ",
                "name" => "Fiji",
                "currency" => "FJD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "FK",
                "name" => "Falkland Islands",
                "currency" => "FKP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "FM",
                "name" => "Micronesia",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "FO",
                "name" => "Faroe Islands",
                "currency" => "DKK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "FR",
                "name" => "France",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GA",
                "name" => "Gabon",
                "currency" => "XAF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GB",
                "name" => "United Kingdom",
                "currency" => "GBP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GD",
                "name" => "Grenada",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GE",
                "name" => "Georgia",
                "currency" => "GEL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GF",
                "name" => "French Guiana",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GG",
                "name" => "Guernsey",
                "currency" => "GBP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GH",
                "name" => "Ghana",
                "currency" => "GHS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GI",
                "name" => "Gibraltar",
                "currency" => "GIP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GL",
                "name" => "Greenland",
                "currency" => "DKK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GM",
                "name" => "Gambia",
                "currency" => "GMD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GN",
                "name" => "Guinea",
                "currency" => "GNF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GP",
                "name" => "Guadeloupe",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GQ",
                "name" => "Equatorial Guinea",
                "currency" => "XAF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GR",
                "name" => "Greece",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GS",
                "name" => "South Georgia and the South Sandwich Islands",
                "currency" => "GBP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GT",
                "name" => "Guatemala",
                "currency" => "GTQ",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GU",
                "name" => "Guam",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GW",
                "name" => "Guinea-Bissau",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "GY",
                "name" => "Guyana",
                "currency" => "GYD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "HK",
                "name" => "Hong Kong",
                "currency" => "HKD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "HM",
                "name" => "Heard Island and McDonald Islands",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "HN",
                "name" => "Honduras",
                "currency" => "HNL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "HR",
                "name" => "Croatia",
                "currency" => "HRK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "HT",
                "name" => "Haiti",
                "currency" => "HTG",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "HU",
                "name" => "Hungary",
                "currency" => "HUF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ID",
                "name" => "Indonesia",
                "currency" => "IDR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IE",
                "name" => "Ireland",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IL",
                "name" => "Israel",
                "currency" => "ILS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IM",
                "name" => "Isle of Man",
                "currency" => "GBP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IN",
                "name" => "India",
                "currency" => "INR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IO",
                "name" => "British Indian Ocean Territory",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IQ",
                "name" => "Iraq",
                "currency" => "IQD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IR",
                "name" => "Iran",
                "currency" => "IRR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IS",
                "name" => "Iceland",
                "currency" => "ISK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "IT",
                "name" => "Italy",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "JE",
                "name" => "Jersey",
                "currency" => "GBP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "JM",
                "name" => "Jamaica",
                "currency" => "JMD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "JO",
                "name" => "Jordan",
                "currency" => "JOD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "JP",
                "name" => "Japan",
                "currency" => "JPY",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KE",
                "name" => "Kenya",
                "currency" => "KES",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KG",
                "name" => "Kyrgyzstan",
                "currency" => "KGS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KH",
                "name" => "Cambodia",
                "currency" => "KHR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KI",
                "name" => "Kiribati",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KM",
                "name" => "Comoros",
                "currency" => "KMF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KN",
                "name" => "Saint Kitts and Nevis",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KP",
                "name" => "North Korea",
                "currency" => "KPW",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KR",
                "name" => "South Korea",
                "currency" => "KRW",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KW",
                "name" => "Kuwait",
                "currency" => "KWD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KY",
                "name" => "Cayman Islands",
                "currency" => "KYD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "KZ",
                "name" => "Kazakhstan",
                "currency" => "KZT",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LA",
                "name" => "Laos",
                "currency" => "LAK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LB",
                "name" => "Lebanon",
                "currency" => "LBP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LC",
                "name" => "Saint Lucia",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LI",
                "name" => "Liechtenstein",
                "currency" => "CHF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LK",
                "name" => "Sri Lanka",
                "currency" => "LKR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LR",
                "name" => "Liberia",
                "currency" => "LRD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LS",
                "name" => "Lesotho",
                "currency" => "LSL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LT",
                "name" => "Lithuania",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LU",
                "name" => "Luxembourg",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LV",
                "name" => "Latvia",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "LY",
                "name" => "Libya",
                "currency" => "LYD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MA",
                "name" => "Morocco",
                "currency" => "MAD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MC",
                "name" => "Monaco",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MD",
                "name" => "Moldova",
                "currency" => "MDL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ME",
                "name" => "Montenegro",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MF",
                "name" => "Saint Martin",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MG",
                "name" => "Madagascar",
                "currency" => "MGA",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MH",
                "name" => "Marshall Islands",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MK",
                "name" => "Macedonia",
                "currency" => "MKD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ML",
                "name" => "Mali",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MM",
                "name" => "Myanmar",
                "currency" => "MMK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MN",
                "name" => "Mongolia",
                "currency" => "MNT",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MO",
                "name" => "Macao",
                "currency" => "MOP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MP",
                "name" => "Northern Mariana Islands",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MQ",
                "name" => "Martinique",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MR",
                "name" => "Mauritania",
                "currency" => "MRO",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MS",
                "name" => "Montserrat",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MT",
                "name" => "Malta",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MU",
                "name" => "Mauritius",
                "currency" => "MUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MV",
                "name" => "Maldives",
                "currency" => "MVR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MW",
                "name" => "Malawi",
                "currency" => "MWK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MX",
                "name" => "Mexico",
                "currency" => "MXN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MY",
                "name" => "Malaysia",
                "currency" => "MYR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "MZ",
                "name" => "Mozambique",
                "currency" => "MZN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NA",
                "name" => "Namibia",
                "currency" => "NAD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NC",
                "name" => "New Caledonia",
                "currency" => "XPF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NE",
                "name" => "Niger",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NF",
                "name" => "Norfolk Island",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NG",
                "name" => "Nigeria",
                "currency" => "NGN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NI",
                "name" => "Nicaragua",
                "currency" => "NIO",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NL",
                "name" => "Netherlands",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NO",
                "name" => "Norway",
                "currency" => "NOK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NP",
                "name" => "Nepal",
                "currency" => "NPR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NR",
                "name" => "Nauru",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NU",
                "name" => "Niue",
                "currency" => "NZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "NZ",
                "name" => "New Zealand",
                "currency" => "NZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "OM",
                "name" => "Oman",
                "currency" => "OMR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PA",
                "name" => "Panama",
                "currency" => "PAB",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PE",
                "name" => "Peru",
                "currency" => "PEN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PF",
                "name" => "French Polynesia",
                "currency" => "XPF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PG",
                "name" => "Papua New Guinea",
                "currency" => "PGK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PH",
                "name" => "Philippines",
                "currency" => "PHP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PK",
                "name" => "Pakistan",
                "currency" => "PKR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PL",
                "name" => "Poland",
                "currency" => "PLN",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PM",
                "name" => "Saint Pierre and Miquelon",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PN",
                "name" => "Pitcairn",
                "currency" => "NZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PR",
                "name" => "Puerto Rico",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PS",
                "name" => "Palestinian Territory",
                "currency" => "ILS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PT",
                "name" => "Portugal",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PW",
                "name" => "Palau",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "PY",
                "name" => "Paraguay",
                "currency" => "PYG",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "QA",
                "name" => "Qatar",
                "currency" => "QAR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "RE",
                "name" => "Reunion",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "RO",
                "name" => "Romania",
                "currency" => "RON",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "RS",
                "name" => "Serbia",
                "currency" => "RSD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "RU",
                "name" => "Russia",
                "currency" => "RUB",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "RW",
                "name" => "Rwanda",
                "currency" => "RWF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SA",
                "name" => "Saudi Arabia",
                "currency" => "SAR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SB",
                "name" => "Solomon Islands",
                "currency" => "SBD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SC",
                "name" => "Seychelles",
                "currency" => "SCR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SD",
                "name" => "Sudan",
                "currency" => "SDG",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SE",
                "name" => "Sweden",
                "currency" => "SEK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SG",
                "name" => "Singapore",
                "currency" => "SGD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SH",
                "name" => "Saint Helena",
                "currency" => "SHP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SI",
                "name" => "Slovenia",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SJ",
                "name" => "Svalbard and Jan Mayen",
                "currency" => "NOK",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SK",
                "name" => "Slovakia",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SL",
                "name" => "Sierra Leone",
                "currency" => "SLL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SM",
                "name" => "San Marino",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SN",
                "name" => "Senegal",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SO",
                "name" => "Somalia",
                "currency" => "SOS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SR",
                "name" => "Suriname",
                "currency" => "SRD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SS",
                "name" => "South Sudan",
                "currency" => "SSP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ST",
                "name" => "Sao Tome and Principe",
                "currency" => "STD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SV",
                "name" => "El Salvador",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SX",
                "name" => "Sint Maarten",
                "currency" => "ANG",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SY",
                "name" => "Syria",
                "currency" => "SYP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "SZ",
                "name" => "Swaziland",
                "currency" => "SZL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TC",
                "name" => "Turks and Caicos Islands",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TD",
                "name" => "Chad",
                "currency" => "XAF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TF",
                "name" => "French Southern Territories",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TG",
                "name" => "Togo",
                "currency" => "XOF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TH",
                "name" => "Thailand",
                "currency" => "THB",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TJ",
                "name" => "Tajikistan",
                "currency" => "TJS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TK",
                "name" => "Tokelau",
                "currency" => "NZD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TL",
                "name" => "East Timor",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TM",
                "name" => "Turkmenistan",
                "currency" => "TMT",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TN",
                "name" => "Tunisia",
                "currency" => "TND",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TO",
                "name" => "Tonga",
                "currency" => "TOP",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TR",
                "name" => "Turkey",
                "currency" => "TRY",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TT",
                "name" => "Trinidad and Tobago",
                "currency" => "TTD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TV",
                "name" => "Tuvalu",
                "currency" => "AUD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TW",
                "name" => "Taiwan",
                "currency" => "TWD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "TZ",
                "name" => "Tanzania",
                "currency" => "TZS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "UA",
                "name" => "Ukraine",
                "currency" => "UAH",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "UG",
                "name" => "Uganda",
                "currency" => "UGX",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "UM",
                "name" => "United States Minor Outlying Islands",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "US",
                "name" => "United States",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "UY",
                "name" => "Uruguay",
                "currency" => "UYU",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "UZ",
                "name" => "Uzbekistan",
                "currency" => "UZS",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VA",
                "name" => "Vatican",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VC",
                "name" => "Saint Vincent and the Grenadines",
                "currency" => "XCD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VE",
                "name" => "Venezuela",
                "currency" => "VEF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VG",
                "name" => "British Virgin Islands",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VI",
                "name" => "U.S. Virgin Islands",
                "currency" => "USD",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VN",
                "name" => "Vietnam",
                "currency" => "VND",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "VU",
                "name" => "Vanuatu",
                "currency" => "VUV",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "WF",
                "name" => "Wallis and Futuna",
                "currency" => "XPF",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "WS",
                "name" => "Samoa",
                "currency" => "WST",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "XK",
                "name" => "Kosovo",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "YE",
                "name" => "Yemen",
                "currency" => "YER",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "YT",
                "name" => "Mayotte",
                "currency" => "EUR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ZA",
                "name" => "South Africa",
                "currency" => "ZAR",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ZM",
                "name" => "Zambia",
                "currency" => "ZMW",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "country_code" => "ZW",
                "name" => "Zimbabwe",
                "currency" => "ZWL",
                "created_at" => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
