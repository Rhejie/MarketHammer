<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        \DB::table('state')->delete();

        \DB::table('state')->insert([
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "AL",
                "name" => "Alabama"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "AK",
                "name" => "Alaska"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "AZ",
                "name" => "Arizona"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "AR",
                "name" => "Arkansas"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "CA",
                "name" => "California"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "CO",
                "name" => "Colorado"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "CT",
                "name" => "Connecticut"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "DE",
                "name" => "Delaware"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "FL",
                "name" => "Florida"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "GA",
                "name" => "Georgia"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "HI",
                "name" => "Hawaii"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "ID",
                "name" => "Idaho"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "IL",
                "name" => "Illinois"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "IN",
                "name" => "Indiana"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "IA",
                "name" => "Iowa"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "KS",
                "name" => "Kansas"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "KY",
                "name" => "Kentucky"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "LA",
                "name" => "Louisiana"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "ME",
                "name" => "Maine"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MD",
                "name" => "Maryland"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MA",
                "name" => "Massachusetts"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MI",
                "name" => "Michigan"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MN",
                "name" => "Minnesota"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MS",
                "name" => "Mississippi"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MO",
                "name" => "Missouri"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MT",
                "name" => "Montana"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NE",
                "name" => "Nebraska"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NV",
                "name" => "Nevada"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NH",
                "name" => "New Hampshire"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NJ",
                "name" => "New Jersey"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NM",
                "name" => "New Mexico"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NY",
                "name" => "New York"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "NC",
                "name" => "North Carolina"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "ND",
                "name" => "North Dakota"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "OH",
                "name" => "Ohio"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "OK",
                "name" => "Oklahoma"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "OR",
                "name" => "Oregon"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "PA",
                "name" => "Pennsylvania"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "RI",
                "name" => "Rhode Island"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "SC",
                "name" => "South Carolina"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "SD",
                "name" => "South Dakota"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "TN",
                "name" => "Tennessee"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "TX",
                "name" => "Texas"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "UT",
                "name" => "Utah"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "VT",
                "name" => "Vermont"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "VA",
                "name" => "Virginia"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "WA",
                "name" => "Washington"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "WV",
                "name" => "West Virginia"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "WI",
                "name" => "Wisconsin"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "WY",
                "name" => "Wyoming"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "PR",
                "name" => "Puerto Rico [Outlying area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "VI",
                "name" => "Virgin Islands, U.S. [Outlying area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "DC",
                "name" => "District of Columbia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "AGU",
                "name" => "Aguascalientes"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "BCN",
                "name" => "Baja California"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "BCS",
                "name" => "Baja California Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "CAM",
                "name" => "Campeche"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "CHP",
                "name" => "Chiapas"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "CHH",
                "name" => "Chihuahua"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "COA",
                "name" => "Coahuila"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "COL",
                "name" => "Colima"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "DIF",
                "name" => "Distrito Federal [Federal district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "DUR",
                "name" => "Durango"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "GUA",
                "name" => "Guanajuato"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "GRO",
                "name" => "Guerrero"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "HID",
                "name" => "Hidalgo"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "JAL",
                "name" => "Jalisco"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "MEX",
                "name" => "México"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "MIC",
                "name" => "Michoacán"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "MOR",
                "name" => "Morelos"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "NAY",
                "name" => "Nayarit"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "NLE",
                "name" => "Nuevo León"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "OAX",
                "name" => "Oaxaca"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "PUE",
                "name" => "Puebla"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "QUE",
                "name" => "Querétaro"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "ROO",
                "name" => "Quintana Roo"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "SLP",
                "name" => "San Luis Potosí"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "SIN",
                "name" => "Sinaloa"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "SON",
                "name" => "Sonora"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "TAB",
                "name" => "Tabasco"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "TAM",
                "name" => "Tamaulipas"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "TLA",
                "name" => "Tlaxcala"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "VER",
                "name" => "Veracruz"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "YUC",
                "name" => "Yucatán"
            ],
            [
                "country_id" => 0,
                "country_code" => "MX",
                "code" => "ZAC",
                "name" => "Zacatecas"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "ON",
                "name" => "Ontario"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "QC",
                "name" => "Quebec"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "BC",
                "name" => "British Columbia"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "AB",
                "name" => "Alberta"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "MB",
                "name" => "Manitoba"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "SK",
                "name" => "Saskatchewan"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "NS",
                "name" => "Nova Scotia"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "NB",
                "name" => "New Brunswick"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "NL",
                "name" => "Newfoundland and Labrador"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "PE",
                "name" => "Prince Edward Island"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "NT",
                "name" => "Northwest Territories [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "YT",
                "name" => "Yukon Territory [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CA",
                "code" => "NU",
                "name" => "Nunavut [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "B",
                "name" => "Buenos Aires"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "K",
                "name" => "Catamarca"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "H",
                "name" => "Chaco"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "U",
                "name" => "Chubut"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "C",
                "name" => "Ciudad Autónoma de Buenos Aires [Federal district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "X",
                "name" => "Córdoba"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "W",
                "name" => "Corrientes"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "E",
                "name" => "Entre Ríos"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "P",
                "name" => "Formosa"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "Y",
                "name" => "Jujuy"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "L",
                "name" => "La Pampa"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "F",
                "name" => "La Rioja"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "M",
                "name" => "Mendoza"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "N",
                "name" => "Misiones"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "Q",
                "name" => "Neuquén"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "R",
                "name" => "Río Negro"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "A",
                "name" => "Salta"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "J",
                "name" => "San Juan"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "D",
                "name" => "San Luis"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "Z",
                "name" => "Santa Cruz"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "S",
                "name" => "Santa Fe"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "G",
                "name" => "Santiago del Estero"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "V",
                "name" => "Tierra del Fuego"
            ],
            [
                "country_id" => 0,
                "country_code" => "AR",
                "code" => "T",
                "name" => "Tucumán"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AG",
                "name" => "Agrigento"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AL",
                "name" => "Alessandria"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AN",
                "name" => "Ancona"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AO",
                "name" => "Aosta"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AR",
                "name" => "Arezzo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AP",
                "name" => "Ascoli Piceno"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AT",
                "name" => "Asti"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AV",
                "name" => "Avellino"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BA",
                "name" => "Bari"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BT",
                "name" => "Barletta-Andria-Trani"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BL",
                "name" => "Belluno"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BN",
                "name" => "Benevento"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BG",
                "name" => "Bergamo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BI",
                "name" => "Biella"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BO",
                "name" => "Bologna"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BZ",
                "name" => "Bolzano"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BS",
                "name" => "Brescia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "BR",
                "name" => "Brindisi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CA",
                "name" => "Cagliari"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CL",
                "name" => "Caltanissetta"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CB",
                "name" => "Campobasso"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CI",
                "name" => "Carbonia-Iglesias"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CE",
                "name" => "Caserta"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CT",
                "name" => "Catania"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CZ",
                "name" => "Catanzaro"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CH",
                "name" => "Chieti"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CO",
                "name" => "Como"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CS",
                "name" => "Cosenza"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CR",
                "name" => "Cremona"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "KR",
                "name" => "Crotone"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "CN",
                "name" => "Cuneo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "EN",
                "name" => "Enna"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "FM",
                "name" => "Fermo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "FE",
                "name" => "Ferrara"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "FI",
                "name" => "Firenze"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "FG",
                "name" => "Foggia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "FC",
                "name" => "Forli-Cesena"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "FR",
                "name" => "Frosinone"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "GE",
                "name" => "Genova"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "GO",
                "name" => "Gorizia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "GR",
                "name" => "Grosseto"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "IM",
                "name" => "Imperia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "IS",
                "name" => "Isernia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "AQ",
                "name" => "L'Aquila"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SP",
                "name" => "La Spezia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "LT",
                "name" => "Latina"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "LE",
                "name" => "Lecce"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "LC",
                "name" => "Lecco"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "LI",
                "name" => "Livorno"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "LO",
                "name" => "Lodi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "LU",
                "name" => "Lucca"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MC",
                "name" => "Macerata"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MN",
                "name" => "Mantova"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MS",
                "name" => "Massa-Carrara"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MT",
                "name" => "Matera"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VS",
                "name" => "Medio Campidano"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "ME",
                "name" => "Messina"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MI",
                "name" => "Milano"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MO",
                "name" => "Modena"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "MB",
                "name" => "Monza e Brianza"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "NA",
                "name" => "Napoli"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "NO",
                "name" => "Novara"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "NU",
                "name" => "Nuoro"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "OG",
                "name" => "Ogliastra"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "OT",
                "name" => "Olbia-Tempio"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "OR",
                "name" => "Oristano"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PD",
                "name" => "Padova"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PA",
                "name" => "Palermo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PR",
                "name" => "Parma"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PV",
                "name" => "Pavia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PG",
                "name" => "Perugia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PU",
                "name" => "Pesaro e Urbino"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PE",
                "name" => "Pescara"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PC",
                "name" => "Piacenza"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PI",
                "name" => "Pisa"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PT",
                "name" => "Pistoia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PN",
                "name" => "Pordenone"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PZ",
                "name" => "Potenza"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "PO",
                "name" => "Prato"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RG",
                "name" => "Ragusa"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RA",
                "name" => "Ravenna"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RC",
                "name" => "Reggio Calabria"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RE",
                "name" => "Reggio Emilia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RI",
                "name" => "Rieti"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RN",
                "name" => "Rimini"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RM",
                "name" => "Roma"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "RO",
                "name" => "Rovigo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SA",
                "name" => "Salerno"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SS",
                "name" => "Sassari"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SV",
                "name" => "Savona"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SI",
                "name" => "Siena"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SR",
                "name" => "Siracusa"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "SO",
                "name" => "Sondrio"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TA",
                "name" => "Taranto"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TE",
                "name" => "Teramo"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TR",
                "name" => "Terni"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TO",
                "name" => "Torino"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TP",
                "name" => "Trapani"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TN",
                "name" => "Trento"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TV",
                "name" => "Treviso"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "TS",
                "name" => "Trieste"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "UD",
                "name" => "Udine"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VA",
                "name" => "Varese"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VE",
                "name" => "Venezia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VB",
                "name" => "Verbano-Cusio-Ossola"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VC",
                "name" => "Vercelli"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VR",
                "name" => "Verona"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VV",
                "name" => "Vibo Valentia"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VI",
                "name" => "Vicenza"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "VT",
                "name" => "Viterbo"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "AC",
                "name" => "Aceh [Autonomous province]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "BA",
                "name" => "Bali"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "BB",
                "name" => "Bangka Belitung"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "BT",
                "name" => "Banten"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "BE",
                "name" => "Bengkulu"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "JT",
                "name" => "Jawa Tengah"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "KT",
                "name" => "Kalimantan Tengah"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "ST",
                "name" => "Sulawesi Tengah"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "JI",
                "name" => "Jawa Timur"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "KI",
                "name" => "Kalimantan Timur"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "NT",
                "name" => "Nusa Tenggara Timur"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "GO",
                "name" => "Gorontalo"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "JK",
                "name" => "Jakarta Raya [Special district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "JA",
                "name" => "Jambi"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "LA",
                "name" => "Lampung"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "MA",
                "name" => "Maluku"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "MU",
                "name" => "Maluku Utara"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SA",
                "name" => "Sulawesi Utara"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SU",
                "name" => "Sumatera Utara"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "PA",
                "name" => "Papua"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "RI",
                "name" => "Riau"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "KR",
                "name" => "Kepulauan Riau"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SG",
                "name" => "Sulawesi Tenggara"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "KS",
                "name" => "Kalimantan Selatan"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SN",
                "name" => "Sulawesi Selatan"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SS",
                "name" => "Sumatera Selatan"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "JB",
                "name" => "Jawa Barat"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "KB",
                "name" => "Kalimantan Barat"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "NB",
                "name" => "Nusa Tenggara Barat"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "PB",
                "name" => "Papua Barat"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SR",
                "name" => "Sulawesi Barat"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SB",
                "name" => "Sumatera Barat"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "YO",
                "name" => "Yogyakarta [Special region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "23",
                "name" => "Aiti [Aichi] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "05",
                "name" => "Akita [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "02",
                "name" => "Aomori [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "12",
                "name" => "Tiba [Chiba] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "38",
                "name" => "Ehime [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "18",
                "name" => "Hukui [Fukui] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "40",
                "name" => "Hukuoka [Fukuoka] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "07",
                "name" => "Hukusima [Fukushima] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "21",
                "name" => "Gihu [Gifu] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "10",
                "name" => "Gunma [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "34",
                "name" => "Hirosima [Hiroshima] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "01",
                "name" => "Hokkaidô [Hokkaido] [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "28",
                "name" => "Hyôgo [Hyogo] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "08",
                "name" => "Ibaraki [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "17",
                "name" => "Isikawa [Ishikawa] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "03",
                "name" => "Iwate [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "37",
                "name" => "Kagawa [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "46",
                "name" => "Kagosima [Kagoshima] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "14",
                "name" => "Kanagawa [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "39",
                "name" => "Kôti [Kochi] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "43",
                "name" => "Kumamoto [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "26",
                "name" => "Kyôto [Kyoto] [Urban Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "24",
                "name" => "Mie [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "04",
                "name" => "Miyagi [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "45",
                "name" => "Miyazaki [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "20",
                "name" => "Nagano [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "42",
                "name" => "Nagasaki [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "29",
                "name" => "Nara [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "15",
                "name" => "Niigata [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "44",
                "name" => "Ôita [Oita] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "33",
                "name" => "Okayama [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "47",
                "name" => "Okinawa [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "27",
                "name" => "Ôsaka [Osaka] [Urban Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "41",
                "name" => "Saga [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "11",
                "name" => "Saitama [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "25",
                "name" => "Siga [Shiga] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "32",
                "name" => "Simane [Shimane] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "22",
                "name" => "Sizuoka [Shizuoka] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "09",
                "name" => "Totigi [Tochigi] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "36",
                "name" => "Tokusima [Tokushima] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "13",
                "name" => "Tôkyô [Tokyo] [Metropolis]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "31",
                "name" => "Tottori [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "16",
                "name" => "Toyama [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "30",
                "name" => "Wakayama [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "06",
                "name" => "Yamagata [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "35",
                "name" => "Yamaguti [Yamaguchi] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JP",
                "code" => "19",
                "name" => "Yamanasi [Yamanashi] [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "BAL",
                "name" => "Balkh"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "BAM",
                "name" => "B?my?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "BDG",
                "name" => "B?dgh?s"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "BDS",
                "name" => "Badakhsh?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "BGL",
                "name" => "Baghl?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "DAY",
                "name" => "D?ykund?"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "FRA",
                "name" => "Far?h"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "FYB",
                "name" => "F?ry?b"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "GHA",
                "name" => "Ghazn?"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "GHO",
                "name" => "Gh?r"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "HEL",
                "name" => "Helmand"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "HER",
                "name" => "Her?t"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "JOW",
                "name" => "Jowzj?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "KAB",
                "name" => "K?bul"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "KAN",
                "name" => "Kandah?r"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "KAP",
                "name" => "K?p?s?"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "KDZ",
                "name" => "Kunduz"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "KHO",
                "name" => "Kh?st"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "KNR",
                "name" => "Kunar"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "LAG",
                "name" => "Laghm?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "LOW",
                "name" => "L?gar"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "NAN",
                "name" => "Nangarh?r"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "NIM",
                "name" => "N?mr?z"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "NUR",
                "name" => "N?rist?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "PAN",
                "name" => "Panjshayr"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "PAR",
                "name" => "Parw?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "PIA",
                "name" => "Paktia"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "PKA",
                "name" => "Paktika"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "SAM",
                "name" => "Samangan"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "SAR",
                "name" => "Sar-e Pul"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "TAK",
                "name" => "Takhar"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "URU",
                "name" => "Uruzg?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "WAR",
                "name" => "Wardak"
            ],
            [
                "country_id" => 0,
                "country_code" => "AF",
                "code" => "ZAB",
                "name" => "Z?bul"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "01",
                "name" => "Berat [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "02",
                "name" => "Durrës [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "03",
                "name" => "Elbasan [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "04",
                "name" => "Fier [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "05",
                "name" => "Gjirokastër [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "06",
                "name" => "Korçë [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "07",
                "name" => "Kukës [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "08",
                "name" => "Lezhë [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "09",
                "name" => "Dibër [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "10",
                "name" => "Shkodër [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "11",
                "name" => "Tiranë [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "12",
                "name" => "Vlorë [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "BR",
                "name" => "Berat [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "BU",
                "name" => "Bulqizë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "DI",
                "name" => "Dibër [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "DL",
                "name" => "Delvinë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "DR",
                "name" => "Durrës [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "DV",
                "name" => "Devoll [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "EL",
                "name" => "Elbasan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "ER",
                "name" => "Kolonjë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "FR",
                "name" => "Fier [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "GJ",
                "name" => "Gjirokastër [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "GR",
                "name" => "Gramsh [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "HA",
                "name" => "Has [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "KA",
                "name" => "Kavajë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "KB",
                "name" => "Kurbin [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "KC",
                "name" => "Kuçovë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "KO",
                "name" => "Korçë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "KR",
                "name" => "Krujë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "KU",
                "name" => "Kukës [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "LB",
                "name" => "Librazhd [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "LE",
                "name" => "Lezhë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "LU",
                "name" => "Lushnjë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "MK",
                "name" => "Mallakastër [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "MM",
                "name" => "Malësi e Madhe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "MR",
                "name" => "Mirditë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "MT",
                "name" => "Mat [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "PG",
                "name" => "Pogradec [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "PQ",
                "name" => "Peqin [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "PR",
                "name" => "Përmet [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "PU",
                "name" => "Pukë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "SH",
                "name" => "Shkodër [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "SK",
                "name" => "Skrapar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "SR",
                "name" => "Sarandë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "TE",
                "name" => "Tepelenë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "TP",
                "name" => "Tropojë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "TR",
                "name" => "Tiranë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AL",
                "code" => "VL",
                "name" => "Vlorë [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "01",
                "name" => "Adrar"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "02",
                "name" => "Chlef"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "03",
                "name" => "Laghouat"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "04",
                "name" => "Oum el Bouaghi"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "05",
                "name" => "Batna"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "06",
                "name" => "Béjaïa"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "07",
                "name" => "Biskra"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "08",
                "name" => "Béchar"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "09",
                "name" => "Blida"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "10",
                "name" => "Bouira"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "11",
                "name" => "Tamanghasset"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "12",
                "name" => "Tébessa"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "13",
                "name" => "Tlemcen"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "14",
                "name" => "Tiaret"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "15",
                "name" => "Tizi Ouzou"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "16",
                "name" => "Alger"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "17",
                "name" => "Djelfa"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "18",
                "name" => "Jijel"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "19",
                "name" => "Sétif"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "20",
                "name" => "Saïda"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "21",
                "name" => "Skikda"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "22",
                "name" => "Sidi Bel Abbès"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "23",
                "name" => "Annaba"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "24",
                "name" => "Guelma"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "25",
                "name" => "Constantine"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "26",
                "name" => "Médéa"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "27",
                "name" => "Mostaganem"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "28",
                "name" => "Msila"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "29",
                "name" => "Mascara"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "30",
                "name" => "Ouargla"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "31",
                "name" => "Oran"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "32",
                "name" => "El Bayadh"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "33",
                "name" => "Illizi"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "34",
                "name" => "Bordj Bou Arréridj"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "35",
                "name" => "Boumerdès"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "36",
                "name" => "El Tarf"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "37",
                "name" => "Tindouf"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "38",
                "name" => "Tissemsilt"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "39",
                "name" => "El Oued"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "40",
                "name" => "Khenchela"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "41",
                "name" => "Souk Ahras"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "42",
                "name" => "Tipaza"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "43",
                "name" => "Mila"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "44",
                "name" => "Aïn Defla"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "45",
                "name" => "Naama"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "46",
                "name" => "Aïn Témouchent"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "47",
                "name" => "Ghardaïa"
            ],
            [
                "country_id" => 0,
                "country_code" => "DZ",
                "code" => "48",
                "name" => "Relizane"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "02",
                "name" => "Canillo [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "03",
                "name" => "Encamp [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "04",
                "name" => "La Massana [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "05",
                "name" => "Ordino [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "06",
                "name" => "Sant Julià de Lòria [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "07",
                "name" => "Andorra la Vella [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AD",
                "code" => "08",
                "name" => "Escaldes-Engordany [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "BGO",
                "name" => "Bengo"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "BGU",
                "name" => "Benguela"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "BIE",
                "name" => "Bié"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "CAB",
                "name" => "Cabinda"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "CCU",
                "name" => "Cuando-Cubango"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "CNN",
                "name" => "Cunene"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "CNO",
                "name" => "Cuanza Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "CUS",
                "name" => "Cuanza Sul"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "HUA",
                "name" => "Huambo"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "HUI",
                "name" => "Huíla"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "LNO",
                "name" => "Lunda Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "LSU",
                "name" => "Lunda Sul"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "LUA",
                "name" => "Luanda"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "MAL",
                "name" => "Malange"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "MOX",
                "name" => "Moxico"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "NAM",
                "name" => "Namibe"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "UIG",
                "name" => "Uíge"
            ],
            [
                "country_id" => 0,
                "country_code" => "AO",
                "code" => "ZAI",
                "name" => "Zaire"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "03",
                "name" => "Saint George [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "04",
                "name" => "Saint John’s [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "05",
                "name" => "Saint Mary [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "06",
                "name" => "Saint Paul [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "07",
                "name" => "Saint Peter [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "08",
                "name" => "Saint Philip [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "10",
                "name" => "Barbuda [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AG",
                "code" => "11",
                "name" => "Redonda [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "AG",
                "name" => "Aragac?otn"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "AR",
                "name" => "Ararat"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "AV",
                "name" => "Armavir"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "ER",
                "name" => "Erevan [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "GR",
                "name" => "Gegark'unik'"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "KT",
                "name" => "Kotayk'"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "LO",
                "name" => "Lo?y"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "SH",
                "name" => "Širak"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "SU",
                "name" => "Syunik'"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "TV",
                "name" => "Tavuš"
            ],
            [
                "country_id" => 0,
                "country_code" => "AM",
                "code" => "VD",
                "name" => "Vayoc Jor"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "ACT",
                "name" => "Australian Capital Territory [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "NSW",
                "name" => "New South Wales"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "NT",
                "name" => "Northern Territory [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "QLD",
                "name" => "Queensland"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "SA",
                "name" => "South Australia"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "TAS",
                "name" => "Tasmania"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "VIC",
                "name" => "Victoria"
            ],
            [
                "country_id" => 0,
                "country_code" => "AU",
                "code" => "WA",
                "name" => "Western Australia"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "1",
                "name" => "Burgenland"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "2",
                "name" => "Kärnten"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "3",
                "name" => "Niederösterreich"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "4",
                "name" => "Oberösterreich"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "5",
                "name" => "Salzburg"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "6",
                "name" => "Steiermark"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "7",
                "name" => "Tirol"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "8",
                "name" => "Vorarlberg"
            ],
            [
                "country_id" => 0,
                "country_code" => "AT",
                "code" => "9",
                "name" => "Wien"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AB",
                "name" => "Äli Bayramli [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "ABS",
                "name" => "Abseron [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AGA",
                "name" => "Agstafa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AGC",
                "name" => "Agcabädi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AGM",
                "name" => "Agdam [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AGS",
                "name" => "Agdas [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AGU",
                "name" => "Agsu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "AST",
                "name" => "Astara [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "BA",
                "name" => "Baki [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "BAB",
                "name" => "Babäk [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "BAL",
                "name" => "Balakän [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "BAR",
                "name" => "Bärdä [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "BEY",
                "name" => "Beyläqan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "BIL",
                "name" => "Biläsuvar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "CAB",
                "name" => "Cäbrayil [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "CAL",
                "name" => "Cälilabab [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "CUL",
                "name" => "Culfa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "DAS",
                "name" => "Daskäsän [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "DAV",
                "name" => "Däväçi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "FUZ",
                "name" => "Füzuli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "GA",
                "name" => "G?nc? [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "GAD",
                "name" => "Gädäbäy [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "GOR",
                "name" => "Goranboy [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "GOY",
                "name" => "Göyçay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "GYG",
                "name" => "Göygöl [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "HAC",
                "name" => "Haciqabul [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "IMI",
                "name" => "Imisli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "ISM",
                "name" => "Ismayilli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "KAL",
                "name" => "Kälbäcär [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "KAN",
                "name" => "K?ng?rli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "KUR",
                "name" => "Kürdämir [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "LA",
                "name" => "L?nk?ran [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "LAC",
                "name" => "Laçin [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "LAN",
                "name" => "Länkäran [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "LER",
                "name" => "Lerik [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "MAS",
                "name" => "Masalli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "MI",
                "name" => "Ming?çevir [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "NA",
                "name" => "Naftalan [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "NEF",
                "name" => "Neftçala [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "NV",
                "name" => "Naxç?van [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "NX",
                "name" => "Naxçivan [Autonomous republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "OGU",
                "name" => "Oguz [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "ORD",
                "name" => "Ordubad [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QAB",
                "name" => "Qäbälä [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QAX",
                "name" => "Qax [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QAZ",
                "name" => "Qazax [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QBA",
                "name" => "Quba [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QBI",
                "name" => "Qubadli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QOB",
                "name" => "Qobustan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "QUS",
                "name" => "Qusar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SA",
                "name" => "??ki [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAB",
                "name" => "Sabirabad [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAD",
                "name" => "Sädäräk [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAH",
                "name" => "Sahbuz [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAK",
                "name" => "Säki [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAL",
                "name" => "Salyan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAR",
                "name" => "Särur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SAT",
                "name" => "Saatli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SBN",
                "name" => "?abran [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SIY",
                "name" => "Siyäzän [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SKR",
                "name" => "Sämkir [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SM",
                "name" => "Sumqay?t [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SMI",
                "name" => "Samaxi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SMX",
                "name" => "Samux [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SR",
                "name" => "?irvan [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SS",
                "name" => "Susa City [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "SUS",
                "name" => "Susa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "TAR",
                "name" => "Tärtär [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "TOV",
                "name" => "Tovuz [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "UCA",
                "name" => "Ucar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "XA",
                "name" => "Xank?ndi [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "XAC",
                "name" => "Xaçmaz [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "XAN",
                "name" => "Xanlar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "XCI",
                "name" => "Xocali [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "XIZ",
                "name" => "Xizi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "XVD",
                "name" => "Xocavänd [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "YAR",
                "name" => "Yardimli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "YE",
                "name" => "Yevlax City [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "YEV",
                "name" => "Yevlax [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "ZAN",
                "name" => "Zängilan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "ZAQ",
                "name" => "Zaqatala [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AZ",
                "code" => "ZAR",
                "name" => "Zärdab [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "AC",
                "name" => "Acklins and Crooked Islands [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "AK",
                "name" => "Acklins Islands [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "BI",
                "name" => "Bimini and Cat Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "BP",
                "name" => "Black Point [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "BY",
                "name" => "Berry Islands [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "CE",
                "name" => "Central Eleuthera [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "CI",
                "name" => "Cat Island [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "CK",
                "name" => "Crooked Island and Long Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "CO",
                "name" => "Central Abaco [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "CS",
                "name" => "Central Andros [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "EG",
                "name" => "East Grand Bahama [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "EX",
                "name" => "Exuma [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "FP",
                "name" => "City of Freeport [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "GC",
                "name" => "Grand Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "GH",
                "name" => "Governor's Harbour [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "GT",
                "name" => "Green Turtle Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "HI",
                "name" => "Harbour Island [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "HR",
                "name" => "High Rock [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "HT",
                "name" => "Hope Town [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "IN",
                "name" => "Inagua [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "KB",
                "name" => "Kemps Bay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "LI",
                "name" => "Long Island [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "MC",
                "name" => "Mangrove Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "MG",
                "name" => "Mayaguana [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "MH",
                "name" => "Marsh Harbour [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "MI",
                "name" => "Moore’s Island [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "NB",
                "name" => "Nicholls Town and Berry Islands [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "NE",
                "name" => "North Eleuthera [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "NO",
                "name" => "North Abaco [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "NP",
                "name" => "New Providence [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "NS",
                "name" => "North Andros [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "RC",
                "name" => "Rum Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "RI",
                "name" => "Ragged Island [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "RS",
                "name" => "Rock Sound [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SA",
                "name" => "South Andros [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SE",
                "name" => "South Eleuthera [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SO",
                "name" => "South Abaco [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SP",
                "name" => "Sandy Point [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SR",
                "name" => "San Salvador and Rum Cay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SS",
                "name" => "San Salvador [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "SW",
                "name" => "Spanish Wells [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BS",
                "code" => "WG",
                "name" => "West Grand Bahama [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BH",
                "code" => "13",
                "name" => "Al Manamah (Al ‘Asimah) [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BH",
                "code" => "14",
                "name" => "Al Janubiyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BH",
                "code" => "15",
                "name" => "Al Muharraq [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BH",
                "code" => "16",
                "name" => "Al Wustá [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BH",
                "code" => "17",
                "name" => "Ash Shamaliyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "01",
                "name" => "Bandarban [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "02",
                "name" => "Barguna [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "03",
                "name" => "Bogra [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "04",
                "name" => "Brahmanbaria [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "05",
                "name" => "Bagerhat [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "06",
                "name" => "Barisal [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "07",
                "name" => "Bhola [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "08",
                "name" => "Comilla [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "09",
                "name" => "Chandpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "10",
                "name" => "Chittagong [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "11",
                "name" => "Cox's Bazar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "12",
                "name" => "Chuadanga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "13",
                "name" => "Dhaka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "14",
                "name" => "Dinajpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "15",
                "name" => "Faridpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "16",
                "name" => "Feni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "17",
                "name" => "Gopalganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "18",
                "name" => "Gazipur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "19",
                "name" => "Gaibandha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "20",
                "name" => "Habiganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "21",
                "name" => "Jamalpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "22",
                "name" => "Jessore [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "23",
                "name" => "Jhenaidah [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "24",
                "name" => "Jaipurhat [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "25",
                "name" => "Jhalakati [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "26",
                "name" => "Kishoreganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "27",
                "name" => "Khulna [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "28",
                "name" => "Kurigram [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "29",
                "name" => "Khagrachari [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "30",
                "name" => "Kushtia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "31",
                "name" => "Lakshmipur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "32",
                "name" => "Lalmonirhat [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "33",
                "name" => "Manikganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "34",
                "name" => "Mymensingh [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "35",
                "name" => "Munshiganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "36",
                "name" => "Madaripur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "37",
                "name" => "Magura [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "38",
                "name" => "Moulvibazar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "39",
                "name" => "Meherpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "40",
                "name" => "Narayanganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "41",
                "name" => "Netrakona [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "42",
                "name" => "Narsingdi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "43",
                "name" => "Narail [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "44",
                "name" => "Natore [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "45",
                "name" => "Nawabganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "46",
                "name" => "Nilphamari [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "47",
                "name" => "Noakhali [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "48",
                "name" => "Naogaon [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "49",
                "name" => "Pabna [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "50",
                "name" => "Pirojpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "51",
                "name" => "Patuakhali [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "52",
                "name" => "Panchagarh [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "53",
                "name" => "Rajbari [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "54",
                "name" => "Rajshahi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "55",
                "name" => "Rangpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "56",
                "name" => "Rangamati Parbattya Chattagram [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "57",
                "name" => "Sherpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "58",
                "name" => "Satkhira [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "59",
                "name" => "Sirajganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "60",
                "name" => "Sylhet [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "61",
                "name" => "Sunamganj [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "62",
                "name" => "Shariatpur [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "63",
                "name" => "Tangail [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "64",
                "name" => "Thakurgaon [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "A",
                "name" => "Barisal [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "B",
                "name" => "Chittagong [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "C",
                "name" => "Dhaka [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "D",
                "name" => "Khulna [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "E",
                "name" => "Rajshahi [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "F",
                "name" => "Rangpur [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BD",
                "code" => "G",
                "name" => "Sylhet [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "01",
                "name" => "Christ Church [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "02",
                "name" => "Saint Andrew [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "03",
                "name" => "Saint George [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "04",
                "name" => "Saint James [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "05",
                "name" => "Saint John [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "06",
                "name" => "Saint Joseph [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "07",
                "name" => "Saint Lucy [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "08",
                "name" => "Saint Michael [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "09",
                "name" => "Saint Peter [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "10",
                "name" => "Saint Philip [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BB",
                "code" => "11",
                "name" => "Saint Thomas [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "BR",
                "name" => "Brestskaya voblasts [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "HM",
                "name" => "Horad Minsk [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "HO",
                "name" => "Homyel'skaya voblasts [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "HR",
                "name" => "Hrodzenskaya voblasts [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "MA",
                "name" => "Mahilyowskaya voblasts [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "MI",
                "name" => "Minskaya voblasts [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "VI",
                "name" => "Vitsyebskaya voblasts [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BY",
                "code" => "X1~",
                "name" => "Horad Minsk [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "BRU",
                "name" => "Brussels [Capital Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "VAN",
                "name" => "Antwerpen"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "VBR",
                "name" => "Vlaams Brabant"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "VLG",
                "name" => "Flemish Region [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "VLI",
                "name" => "Limburg"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "VOV",
                "name" => "Oost-Vlaanderen"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "VWV",
                "name" => "West-Vlaanderen"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "WAL",
                "name" => "Wallonia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "WBR",
                "name" => "Brabant Wallon"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "WHT",
                "name" => "Hainaut"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "WLG",
                "name" => "Liège"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "WLX",
                "name" => "Luxembourg"
            ],
            [
                "country_id" => 0,
                "country_code" => "BE",
                "code" => "WNA",
                "name" => "Namur"
            ],
            [
                "country_id" => 0,
                "country_code" => "BZ",
                "code" => "BZ",
                "name" => "Belize [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BZ",
                "code" => "CY",
                "name" => "Cayo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BZ",
                "code" => "CZL",
                "name" => "Corozal [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BZ",
                "code" => "OW",
                "name" => "Orange Walk [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BZ",
                "code" => "SC",
                "name" => "Stann Creek [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BZ",
                "code" => "TOL",
                "name" => "Toledo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "AK",
                "name" => "Atakora [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "AL",
                "name" => "Alibori [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "AQ",
                "name" => "Atlantique [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "BO",
                "name" => "Borgou [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "CO",
                "name" => "Collines [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "DO",
                "name" => "Donga [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "KO",
                "name" => "Kouffo [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "LI",
                "name" => "Littoral [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "MO",
                "name" => "Mono [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "OU",
                "name" => "Ouémé [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "PL",
                "name" => "Plateau [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BJ",
                "code" => "ZO",
                "name" => "Zou [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "DEV",
                "name" => "Devonshire [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "HA",
                "name" => "Hamilton municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "HAM",
                "name" => "Hamilton [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "PAG",
                "name" => "Paget [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "PEM",
                "name" => "Pembroke [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "SAN",
                "name" => "Sandys [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "SG",
                "name" => "Saint George municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "SGE",
                "name" => "Saint George [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "SMI",
                "name" => "Smiths [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "SOU",
                "name" => "Southampton [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BM",
                "code" => "WAR",
                "name" => "Warwick [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "11",
                "name" => "Paro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "12",
                "name" => "Chhukha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "13",
                "name" => "Ha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "14",
                "name" => "Samtse [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "15",
                "name" => "Thimphu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "21",
                "name" => "Tsirang [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "22",
                "name" => "Dagana [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "23",
                "name" => "Punakha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "24",
                "name" => "Wangdue Phodrang [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "31",
                "name" => "Sarpang [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "32",
                "name" => "Trongsa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "33",
                "name" => "Bumthang [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "34",
                "name" => "Zhemgang [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "41",
                "name" => "Trashigang [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "42",
                "name" => "Monggar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "43",
                "name" => "Pemagatshel [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "44",
                "name" => "Lhuentse [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "45",
                "name" => "Samdrup Jongkha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "GA",
                "name" => "Gasa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BT",
                "code" => "TY",
                "name" => "Trashi Yangtse [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "B",
                "name" => "El Beni [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "C",
                "name" => "Cochabamba [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "H",
                "name" => "Chuquisaca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "L",
                "name" => "La Paz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "N",
                "name" => "Pando [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "O",
                "name" => "Oruro [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "P",
                "name" => "Potosí [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "S",
                "name" => "Santa Cruz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BO",
                "code" => "T",
                "name" => "Tarija [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "01",
                "name" => "Unsko-sanski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "02",
                "name" => "Posavski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "03",
                "name" => "Tuzlanski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "04",
                "name" => "Zeni?ko-dobojski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "05",
                "name" => "Bosansko-podrinjski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "06",
                "name" => "Srednjobosanski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "07",
                "name" => "Hercegova?ko-neretvanski kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "08",
                "name" => "Zapadnohercegova?ki kanton [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "09",
                "name" => "Kanton Sarajevo [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "10",
                "name" => "Kanton br. 10 (Livanjski kanton) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "BIH",
                "name" => "Federacija Bosna i Hercegovina [Entity]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "BRC",
                "name" => "Br?ko distrikt [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BA",
                "code" => "SRP",
                "name" => "Republika Srpska [Entity]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "CE",
                "name" => "Central [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "GH",
                "name" => "Ghanzi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "KG",
                "name" => "Kgalagadi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "KL",
                "name" => "Kgatleng [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "KW",
                "name" => "Kweneng [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "NE",
                "name" => "North-East [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "NW",
                "name" => "North-West [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "SE",
                "name" => "South-East [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BW",
                "code" => "SO",
                "name" => "Southern [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "AC",
                "name" => "Acre"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "AL",
                "name" => "Alagoas"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "AM",
                "name" => "Amazonas"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "AP",
                "name" => "Amapá"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "BA",
                "name" => "Bahia"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "CE",
                "name" => "Ceará"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "DF",
                "name" => "Distrito Federal [Federal district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "ES",
                "name" => "Espírito Santo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "GO",
                "name" => "Goiás"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "MA",
                "name" => "Maranhão"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "MG",
                "name" => "Minas Gerais"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "MS",
                "name" => "Mato Grosso do Sul"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "MT",
                "name" => "Mato Grosso"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "PA",
                "name" => "Pará"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "PB",
                "name" => "Paraíba"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "PE",
                "name" => "Pernambuco"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "PI",
                "name" => "Piauí"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "PR",
                "name" => "Paraná"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "RJ",
                "name" => "Rio de Janeiro"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "RN",
                "name" => "Rio Grande do Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "RO",
                "name" => "Rondônia"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "RR",
                "name" => "Roraima"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "RS",
                "name" => "Rio Grande do Sul"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "SC",
                "name" => "Santa Catarina"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "SE",
                "name" => "Sergipe"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "SP",
                "name" => "São Paulo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BR",
                "code" => "TO",
                "name" => "Tocantins"
            ],
            [
                "country_id" => 0,
                "country_code" => "BN",
                "code" => "BE",
                "name" => "Belait [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BN",
                "code" => "BM",
                "name" => "Brunei-Muara [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BN",
                "code" => "TE",
                "name" => "Temburong [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BN",
                "code" => "TU",
                "name" => "Tutong [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "01",
                "name" => "Blagoevgrad [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "02",
                "name" => "Burgas [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "03",
                "name" => "Varna [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "04",
                "name" => "Veliko Tarnovo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "05",
                "name" => "Vidin [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "06",
                "name" => "Vratsa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "07",
                "name" => "Gabrovo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "08",
                "name" => "Dobrich [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "09",
                "name" => "Kardzhali [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "10",
                "name" => "Kjustendil [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "11",
                "name" => "Lovech [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "12",
                "name" => "Montana [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "13",
                "name" => "Pazardzhik [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "14",
                "name" => "Pernik [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "15",
                "name" => "Pleven [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "16",
                "name" => "Plovdiv [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "17",
                "name" => "Razgrad [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "18",
                "name" => "Ruse [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "19",
                "name" => "Silistra [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "20",
                "name" => "Sliven [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "21",
                "name" => "Smolyan [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "22",
                "name" => "Sofia-Grad [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "23",
                "name" => "Sofia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "24",
                "name" => "Stara Zagora [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "25",
                "name" => "Targovishte [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "26",
                "name" => "Haskovo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "27",
                "name" => "Šumen [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BG",
                "code" => "28",
                "name" => "Yambol [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "01",
                "name" => "Boucle du Mouhoun [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "02",
                "name" => "Cascades [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "03",
                "name" => "Centre [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "04",
                "name" => "Centre-Est [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "05",
                "name" => "Centre-Nord [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "06",
                "name" => "Centre-Ouest [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "07",
                "name" => "Centre-Sud [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "08",
                "name" => "Est [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "09",
                "name" => "Hauts-Bassins [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "10",
                "name" => "Nord [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "11",
                "name" => "Plateau-Central [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "12",
                "name" => "Sahel [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "13",
                "name" => "Sud-Ouest [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BAL",
                "name" => "Balé"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BAM",
                "name" => "Bam"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BAN",
                "name" => "Banwa"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BAZ",
                "name" => "Bazèga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BGR",
                "name" => "Bougouriba"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BLG",
                "name" => "Boulgou"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "BLK",
                "name" => "Boulkiemdé"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "COM",
                "name" => "Comoé"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "GAN",
                "name" => "Ganzourgou"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "GNA",
                "name" => "Gnagna"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "GOU",
                "name" => "Gourma"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "HOU",
                "name" => "Houet"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "IOB",
                "name" => "Ioba"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KAD",
                "name" => "Kadiogo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KEN",
                "name" => "Kénédougou"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KMD",
                "name" => "Komondjari"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KMP",
                "name" => "Kompienga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KOP",
                "name" => "Koulpélogo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KOS",
                "name" => "Kossi"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KOT",
                "name" => "Kouritenga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "KOW",
                "name" => "Kourwéogo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "LER",
                "name" => "Léraba"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "LOR",
                "name" => "Loroum"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "MOU",
                "name" => "Mouhoun"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "NAM",
                "name" => "Namentenga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "NAO",
                "name" => "Nahouri"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "NAY",
                "name" => "Nayala"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "NOU",
                "name" => "Noumbiel"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "OUB",
                "name" => "Oubritenga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "OUD",
                "name" => "Oudalan"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "PAS",
                "name" => "Passoré"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "PON",
                "name" => "Poni"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "SEN",
                "name" => "Séno"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "SIS",
                "name" => "Sissili"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "SMT",
                "name" => "Sanmatenga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "SNG",
                "name" => "Sanguié"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "SOM",
                "name" => "Soum"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "SOR",
                "name" => "Sourou"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "TAP",
                "name" => "Tapoa"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "TUI",
                "name" => "Tui"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "YAG",
                "name" => "Yagha"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "YAT",
                "name" => "Yatenga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "ZIR",
                "name" => "Ziro"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "ZON",
                "name" => "Zondoma"
            ],
            [
                "country_id" => 0,
                "country_code" => "BF",
                "code" => "ZOU",
                "name" => "Zoundwéogo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "BB",
                "name" => "Bubanza"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "BJ",
                "name" => "Bujumbura"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "BL",
                "name" => "Bujumbura Rural"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "BM",
                "name" => "Bujumbura Mairie"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "BR",
                "name" => "Bururi"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "CA",
                "name" => "Cankuzo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "CI",
                "name" => "Cibitoke"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "GI",
                "name" => "Gitega"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "KI",
                "name" => "Kirundo"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "KR",
                "name" => "Karuzi"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "KY",
                "name" => "Kayanza"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "MA",
                "name" => "Makamba"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "MU",
                "name" => "Muramvya"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "MW",
                "name" => "Mwaro"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "MY",
                "name" => "Muyinga"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "NG",
                "name" => "Ngozi"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "RT",
                "name" => "Rutana"
            ],
            [
                "country_id" => 0,
                "country_code" => "BI",
                "code" => "RY",
                "name" => "Ruyigi"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "1",
                "name" => "Banteay Mean Chey [Bântéay Méanchey]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "2",
                "name" => "Baat Dambang [Batdâmbâng]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "3",
                "name" => "Kampong Chaam [Kâmpóng Cham]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "4",
                "name" => "Kampong Chhnang [Kâmpóng Chhnang]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "5",
                "name" => "Kampong Spueu [Kâmpóng Spœ]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "6",
                "name" => "Kampong Thum [Kâmpóng Thum]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "7",
                "name" => "Kampot [Kâmpôt]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "8",
                "name" => "Kandaal [Kândal]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "9",
                "name" => "Kaoh Kong [Kaôh Kong]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "10",
                "name" => "Kracheh [Krâchéh]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "11",
                "name" => "Mondol Kiri [Môndól Kiri]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "12",
                "name" => "Phnom Penh [Phnum Pénh] [Autonomous municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "13",
                "name" => "Preah Vihear [Preah Vihéar]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "14",
                "name" => "Prey Veaeng [Prey Vêng]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "15",
                "name" => "Pousaat [Pouthisat]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "16",
                "name" => "Rotanak Kiri [Rôtânôkiri]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "17",
                "name" => "Siem Reab [Siemréab]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "18",
                "name" => "Krong Preah Sihanouk [Krong Preah Sihanouk] [Auton"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "19",
                "name" => "Stueng Traeng [Stœ?ng Trêng]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "20",
                "name" => "Svaay Rieng [Svay Rieng]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "21",
                "name" => "Taakaev [Takêv]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "22",
                "name" => "Otdar Mean Chey [Otdâr Méanchey]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "23",
                "name" => "Krong Kaeb [Krong Kêb] [Autonomous municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KH",
                "code" => "24",
                "name" => "Krong Pailin [Krong Pailin] [Autonomous municipali"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "AD",
                "name" => "Adamaoua [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "CE",
                "name" => "Centre [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "EN",
                "name" => "Far North [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "ES",
                "name" => "East [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "LT",
                "name" => "Littoral [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "NO",
                "name" => "North [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "NW",
                "name" => "North-West [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "OU",
                "name" => "West [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "SU",
                "name" => "South [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CM",
                "code" => "SW",
                "name" => "South-West [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "B",
                "name" => "Ilhas de Barlavento [Geographical region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "BR",
                "name" => "Brava [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "BV",
                "name" => "Boa Vista [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "CA",
                "name" => "Santa Catarina [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "CF",
                "name" => "Santa Catarina do Fogo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "CR",
                "name" => "Santa Cruz [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "CS",
                "name" => "Calheta de São Miguel"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "MA",
                "name" => "Maio [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "MO",
                "name" => "Mosteiros [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "PA",
                "name" => "Paul [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "PN",
                "name" => "Porto Novo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "PR",
                "name" => "Praia [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "RB",
                "name" => "Ribeira Brava [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "RG",
                "name" => "Ribeira Grande [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "RS",
                "name" => "Ribeira Grande de Santiago [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "S",
                "name" => "Ilhas de Sotavento [Geographical region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SD",
                "name" => "São Domingos [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SF",
                "name" => "São Filipe [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SL",
                "name" => "Sal [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SM",
                "name" => "São Miguel [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SN",
                "name" => "São Nicolau"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SO",
                "name" => "São Lourenço dos Órgãos [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SS",
                "name" => "São Salvador do Mundo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "SV",
                "name" => "São Vicente [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "TA",
                "name" => "Tarrafal [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CV",
                "code" => "TS",
                "name" => "Tarrafal de São Nicolau [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "01~",
                "name" => "Bodden Town [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "02~",
                "name" => "Cayman Brac [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "03~",
                "name" => "East End [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "04~",
                "name" => "George Town [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "05~",
                "name" => "Little Cayman [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "06~",
                "name" => "North Side [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KY",
                "code" => "07~",
                "name" => "West Bay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "AC",
                "name" => "Ouham [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "BB",
                "name" => "Bamingui-Bangoran [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "BGF",
                "name" => "Bangui [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "BK",
                "name" => "Basse-Kotto [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "HK",
                "name" => "Haute-Kotto [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "HM",
                "name" => "Haut-Mbomou [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "HS",
                "name" => "Haute-Sangha / Mambéré-Kadéï [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "KB",
                "name" => "Gribingui [Economic prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "KG",
                "name" => "Kémo-Gribingui [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "LB",
                "name" => "Lobaye [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "MB",
                "name" => "Mbomou [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "MP",
                "name" => "Ombella-Mpoko [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "NM",
                "name" => "Nana-Mambéré [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "OP",
                "name" => "Ouham-Pendé [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "SE",
                "name" => "Sangha [Economic prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "UK",
                "name" => "Ouaka [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CF",
                "code" => "VK",
                "name" => "Vakaga [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "BA",
                "name" => "Al Ba??ah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "BET",
                "name" => "Borkou-Ennedi-Tibesti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "BG",
                "name" => "Ba?r al Ghaz?l [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "BO",
                "name" => "B?rk? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "CB",
                "name" => "Sh?r? B?qirm? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "EN",
                "name" => "Inn?d? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "GR",
                "name" => "Q?r? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "HL",
                "name" => "?ajjar Lam?s [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "KA",
                "name" => "K?nim [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "LC",
                "name" => "Al Bu?ayrah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "LO",
                "name" => "L?q?n al Gharb? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "LR",
                "name" => "L?q?n ash Sharq? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "MA",
                "name" => "M?nd?l [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "MC",
                "name" => "Sh?r? al Awsa? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "ME",
                "name" => "M?y? K?bb? ash Sharq? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "MO",
                "name" => "M?y? K?bb? al Gharb? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "ND",
                "name" => "Mad?nat Injam?n? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "OD",
                "name" => "Wadd?y [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "SA",
                "name" => "Sal?m?t [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "SI",
                "name" => "S?l? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "TA",
                "name" => "T?njil? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "TI",
                "name" => "Tibast? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TD",
                "code" => "WF",
                "name" => "W?d? F?r? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "AI",
                "name" => "Aisén del General Carlos Ibáñez del Campo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "AN",
                "name" => "Antofagasta [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "AP",
                "name" => "Arica y Parinacota [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "AR",
                "name" => "Araucanía [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "AT",
                "name" => "Atacama [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "BI",
                "name" => "Bío-Bío [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "CO",
                "name" => "Coquimbo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "LI",
                "name" => "Libertador General Bernardo O'Higgins [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "LL",
                "name" => "Los Lagos [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "LR",
                "name" => "Los Ríos [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "MA",
                "name" => "Magallanes [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "ML",
                "name" => "Maule [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "RM",
                "name" => "Región Metropolitana de Santiago [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "TA",
                "name" => "Tarapacá [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CL",
                "code" => "VS",
                "name" => "Valparaíso [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "11",
                "name" => "Beijing [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "12",
                "name" => "Tianjin [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "13",
                "name" => "Hebei"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "14",
                "name" => "Shanxi"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "15",
                "name" => "Nei Mongol (mn) [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "21",
                "name" => "Liaoning"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "22",
                "name" => "Jilin"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "23",
                "name" => "Heilongjiang"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "31",
                "name" => "Shanghai [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "32",
                "name" => "Jiangsu"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "33",
                "name" => "Zhejiang"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "34",
                "name" => "Anhui"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "35",
                "name" => "Fujian"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "36",
                "name" => "Jiangxi"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "37",
                "name" => "Shandong"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "41",
                "name" => "Henan"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "42",
                "name" => "Hubei"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "43",
                "name" => "Hunan"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "44",
                "name" => "Guangdong"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "45",
                "name" => "Guangxi [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "46",
                "name" => "Hainan"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "50",
                "name" => "Chongqing [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "51",
                "name" => "Sichuan"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "52",
                "name" => "Guizhou"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "53",
                "name" => "Yunnan"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "54",
                "name" => "Xizang [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "61",
                "name" => "Shaanxi"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "62",
                "name" => "Gansu"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "63",
                "name" => "Qinghai"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "64",
                "name" => "Ningxia [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "65",
                "name" => "Xinjiang [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "71",
                "name" => "Taiwan *"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "91",
                "name" => "Xianggang (zh) ** [Special administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CN",
                "code" => "92",
                "name" => "Aomen (zh) *** [Special administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "AMA",
                "name" => "Amazonas [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "ANT",
                "name" => "Antioquia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "ARA",
                "name" => "Arauca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "ATL",
                "name" => "Atlántico [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "BOL",
                "name" => "Bolívar [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "BOY",
                "name" => "Boyacá [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CAL",
                "name" => "Caldas [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CAQ",
                "name" => "Caquetá [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CAS",
                "name" => "Casanare [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CAU",
                "name" => "Cauca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CES",
                "name" => "Cesar [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CHO",
                "name" => "Chocó [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "COR",
                "name" => "Córdoba [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "CUN",
                "name" => "Cundinamarca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "DC",
                "name" => "Distrito Capital de Bogotá [Capital district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "GUA",
                "name" => "Guainía [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "GUV",
                "name" => "Guaviare [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "HUI",
                "name" => "Huila [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "LAG",
                "name" => "La Guajira [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "MAG",
                "name" => "Magdalena [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "MET",
                "name" => "Meta [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "NAR",
                "name" => "Nariño [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "NSA",
                "name" => "Norte de Santander [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "PUT",
                "name" => "Putumayo [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "QUI",
                "name" => "Quindío [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "RIS",
                "name" => "Risaralda [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "SAN",
                "name" => "Santander [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "SAP",
                "name" => "San Andrés, Providencia y Santa Catalina [Departme"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "SUC",
                "name" => "Sucre [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "TOL",
                "name" => "Tolima [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "VAC",
                "name" => "Valle del Cauca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "VAU",
                "name" => "Vaupés [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CO",
                "code" => "VID",
                "name" => "Vichada [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KM",
                "code" => "A",
                "name" => "Andjouân (Anjw?n) [Island]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KM",
                "code" => "G",
                "name" => "Andjazîdja [Island]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KM",
                "code" => "M",
                "name" => "Moûhîlî (M?h?l?) [Island]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "2",
                "name" => "Lékoumou [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "5",
                "name" => "Kouilou [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "7",
                "name" => "Likouala [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "8",
                "name" => "Cuvette [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "9",
                "name" => "Niari [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "11",
                "name" => "Bouenza [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "12",
                "name" => "Pool [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "13",
                "name" => "Sangha [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "14",
                "name" => "Plateaux [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "15",
                "name" => "Cuvette-Ouest [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CG",
                "code" => "BZV",
                "name" => "Brazzaville [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "BC",
                "name" => "Bas-Congo"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "BN",
                "name" => "Bandundu"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "EQ",
                "name" => "Équateur"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "KA",
                "name" => "Katanga"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "KE",
                "name" => "Kasai-Oriental"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "KN",
                "name" => "Kinshasa [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "KW",
                "name" => "Kasai-Occidental"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "MA",
                "name" => "Maniema"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "NK",
                "name" => "Nord-Kivu"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "OR",
                "name" => "Orientale"
            ],
            [
                "country_id" => 0,
                "country_code" => "CD",
                "code" => "SK",
                "name" => "Sud-Kivu"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "A",
                "name" => "Alajuela"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "C",
                "name" => "Cartago"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "G",
                "name" => "Guanacaste"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "H",
                "name" => "Heredia"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "L",
                "name" => "Limón"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "P",
                "name" => "Puntarenas"
            ],
            [
                "country_id" => 0,
                "country_code" => "CR",
                "code" => "SJ",
                "name" => "San José"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "01",
                "name" => "Lagunes (Région des) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "02",
                "name" => "Haut-Sassandra (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "03",
                "name" => "Savanes (Région des) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "04",
                "name" => "Vallée du Bandama (Région de la) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "05",
                "name" => "Moyen-Comoé (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "06",
                "name" => "18 Montagnes (Région des) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "07",
                "name" => "Lacs (Région des) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "08",
                "name" => "Zanzan (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "09",
                "name" => "Bas-Sassandra (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "10",
                "name" => "Denguélé (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "11",
                "name" => "Nzi-Comoé (Région) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "12",
                "name" => "Marahoué (Région de la) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "13",
                "name" => "Sud-Comoé (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "14",
                "name" => "Worodougou (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "15",
                "name" => "Sud-Bandama (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "16",
                "name" => "Agnébi (Région de l') [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "17",
                "name" => "Bafing (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "18",
                "name" => "Fromager (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CI",
                "code" => "19",
                "name" => "Moyen-Cavally (Région du) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "01",
                "name" => "Zagrebacka županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "02",
                "name" => "Krapinsko-zagorska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "03",
                "name" => "Sisacko-moslavacka županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "04",
                "name" => "Karlovacka županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "05",
                "name" => "Varaždinska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "06",
                "name" => "Koprivnicko-križevacka županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "07",
                "name" => "Bjelovarsko-bilogorska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "08",
                "name" => "Primorsko-goranska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "09",
                "name" => "Licko-senjska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "10",
                "name" => "Viroviticko-podravska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "11",
                "name" => "Požeško-slavonska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "12",
                "name" => "Brodsko-posavska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "13",
                "name" => "Zadarska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "14",
                "name" => "Osjecko-baranjska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "15",
                "name" => "Šibensko-kninska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "16",
                "name" => "Vukovarsko-srijemska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "17",
                "name" => "Splitsko-dalmatinska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "18",
                "name" => "Istarska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "19",
                "name" => "Dubrovacko-neretvanska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "20",
                "name" => "Medimurska županija [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HR",
                "code" => "21",
                "name" => "Grad Zagreb [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "01",
                "name" => "Pinar del Río"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "02",
                "name" => "La Habana"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "03",
                "name" => "Ciudad de La Habana"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "04",
                "name" => "Matanzas"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "05",
                "name" => "Villa Clara"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "06",
                "name" => "Cienfuegos"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "07",
                "name" => "Sancti Spíritus"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "08",
                "name" => "Ciego de Ávila"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "09",
                "name" => "Camagüey"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "10",
                "name" => "Las Tunas"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "11",
                "name" => "Holguín"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "12",
                "name" => "Granma"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "13",
                "name" => "Santiago de Cuba"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "14",
                "name" => "Guantánamo"
            ],
            [
                "country_id" => 0,
                "country_code" => "CU",
                "code" => "99",
                "name" => "Isla de la Juventud [Special municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CY",
                "code" => "01",
                "name" => "Lefkosia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CY",
                "code" => "02",
                "name" => "Lemesos [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CY",
                "code" => "03",
                "name" => "Larnaka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CY",
                "code" => "04",
                "name" => "Ammochostos [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CY",
                "code" => "05",
                "name" => "Pafos [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CY",
                "code" => "06",
                "name" => "Keryneia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "101",
                "name" => "Praha 1 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "102",
                "name" => "Praha 2 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "103",
                "name" => "Praha 3 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "104",
                "name" => "Praha 4 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "105",
                "name" => "Praha 5 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "106",
                "name" => "Praha 6 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "107",
                "name" => "Praha 7 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "108",
                "name" => "Praha 8 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "109",
                "name" => "Praha 9 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "201",
                "name" => "Benešov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "202",
                "name" => "Beroun [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "203",
                "name" => "Kladno [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "204",
                "name" => "Kolín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "205",
                "name" => "Kutná Hora [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "206",
                "name" => "M?lník [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "207",
                "name" => "Mladá Boleslav [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "208",
                "name" => "Nymburk [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "209",
                "name" => "Praha východ [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "311",
                "name" => "?eské Bud?jovice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "312",
                "name" => "?eský Krumlov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "313",
                "name" => "Jind?ich?v Hradec [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "314",
                "name" => "Písek [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "315",
                "name" => "Prachatice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "316",
                "name" => "Strakonice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "317",
                "name" => "Tábor [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "321",
                "name" => "Domažlice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "322",
                "name" => "Klatovy [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "323",
                "name" => "Plze? m?sto [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "324",
                "name" => "Plze? jih [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "325",
                "name" => "Plze? sever [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "326",
                "name" => "Rokycany [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "327",
                "name" => "Tachov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "411",
                "name" => "Cheb [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "412",
                "name" => "Karlovy Vary [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "413",
                "name" => "Sokolov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "421",
                "name" => "D??ín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "422",
                "name" => "Chomutov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "423",
                "name" => "Litom??ice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "424",
                "name" => "Louny [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "425",
                "name" => "Most [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "426",
                "name" => "Teplice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "427",
                "name" => "Ústí nad Labem [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "511",
                "name" => "?eská Lípa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "512",
                "name" => "Jablonec nad Nisou [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "513",
                "name" => "Liberec [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "514",
                "name" => "Semily [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "521",
                "name" => "Hradec Králové [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "522",
                "name" => "Ji?ín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "523",
                "name" => "Náchod [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "524",
                "name" => "Rychnov nad Kn?žnou [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "525",
                "name" => "Trutnov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "531",
                "name" => "Chrudim [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "532",
                "name" => "Pardubice [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "533",
                "name" => "Svitavy [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "534",
                "name" => "Ústí nad Orlicí [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "611",
                "name" => "Havlí?k?v Brod [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "612",
                "name" => "Jihlava [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "613",
                "name" => "Pelh?imov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "614",
                "name" => "T?ebí? [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "615",
                "name" => "Žd’ár nad Sázavou [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "621",
                "name" => "Blansko [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "622",
                "name" => "Brno-m?sto [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "623",
                "name" => "Brno-venkov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "624",
                "name" => "B?eclav [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "625",
                "name" => "Hodonín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "626",
                "name" => "Vyškov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "627",
                "name" => "Znojmo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "711",
                "name" => "Jeseník [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "712",
                "name" => "Olomouc [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "713",
                "name" => "Prost?jov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "714",
                "name" => "P?erov [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "715",
                "name" => "Šumperk [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "721",
                "name" => "Krom??íž [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "722",
                "name" => "Uherské Hradišt? [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "723",
                "name" => "Vsetín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "724",
                "name" => "Zlín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "801",
                "name" => "Bruntál [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "802",
                "name" => "Frýdek Místek [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "803",
                "name" => "Karviná [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "804",
                "name" => "Nový Ji?ín [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "805",
                "name" => "Opava [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "806",
                "name" => "Ostrava m?sto [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "10A",
                "name" => "Praha 10 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "10B",
                "name" => "Praha 11 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "10C",
                "name" => "Praha 12 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "10D",
                "name" => "Praha 13 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "10E",
                "name" => "Praha 14 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "10F",
                "name" => "Praha 15 [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "20A",
                "name" => "Praha západ [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "20B",
                "name" => "P?íbram [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "20C",
                "name" => "Rakovník [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "JC",
                "name" => "Jihoceský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "JM",
                "name" => "Jihomoravský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "KA",
                "name" => "Karlovarský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "KR",
                "name" => "Královéhradecký kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "LI",
                "name" => "Liberecký kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "MO",
                "name" => "Moravskoslezský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "OL",
                "name" => "Olomoucký kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "PA",
                "name" => "Pardubický kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "PL",
                "name" => "Plzenský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "PR",
                "name" => "Praha, hlavní mesto [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "ST",
                "name" => "Stredoceský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "US",
                "name" => "Ústecký kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "VY",
                "name" => "Vysocina [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CZ",
                "code" => "ZL",
                "name" => "Zlínský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "015",
                "name" => "København [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "020",
                "name" => "Frederiksborg [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "025",
                "name" => "Roskilde [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "030",
                "name" => "Vestsjælland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "035",
                "name" => "Storstrøm [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "040",
                "name" => "Bornholm [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "042",
                "name" => "Fyn [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "050",
                "name" => "Sønderjylland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "055",
                "name" => "Ribe [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "060",
                "name" => "Vejle [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "065",
                "name" => "Ringkøbing [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "070",
                "name" => "Århus [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "076",
                "name" => "Viborg [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "080",
                "name" => "Nordjylland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "81",
                "name" => "North Jutland [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "82",
                "name" => "Central Jutland [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "83",
                "name" => "South Denmark [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "84",
                "name" => "Capital [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "85",
                "name" => "Zeeland [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "101",
                "name" => "København City [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DK",
                "code" => "147",
                "name" => "Frederiksberg City [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DJ",
                "code" => "AR",
                "name" => "Arta [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DJ",
                "code" => "AS",
                "name" => "Ali Sabieh [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DJ",
                "code" => "DI",
                "name" => "Dikhil [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DJ",
                "code" => "DJ",
                "name" => "Djibouti [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DJ",
                "code" => "OB",
                "name" => "Obock [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DJ",
                "code" => "TA",
                "name" => "Tadjourah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "02",
                "name" => "Saint Andrew [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "03",
                "name" => "Saint David [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "04",
                "name" => "Saint George [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "05",
                "name" => "Saint John [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "06",
                "name" => "Saint Joseph [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "07",
                "name" => "Saint Luke [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "08",
                "name" => "Saint Mark [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "09",
                "name" => "Saint Patrick [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "10",
                "name" => "Saint Paul [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DM",
                "code" => "11",
                "name" => "Saint Peter [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "01",
                "name" => "Distrito Nacional (Santo Domingo)"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "02",
                "name" => "Azua"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "03",
                "name" => "Bahoruco"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "04",
                "name" => "Barahona"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "05",
                "name" => "Dajabón"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "06",
                "name" => "Duarte"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "07",
                "name" => "La Estrelleta [Elías Piña]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "08",
                "name" => "El Seybo [El Seibo]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "09",
                "name" => "Espaillat"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "10",
                "name" => "Independencia"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "11",
                "name" => "La Altagracia"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "12",
                "name" => "La Romana"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "13",
                "name" => "La Vega"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "14",
                "name" => "María Trinidad Sánchez"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "15",
                "name" => "Monte Cristi"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "16",
                "name" => "Pedernales"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "17",
                "name" => "Peravia"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "18",
                "name" => "Puerto Plata"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "19",
                "name" => "Salcedo"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "20",
                "name" => "Samaná"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "21",
                "name" => "San Cristóbal"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "22",
                "name" => "San Juan"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "23",
                "name" => "San Pedro de Macorís"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "24",
                "name" => "Sánchez Ramírez"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "25",
                "name" => "Santiago"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "26",
                "name" => "Santiago Rodríguez"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "27",
                "name" => "Valverde"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "28",
                "name" => "Monseñor Nouel"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "29",
                "name" => "Monte Plata"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "30",
                "name" => "Hato Mayor"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "31",
                "name" => "San Jose de Ocoa"
            ],
            [
                "country_id" => 0,
                "country_code" => "DO",
                "code" => "32",
                "name" => "Santo Domingo"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "A",
                "name" => "Azuay"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "B",
                "name" => "Bolívar"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "C",
                "name" => "Carchi"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "D",
                "name" => "Orellana"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "E",
                "name" => "Esmeraldas"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "F",
                "name" => "Cañar"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "G",
                "name" => "Guayas"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "H",
                "name" => "Chimborazo"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "I",
                "name" => "Imbabura"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "L",
                "name" => "Loja"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "M",
                "name" => "Manabí"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "N",
                "name" => "Napo"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "O",
                "name" => "El Oro"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "P",
                "name" => "Pichincha"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "R",
                "name" => "Los Ríos"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "S",
                "name" => "Morona-Santiago"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "SD",
                "name" => "Santo Domingo de los Tsachilas"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "SE",
                "name" => "Santa Elena"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "T",
                "name" => "Tungurahua"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "U",
                "name" => "Sucumbíos"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "W",
                "name" => "Galápagos"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "X",
                "name" => "Cotopaxi"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "Y",
                "name" => "Pastaza"
            ],
            [
                "country_id" => 0,
                "country_code" => "EC",
                "code" => "Z",
                "name" => "Zamora-Chinchipe"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "ALX",
                "name" => "Al Iskandariyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "ASN",
                "name" => "Aswan [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "AST",
                "name" => "Asyut [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "BA",
                "name" => "Al Bahr al Ahmar [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "BH",
                "name" => "Al Buhayrah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "BNS",
                "name" => "Bani Suwayf [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "C",
                "name" => "Al Qahirah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "DK",
                "name" => "Ad Daqahliyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "DT",
                "name" => "Dumyat [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "FYM",
                "name" => "Al Fayyum [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "GH",
                "name" => "Al Gharbiyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "GZ",
                "name" => "Al Jizah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "HU",
                "name" => "?ulw?n [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "IS",
                "name" => "Al Ism?`?l?yah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "JS",
                "name" => "Janub Sina' [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "KB",
                "name" => "Al Qalyubiyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "KFS",
                "name" => "Kafr ash Shaykh [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "KN",
                "name" => "Qina [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "LX",
                "name" => "Al-Uqsur [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "MN",
                "name" => "Al Minya [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "MNF",
                "name" => "Al Minufiyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "MT",
                "name" => "Matr?h [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "PTS",
                "name" => "B?r Sa`?d [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "SHG",
                "name" => "Suhaj [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "SHR",
                "name" => "Ash Sharqiyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "SIN",
                "name" => "Shamal Sina' [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "SU",
                "name" => "As S?dis min Ukt?bar [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "SUZ",
                "name" => "As Suways [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EG",
                "code" => "WAD",
                "name" => "Al Wadi al Jadid [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "AH",
                "name" => "Ahuachapán [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "CA",
                "name" => "Cabañas [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "CH",
                "name" => "Chalatenango [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "CU",
                "name" => "Cuscatlán [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "LI",
                "name" => "La Libertad [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "MO",
                "name" => "Morazán [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "PA",
                "name" => "La Paz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "SA",
                "name" => "Santa Ana [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "SM",
                "name" => "San Miguel [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "SO",
                "name" => "Sonsonate [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "SS",
                "name" => "San Salvador [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "SV",
                "name" => "San Vicente [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "UN",
                "name" => "La Unión [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SV",
                "code" => "US",
                "name" => "Usulután [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "AN",
                "name" => "Annobón"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "BN",
                "name" => "Bioko Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "BS",
                "name" => "Bioko Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "C",
                "name" => "Región Continental [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "CS",
                "name" => "Centro Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "I",
                "name" => "Región Insular [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "KN",
                "name" => "Kie-Ntem"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "LI",
                "name" => "Litoral"
            ],
            [
                "country_id" => 0,
                "country_code" => "GQ",
                "code" => "WN",
                "name" => "Wele-Nzás"
            ],
            [
                "country_id" => 0,
                "country_code" => "ER",
                "code" => "AN",
                "name" => "Anseba [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ER",
                "code" => "DK",
                "name" => "Debubawi K’eyy?? Ba?ri [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ER",
                "code" => "DU",
                "name" => "Debub [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ER",
                "code" => "GB",
                "name" => "Gash-Barka [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ER",
                "code" => "MA",
                "name" => "Ma’?kel [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ER",
                "code" => "SK",
                "name" => "Semienawi K’eyy?? Ba?ri [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "37",
                "name" => "Harjumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "39",
                "name" => "Hiiumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "44",
                "name" => "Ida-Virumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "49",
                "name" => "Jõgevamaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "51",
                "name" => "Järvamaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "57",
                "name" => "Läänemaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "59",
                "name" => "Lääne-Virumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "65",
                "name" => "Põlvamaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "67",
                "name" => "Pärnumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "70",
                "name" => "Raplamaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "74",
                "name" => "Saaremaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "78",
                "name" => "Tartumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "82",
                "name" => "Valgamaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "84",
                "name" => "Viljandimaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EE",
                "code" => "86",
                "name" => "Võrumaa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "AA",
                "name" => "Adis Abeba [Administration]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "AF",
                "name" => "Afar"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "AM",
                "name" => "Amara"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "BE",
                "name" => "Binshangul Gumuz"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "DD",
                "name" => "Dire Dawa [Administration]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "GA",
                "name" => "Gambela Hizboch"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "HA",
                "name" => "Hareri Hizb"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "OR",
                "name" => "Oromiya"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "SN",
                "name" => "YeDebub Biheroch Bihereseboch na Hizboch"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "SO",
                "name" => "Sumale"
            ],
            [
                "country_id" => 0,
                "country_code" => "ET",
                "code" => "TI",
                "name" => "Tigray"
            ],
            [
                "country_id" => 0,
                "country_code" => "FJ",
                "code" => "C",
                "name" => "Central [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FJ",
                "code" => "E",
                "name" => "Eastern [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FJ",
                "code" => "N",
                "name" => "Northern [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FJ",
                "code" => "R",
                "name" => "Rotuma [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FJ",
                "code" => "W",
                "name" => "Western [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "01",
                "name" => "Ahvenanmaan maakunta [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "02",
                "name" => "Etelä-Karjala [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "03",
                "name" => "Etelä-Pohjanmaa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "04",
                "name" => "Etelä-Savo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "05",
                "name" => "Kainuu [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "06",
                "name" => "Kanta-Häme [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "07",
                "name" => "Keski-Pohjanmaa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "08",
                "name" => "Keski-Suomi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "09",
                "name" => "Kymenlaakso [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "10",
                "name" => "Lappi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "11",
                "name" => "Pirkanmaa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "12",
                "name" => "Pohjanmaa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "13",
                "name" => "Pohjois-Karjala [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "14",
                "name" => "Pohjois-Pohjanmaa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "15",
                "name" => "Pohjois-Savo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "16",
                "name" => "Päijät-Häme [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "17",
                "name" => "Satakunta [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "18",
                "name" => "Uusimaa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "19",
                "name" => "Varsinais-Suomi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "AL",
                "name" => "Ahvenanmaan lääni"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "ES",
                "name" => "Etelä-Suomen lääni"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "IS",
                "name" => "Itä-Suomen lääni"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "LL",
                "name" => "Lapin lääni"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "LS",
                "name" => "Länsi-Suomen lääni"
            ],
            [
                "country_id" => 0,
                "country_code" => "FI",
                "code" => "OL",
                "name" => "Oulun lääni"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "01",
                "name" => "Ain [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "02",
                "name" => "Aisne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "03",
                "name" => "Allier [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "04",
                "name" => "Alpes-de-Haute-Provence [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "05",
                "name" => "Hautes-Alpes [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "06",
                "name" => "Alpes-Maritimes [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "07",
                "name" => "Ardèche [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "08",
                "name" => "Ardennes [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "09",
                "name" => "Ariège [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "10",
                "name" => "Aube [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "11",
                "name" => "Aude [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "12",
                "name" => "Aveyron [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "13",
                "name" => "Bouches-du-Rhône [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "14",
                "name" => "Calvados [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "15",
                "name" => "Cantal [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "16",
                "name" => "Charente [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "17",
                "name" => "Charente-Maritime [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "18",
                "name" => "Cher [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "19",
                "name" => "Corrèze [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "21",
                "name" => "Côte-d'Or [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "22",
                "name" => "Côtes-d'Armor [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "23",
                "name" => "Creuse [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "24",
                "name" => "Dordogne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "25",
                "name" => "Doubs [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "26",
                "name" => "Drôme [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "27",
                "name" => "Eure [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "28",
                "name" => "Eure-et-Loir [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "29",
                "name" => "Finistère [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "30",
                "name" => "Gard [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "31",
                "name" => "Haute-Garonne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "32",
                "name" => "Gers [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "33",
                "name" => "Gironde [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "34",
                "name" => "Hérault [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "35",
                "name" => "Ille-et-Vilaine [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "36",
                "name" => "Indre [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "37",
                "name" => "Indre-et-Loire [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "38",
                "name" => "Isère [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "39",
                "name" => "Jura [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "40",
                "name" => "Landes [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "41",
                "name" => "Loir-et-Cher [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "42",
                "name" => "Loire [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "43",
                "name" => "Haute-Loire [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "44",
                "name" => "Loire-Atlantique [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "45",
                "name" => "Loiret [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "46",
                "name" => "Lot [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "47",
                "name" => "Lot-et-Garonne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "48",
                "name" => "Lozère [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "49",
                "name" => "Maine-et-Loire [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "50",
                "name" => "Manche [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "51",
                "name" => "Marne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "52",
                "name" => "Haute-Marne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "53",
                "name" => "Mayenne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "54",
                "name" => "Meurthe-et-Moselle [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "55",
                "name" => "Meuse [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "56",
                "name" => "Morbihan [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "57",
                "name" => "Moselle [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "58",
                "name" => "Nièvre [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "59",
                "name" => "Nord [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "60",
                "name" => "Oise [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "61",
                "name" => "Orne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "62",
                "name" => "Pas-de-Calais [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "63",
                "name" => "Puy-de-Dôme [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "64",
                "name" => "Pyrénées-Atlantiques [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "65",
                "name" => "Hautes-Pyrénées [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "66",
                "name" => "Pyrénées-Orientales [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "67",
                "name" => "Bas-Rhin [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "68",
                "name" => "Haut-Rhin [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "69",
                "name" => "Rhône [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "70",
                "name" => "Haute-Saône [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "71",
                "name" => "Saône-et-Loire [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "72",
                "name" => "Sarthe [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "73",
                "name" => "Savoie [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "74",
                "name" => "Haute-Savoie [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "75",
                "name" => "Paris [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "76",
                "name" => "Seine-Maritime [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "77",
                "name" => "Seine-et-Marne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "78",
                "name" => "Yvelines [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "79",
                "name" => "Deux-Sèvres [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "80",
                "name" => "Somme [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "81",
                "name" => "Tarn [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "82",
                "name" => "Tarn-et-Garonne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "83",
                "name" => "Var [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "84",
                "name" => "Vaucluse [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "85",
                "name" => "Vendée [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "86",
                "name" => "Vienne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "87",
                "name" => "Haute-Vienne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "88",
                "name" => "Vosges [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "89",
                "name" => "Yonne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "90",
                "name" => "Territoire de Belfort [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "91",
                "name" => "Essonne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "92",
                "name" => "Hauts-de-Seine [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "93",
                "name" => "Seine-Saint-Denis [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "94",
                "name" => "Val-de-Marne [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "95",
                "name" => "Val-d'Oise [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "2A",
                "name" => "Corse-du-Sud [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "2B",
                "name" => "Haute-Corse [Metropolitan department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "A",
                "name" => "Alsace [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "B",
                "name" => "Aquitaine [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "BL",
                "name" => "Saint-Barthélemy (see also separate entry under BL"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "C",
                "name" => "Auvergne [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "CP",
                "name" => "Clipperton [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "D",
                "name" => "Bourgogne [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "E",
                "name" => "Bretagne [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "F",
                "name" => "Centre [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "G",
                "name" => "Champagne-Ardenne [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "GF",
                "name" => "Guyane (française) (see also separate entry under "
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "GP",
                "name" => "Guadeloupe (see also separate entry under GP) [Ove"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "H",
                "name" => "Corse [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "I",
                "name" => "Franche-Comté [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "J",
                "name" => "Île-de-France [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "K",
                "name" => "Languedoc-Roussillon [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "L",
                "name" => "Limousin [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "M",
                "name" => "Lorraine [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "MF",
                "name" => "Saint-Martin (see also separate entry under MF) [O"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "MQ",
                "name" => "Martinique (see also separate entry under MQ) [Ove"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "N",
                "name" => "Midi-Pyrénées [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "NC",
                "name" => "Nouvelle-Calédonie (see also separate entry under "
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "O",
                "name" => "Nord-Pas-de-Calais [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "P",
                "name" => "Basse-Normandie [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "PF",
                "name" => "Polynésie française (see also separate entry under"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "PM",
                "name" => "Saint-Pierre-et-Miquelon (see also separate entry "
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "Q",
                "name" => "Haute-Normandie [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "R",
                "name" => "Pays-de-la-Loire [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "RE",
                "name" => "La Réunion (see also separate entry under RE) [Ove"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "S",
                "name" => "Picardie [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "T",
                "name" => "Poitou-Charentes [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "TF",
                "name" => "Terres Australes Françaises (see also separate ent"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "U",
                "name" => "Provence-Alpes-Côte-d'Azur [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "V",
                "name" => "Rhône-Alpes [Metropolitan regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "WF",
                "name" => "Wallis et Futuna (see also separate entry under WF"
            ],
            [
                "country_id" => 0,
                "country_code" => "FR",
                "code" => "YT",
                "name" => "Mayotte (see also separate entry under YT) [Territ"
            ],
            [
                "country_id" => 0,
                "country_code" => "TF",
                "code" => "X1~",
                "name" => "Ile Saint-Paul et Ile Amsterdam [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TF",
                "code" => "X2~",
                "name" => "Crozet Islands [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TF",
                "code" => "X3~",
                "name" => "Kerguelen [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TF",
                "code" => "X4~",
                "name" => "Iles Eparses [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "1",
                "name" => "Estuaire"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "2",
                "name" => "Haut-Ogooué"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "3",
                "name" => "Moyen-Ogooué"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "4",
                "name" => "Ngounié"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "5",
                "name" => "Nyanga"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "6",
                "name" => "Ogooué-Ivindo"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "7",
                "name" => "Ogooué-Lolo"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "8",
                "name" => "Ogooué-Maritime"
            ],
            [
                "country_id" => 0,
                "country_code" => "GA",
                "code" => "9",
                "name" => "Woleu-Ntem"
            ],
            [
                "country_id" => 0,
                "country_code" => "GM",
                "code" => "B",
                "name" => "Banjul [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GM",
                "code" => "L",
                "name" => "Lower River [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GM",
                "code" => "M",
                "name" => "MacCarthy Island [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GM",
                "code" => "N",
                "name" => "North Bank [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GM",
                "code" => "U",
                "name" => "Upper River [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GM",
                "code" => "W",
                "name" => "Western [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "AB",
                "name" => "Abkhazia [Autonomous republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "AJ",
                "name" => "Ajaria [Autonomous republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "GU",
                "name" => "Guria [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "IM",
                "name" => "Imereti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "KA",
                "name" => "Kakheti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "KK",
                "name" => "Kvemo Kartli [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "MM",
                "name" => "Mtskheta-Mtianeti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "RL",
                "name" => "Racha-Lechkhumi [and] Kvemo Svaneti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "SJ",
                "name" => "Samtskhe-Javakheti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "SK",
                "name" => "Shida Kartli [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "SZ",
                "name" => "Samegrelo-Zemo Svaneti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GE",
                "code" => "TB",
                "name" => "Tbilisi [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "BB",
                "name" => "Brandenburg"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "BE",
                "name" => "Berlin"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "BW",
                "name" => "Baden-Württemberg"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "BY",
                "name" => "Bayern"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "HB",
                "name" => "Bremen"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "HE",
                "name" => "Hessen"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "HH",
                "name" => "Hamburg"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "MV",
                "name" => "Mecklenburg-Vorpommern"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "NI",
                "name" => "Niedersachsen"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "NW",
                "name" => "Nordrhein-Westfalen"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "RP",
                "name" => "Rheinland-Pfalz"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "SH",
                "name" => "Schleswig-Holstein"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "SL",
                "name" => "Saarland"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "SN",
                "name" => "Sachsen"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "ST",
                "name" => "Sachsen-Anhalt"
            ],
            [
                "country_id" => 0,
                "country_code" => "DE",
                "code" => "TH",
                "name" => "Thüringen"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "AA",
                "name" => "Greater Accra [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "AH",
                "name" => "Ashanti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "BA",
                "name" => "Brong-Ahafo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "CP",
                "name" => "Central [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "EP",
                "name" => "Eastern [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "NP",
                "name" => "Northern [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "TV",
                "name" => "Volta [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "UE",
                "name" => "Upper East [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "UW",
                "name" => "Upper West [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GH",
                "code" => "WP",
                "name" => "Western [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "01",
                "name" => "Aitolia kai Akarnania [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "03",
                "name" => "Voiotia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "04",
                "name" => "Evvoia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "05",
                "name" => "Evrytania [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "06",
                "name" => "Fthiotida [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "07",
                "name" => "Fokida [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "11",
                "name" => "Argolida [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "12",
                "name" => "Arkadia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "13",
                "name" => "Achaïa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "14",
                "name" => "Ileia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "15",
                "name" => "Korinthia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "16",
                "name" => "Lakonia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "17",
                "name" => "Messinia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "21",
                "name" => "Zakynthos [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "22",
                "name" => "Kerkyra [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "23",
                "name" => "Kefallonia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "24",
                "name" => "Lefkada [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "31",
                "name" => "Arta [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "32",
                "name" => "Thesprotia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "33",
                "name" => "Ioannina [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "34",
                "name" => "Preveza [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "41",
                "name" => "Karditsa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "42",
                "name" => "Larisa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "43",
                "name" => "Magnisia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "44",
                "name" => "Trikala [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "51",
                "name" => "Grevena [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "52",
                "name" => "Drama [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "53",
                "name" => "Imathia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "54",
                "name" => "Thessaloniki [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "55",
                "name" => "Kavala [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "56",
                "name" => "Kastoria [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "57",
                "name" => "Kilkis [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "58",
                "name" => "Kozani [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "59",
                "name" => "Pella [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "61",
                "name" => "Pieria [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "62",
                "name" => "Serres [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "63",
                "name" => "Florina [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "64",
                "name" => "Chalkidiki [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "69",
                "name" => "Agio Oros [Self-governed part]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "71",
                "name" => "Evros [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "72",
                "name" => "Xanthi [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "73",
                "name" => "Rodopi [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "81",
                "name" => "Dodekanisos [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "82",
                "name" => "Kyklades [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "83",
                "name" => "Lesvos [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "84",
                "name" => "Samos [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "85",
                "name" => "Chios [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "91",
                "name" => "Irakleio [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "92",
                "name" => "Lasithi [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "93",
                "name" => "Rethymno [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "94",
                "name" => "Chania [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "A",
                "name" => "Anatoliki Makedonia kai Thraki [Administrative reg"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "A1",
                "name" => "Attiki [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "B",
                "name" => "Kentriki Makedonia [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "C",
                "name" => "Dytiki Makedonia [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "D",
                "name" => "Ipeiros [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "E",
                "name" => "Thessalia [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "F",
                "name" => "Ionia Nisia [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "G",
                "name" => "Dytiki Ellada [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "H",
                "name" => "Sterea Ellada [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "I",
                "name" => "Attiki [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "J",
                "name" => "Peloponnisos [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "K",
                "name" => "Voreio Aigaio [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "L",
                "name" => "Notio Aigaio [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GR",
                "code" => "M",
                "name" => "Kriti [Administrative regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GL",
                "code" => "KU",
                "name" => "Kommune Kujalleq (kl) [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GL",
                "code" => "QA",
                "name" => "Qaasuitsup Kommunia (kl) [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GL",
                "code" => "QE",
                "name" => "Qeqqata Kommunia (kl) [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GL",
                "code" => "SM",
                "name" => "Kommuneqarfik Sermersooq (kl) [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "01",
                "name" => "Saint Andrew [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "02",
                "name" => "Saint David [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "03",
                "name" => "Saint George [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "04",
                "name" => "Saint John [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "05",
                "name" => "Saint Mark [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "06",
                "name" => "Saint Patrick [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GD",
                "code" => "10",
                "name" => "Southern Grenadine Islands [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "AV",
                "name" => "Alta Verapaz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "BV",
                "name" => "Baja Verapaz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "CM",
                "name" => "Chimaltenango [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "CQ",
                "name" => "Chiquimula [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "ES",
                "name" => "Escuintla [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "GU",
                "name" => "Guatemala [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "HU",
                "name" => "Huehuetenango [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "IZ",
                "name" => "Izabal [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "JA",
                "name" => "Jalapa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "JU",
                "name" => "Jutiapa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "PE",
                "name" => "Petén [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "PR",
                "name" => "El Progreso [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "QC",
                "name" => "Quiché [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "QZ",
                "name" => "Quetzaltenango [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "RE",
                "name" => "Retalhuleu [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "SA",
                "name" => "Sacatepéquez [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "SM",
                "name" => "San Marcos [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "SO",
                "name" => "Sololá [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "SR",
                "name" => "Santa Rosa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "SU",
                "name" => "Suchitepéquez [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "TO",
                "name" => "Totonicapán [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GT",
                "code" => "ZA",
                "name" => "Zacapa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "B",
                "name" => "Boké [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "BE",
                "name" => "Beyla [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "BF",
                "name" => "Boffa [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "BK",
                "name" => "Boké [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "C",
                "name" => "Conakry [Special zone.]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "CO",
                "name" => "Coyah [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "D",
                "name" => "Kindia [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "DB",
                "name" => "Dabola [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "DI",
                "name" => "Dinguiraye [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "DL",
                "name" => "Dalaba [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "DU",
                "name" => "Dubréka [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "F",
                "name" => "Faranah [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "FA",
                "name" => "Faranah [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "FO",
                "name" => "Forécariah [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "FR",
                "name" => "Fria [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "GA",
                "name" => "Gaoual [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "GU",
                "name" => "Guékédou [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "K",
                "name" => "Kankan [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KA",
                "name" => "Kankan [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KB",
                "name" => "Koubia [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KD",
                "name" => "Kindia [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KE",
                "name" => "Kérouané [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KN",
                "name" => "Koundara [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KO",
                "name" => "Kouroussa [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "KS",
                "name" => "Kissidougou [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "L",
                "name" => "Labé [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "LA",
                "name" => "Labé [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "LE",
                "name" => "Lélouma [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "LO",
                "name" => "Lola [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "M",
                "name" => "Mamou [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "MC",
                "name" => "Macenta [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "MD",
                "name" => "Mandiana [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "ML",
                "name" => "Mali [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "MM",
                "name" => "Mamou [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "N",
                "name" => "Nzérékoré [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "NZ",
                "name" => "Nzérékoré [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "PI",
                "name" => "Pita [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "SI",
                "name" => "Siguiri [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "TE",
                "name" => "Télimélé [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "TO",
                "name" => "Tougué [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GN",
                "code" => "YO",
                "name" => "Yomou [Perfecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "BA",
                "name" => "Bafatá [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "BL",
                "name" => "Bolama [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "BM",
                "name" => "Biombo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "BS",
                "name" => "Bissau [Autonomous sector]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "CA",
                "name" => "Cacheu [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "GA",
                "name" => "Gabú [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "L",
                "name" => "Leste"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "N",
                "name" => "Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "OI",
                "name" => "Oio [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "QU",
                "name" => "Quinara [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "S",
                "name" => "Sul"
            ],
            [
                "country_id" => 0,
                "country_code" => "GW",
                "code" => "TO",
                "name" => "Tombali [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "BA",
                "name" => "Barima-Waini [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "CU",
                "name" => "Cuyuni-Mazaruni [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "DE",
                "name" => "Demerara-Mahaica [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "EB",
                "name" => "East Berbice-Corentyne [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "ES",
                "name" => "Essequibo Islands-West Demerara [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "MA",
                "name" => "Mahaica-Berbice [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "PM",
                "name" => "Pomeroon-Supenaam [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "PT",
                "name" => "Potaro-Siparuni [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "UD",
                "name" => "Upper Demerara-Berbice [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GY",
                "code" => "UT",
                "name" => "Upper Takutu-Upper Essequibo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "AR",
                "name" => "Artibonite [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "CE",
                "name" => "Centre [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "GA",
                "name" => "Grande-Anse [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "ND",
                "name" => "Nord [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "NE",
                "name" => "Nord-Est [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "NI",
                "name" => "Nippes [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "NO",
                "name" => "Nord-Ouest [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "OU",
                "name" => "Ouest [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "SD",
                "name" => "Sud [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HT",
                "code" => "SE",
                "name" => "Sud-Est [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "AT",
                "name" => "Atlántida [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "CH",
                "name" => "Choluteca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "CL",
                "name" => "Colón [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "CM",
                "name" => "Comayagua [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "CP",
                "name" => "Copán [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "CR",
                "name" => "Cortés [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "EP",
                "name" => "El Paraíso [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "FM",
                "name" => "Francisco Morazán [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "GD",
                "name" => "Gracias a Dios [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "IB",
                "name" => "Islas de la Bahía [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "IN",
                "name" => "Intibucá [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "LE",
                "name" => "Lempira [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "LP",
                "name" => "La Paz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "OC",
                "name" => "Ocotepeque [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "OL",
                "name" => "Olancho [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "SB",
                "name" => "Santa Bárbara [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "VA",
                "name" => "Valle [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HN",
                "code" => "YO",
                "name" => "Yoro [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "BA",
                "name" => "Baranya [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "BC",
                "name" => "Békéscsaba [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "BE",
                "name" => "Békés [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "BK",
                "name" => "Bács-Kiskun [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "BU",
                "name" => "Budapest [Capital city]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "BZ",
                "name" => "Borsod-Abaúj-Zemplén [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "CS",
                "name" => "Csongrád [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "DE",
                "name" => "Debrecen [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "DU",
                "name" => "Dunaújváros [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "EG",
                "name" => "Eger [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "ER",
                "name" => "Erd [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "FE",
                "name" => "Fejér [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "GS",
                "name" => "Gyor-Moson-Sopron [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "GY",
                "name" => "Gyor [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "HB",
                "name" => "Hajdú-Bihar [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "HE",
                "name" => "Heves [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "HV",
                "name" => "Hódmezovásárhely [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "JN",
                "name" => "Jász-Nagykun-Szolnok [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "KE",
                "name" => "Komárom-Esztergom [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "KM",
                "name" => "Kecskemét [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "KV",
                "name" => "Kaposvár [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "MI",
                "name" => "Miskolc [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "NK",
                "name" => "Nagykanizsa [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "NO",
                "name" => "Nógrád [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "NY",
                "name" => "Nyíregyháza [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "PE",
                "name" => "Pest [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "PS",
                "name" => "Pécs [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SD",
                "name" => "Szeged [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SF",
                "name" => "Székesfehérvár [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SH",
                "name" => "Szombathely [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SK",
                "name" => "Szolnok [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SN",
                "name" => "Sopron [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SO",
                "name" => "Somogy [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SS",
                "name" => "Szekszárd [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "ST",
                "name" => "Salgótarján [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "SZ",
                "name" => "Szabolcs-Szatmár-Bereg [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "TB",
                "name" => "Tatabánya [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "TO",
                "name" => "Tolna [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "VA",
                "name" => "Vas [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "VE",
                "name" => "Veszprém [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "VM",
                "name" => "Veszprém City [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "ZA",
                "name" => "Zala [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "HU",
                "code" => "ZE",
                "name" => "Zalaegerszeg [City of county right]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "0",
                "name" => "Reykjavík [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "1",
                "name" => "Höfuðborgarsvæði utan Reykjavíkur [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "2",
                "name" => "Suðurnes [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "3",
                "name" => "Vesturland [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "4",
                "name" => "Vestfirðir [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "5",
                "name" => "Norðurland vestra [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "6",
                "name" => "Norðurland eystra [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "7",
                "name" => "Austurland [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IS",
                "code" => "8",
                "name" => "Suðurland [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "AN",
                "name" => "Andaman and Nicobar Islands [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "AP",
                "name" => "Andhra Pradesh"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "AR",
                "name" => "Arunachal Pradesh"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "AS",
                "name" => "Assam"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "BR",
                "name" => "Bihar"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "CH",
                "name" => "Chandigarh [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "CT",
                "name" => "Chhattisgarh"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "DD",
                "name" => "Daman and Diu [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "DL",
                "name" => "Delhi [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "DN",
                "name" => "Dadra and Nagar Haveli [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "GA",
                "name" => "Goa"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "GJ",
                "name" => "Gujarat"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "HP",
                "name" => "Himachal Pradesh"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "HR",
                "name" => "Haryana"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "JH",
                "name" => "Jharkhand"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "JK",
                "name" => "Jammu and Kashmir"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "KA",
                "name" => "Karnataka"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "KL",
                "name" => "Kerala"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "LD",
                "name" => "Lakshadweep [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "MH",
                "name" => "Maharashtra"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "ML",
                "name" => "Meghalaya"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "MN",
                "name" => "Manipur"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "MP",
                "name" => "Madhya Pradesh"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "MZ",
                "name" => "Mizoram"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "NL",
                "name" => "Nagaland"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "OR",
                "name" => "Orissa"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "PB",
                "name" => "Punjab"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "PY",
                "name" => "Pondicherry [Union territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "RJ",
                "name" => "Rajasthan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "SK",
                "name" => "Sikkim"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "TN",
                "name" => "Tamil Nadu"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "TR",
                "name" => "Tripura"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "UL",
                "name" => "Uttaranchal"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "UP",
                "name" => "Uttar Pradesh"
            ],
            [
                "country_id" => 0,
                "country_code" => "IN",
                "code" => "WB",
                "name" => "West Bengal"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "IJ",
                "name" => "Papua [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "JW",
                "name" => "Jawa [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "KA",
                "name" => "Kalimantan [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "ML",
                "name" => "Maluku [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "NU",
                "name" => "Nusa Tenggara [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SL",
                "name" => "Sulawesi [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ID",
                "code" => "SM",
                "name" => "Sumatera [Geographic units]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "01",
                "name" => "Az¯arbayjan-e Sharqi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "02",
                "name" => "Az¯arbayjan-e Gharbi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "03",
                "name" => "Ardabil"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "04",
                "name" => "Esfahan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "05",
                "name" => "Ilam"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "06",
                "name" => "Bushehr"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "07",
                "name" => "Tehran"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "08",
                "name" => "Chahar Mah¸all va Bakhtiari"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "09",
                "name" => "Khorasan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "10",
                "name" => "Khuzestan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "11",
                "name" => "Zanjan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "12",
                "name" => "Semnan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "13",
                "name" => "Sistan va Baluchestan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "14",
                "name" => "Fars"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "15",
                "name" => "Kerman"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "16",
                "name" => "Kordestan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "17",
                "name" => "Kermanshah"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "18",
                "name" => "Kohkiluyeh va Buyer Ahmad"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "19",
                "name" => "Gilan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "20",
                "name" => "Lorestan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "21",
                "name" => "Mazandaran"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "22",
                "name" => "Markazi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "23",
                "name" => "Hormozgan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "24",
                "name" => "Hamadan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "25",
                "name" => "Yazd"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "26",
                "name" => "Qom"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "27",
                "name" => "Golestan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "28",
                "name" => "Qazvin"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "29",
                "name" => "Khorasan-e Janubi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "30",
                "name" => "Khorasan-e Razavi"
            ],
            [
                "country_id" => 0,
                "country_code" => "IR",
                "code" => "31",
                "name" => "Khorasan-e Shemali"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "AN",
                "name" => "Al Anbar"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "AR",
                "name" => "Arbil"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "BA",
                "name" => "Al Basrah"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "BB",
                "name" => "Babil"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "BG",
                "name" => "Baghdad"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "DA",
                "name" => "Dahuk"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "DI",
                "name" => "Diyalá"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "DQ",
                "name" => "Dhi Qar"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "KA",
                "name" => "Karbala'"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "MA",
                "name" => "Maysan"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "MU",
                "name" => "Al Muthanná"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "NA",
                "name" => "An Najaf"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "NI",
                "name" => "Ninawá"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "QA",
                "name" => "Al Qadisiyah"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "SD",
                "name" => "Salah ad Din"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "SU",
                "name" => "As Sulaymaniyah"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "TS",
                "name" => "At Ta'mim"
            ],
            [
                "country_id" => 0,
                "country_code" => "IQ",
                "code" => "WA",
                "name" => "Wasit"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "C",
                "name" => "Connaught"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "CE",
                "name" => "Clare [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "CN",
                "name" => "Cavan [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "CO",
                "name" => "Cork [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "CW",
                "name" => "Carlow [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "D",
                "name" => "Dublin [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "DL",
                "name" => "Donegal [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "G",
                "name" => "Galway [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "KE",
                "name" => "Kildare [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "KK",
                "name" => "Kilkenny [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "KY",
                "name" => "Kerry [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "L",
                "name" => "Leinster"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "LD",
                "name" => "Longford [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "LH",
                "name" => "Louth [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "LK",
                "name" => "Limerick [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "LM",
                "name" => "Leitrim [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "LS",
                "name" => "Laois [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "M",
                "name" => "Munster"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "MH",
                "name" => "Meath [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "MN",
                "name" => "Monaghan [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "MO",
                "name" => "Mayo [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "OY",
                "name" => "Offaly [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "RN",
                "name" => "Roscommon [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "SO",
                "name" => "Sligo [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "TA",
                "name" => "Tipperary [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "U",
                "name" => "Ulster"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "WD",
                "name" => "Waterford [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "WH",
                "name" => "Westmeath [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "WW",
                "name" => "Wicklow [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IE",
                "code" => "WX",
                "name" => "Wexford [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IL",
                "code" => "D",
                "name" => "HaDarom [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IL",
                "code" => "HA",
                "name" => "Haifa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IL",
                "code" => "JM",
                "name" => "Yerushalayim [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IL",
                "code" => "M",
                "name" => "HaMerkaz [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IL",
                "code" => "TA",
                "name" => "Tel-Aviv [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IL",
                "code" => "Z",
                "name" => "HaZafon [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "21",
                "name" => "Piemonte [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "23",
                "name" => "Valle d'Aosta [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "25",
                "name" => "Lombardia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "32",
                "name" => "Trentino-Alto Adige [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "34",
                "name" => "Veneto [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "36",
                "name" => "Friuli-Venezia Giulia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "42",
                "name" => "Liguria [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "45",
                "name" => "Emilia-Romagna [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "52",
                "name" => "Toscana [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "55",
                "name" => "Umbria [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "57",
                "name" => "Marche [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "62",
                "name" => "Lazio [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "65",
                "name" => "Abruzzo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "67",
                "name" => "Molise [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "72",
                "name" => "Campania [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "75",
                "name" => "Puglia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "77",
                "name" => "Basilicata [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "78",
                "name" => "Calabria [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "82",
                "name" => "Sicilia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "IT",
                "code" => "88",
                "name" => "Sardegna [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "01",
                "name" => "Kingston [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "02",
                "name" => "Saint Andrew [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "03",
                "name" => "Saint Thomas [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "04",
                "name" => "Portland [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "05",
                "name" => "Saint Mary [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "06",
                "name" => "Saint Ann [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "07",
                "name" => "Trelawny [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "08",
                "name" => "Saint James [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "09",
                "name" => "Hanover [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "10",
                "name" => "Westmoreland [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "11",
                "name" => "Saint Elizabeth [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "12",
                "name" => "Manchester [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "13",
                "name" => "Clarendon [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JM",
                "code" => "14",
                "name" => "Saint Catherine [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "AJ",
                "name" => "‘Ajl?n"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "AM",
                "name" => "‘Amm?n (Al ‘A? ?imah)"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "AQ",
                "name" => "Al ‘Aqabah"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "AT",
                "name" => "At Tafilah"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "AZ",
                "name" => "Az Zarq?'"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "BA",
                "name" => "Al Balqa'"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "IR",
                "name" => "Irbid"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "JA",
                "name" => "Jarash"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "KA",
                "name" => "Al Karak"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "MA",
                "name" => "Al Mafraq"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "MD",
                "name" => "M?dab?"
            ],
            [
                "country_id" => 0,
                "country_code" => "JO",
                "code" => "MN",
                "name" => "Ma`an"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "AKM",
                "name" => "Aqmola oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "AKT",
                "name" => "Aqtöbe oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "ALA",
                "name" => "Almaty [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "ALM",
                "name" => "Almaty oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "AST",
                "name" => "Astana [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "ATY",
                "name" => "Atyrau oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "BAY",
                "name" => "Bayqongyr [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "KAR",
                "name" => "Qaraghandy oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "KUS",
                "name" => "Qostanay oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "KZY",
                "name" => "Qyzylorda oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "MAN",
                "name" => "Mangghystau oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "PAV",
                "name" => "Pavlodar oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "SEV",
                "name" => "Soltüstik Qazaqstan oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "VOS",
                "name" => "Shyghys Qazaqstan oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "YUZ",
                "name" => "Ongtüstik Qazaqstan oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "ZAP",
                "name" => "Batys Qazaqstan oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KZ",
                "code" => "ZHA",
                "name" => "Zhambyl oblysy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "110",
                "name" => "Nairobi"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "200",
                "name" => "Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "300",
                "name" => "Coast"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "400",
                "name" => "Eastern"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "500",
                "name" => "North-Eastern"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "600",
                "name" => "Nyanza"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "700",
                "name" => "Rift Valley"
            ],
            [
                "country_id" => 0,
                "country_code" => "KE",
                "code" => "900",
                "name" => "Western"
            ],
            [
                "country_id" => 0,
                "country_code" => "KI",
                "code" => "G",
                "name" => "Gilbert Islands [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KI",
                "code" => "L",
                "name" => "Line Islands [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KI",
                "code" => "P",
                "name" => "Phoenix Islands [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "01",
                "name" => "Pyongyang [Capital City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "02",
                "name" => "Pyongan-namdo"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "03",
                "name" => "Pyongan-bukdo"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "04",
                "name" => "Chagang-do"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "05",
                "name" => "Hwanghae-namdo"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "06",
                "name" => "Hwanghae-bukto"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "07",
                "name" => "Kangwon-do"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "08",
                "name" => "Hamgyong-namdo"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "09",
                "name" => "Hamgyong-bukdo"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "10",
                "name" => "Yanggang-do"
            ],
            [
                "country_id" => 0,
                "country_code" => "KP",
                "code" => "13",
                "name" => "Nason [Special City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "11",
                "name" => "Seoul Teugbyeolsi [Seoul-T'ukpyolshi] [Capital Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "26",
                "name" => "Busan Gwang'yeogsi [Pusan-Kwangyokshi] [Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "27",
                "name" => "Daegu Gwang'yeogsi [Taegu-Kwangyokshi] [Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "28",
                "name" => "Incheon Gwang'yeogsi [Inch'n-Kwangyokshi] [Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "29",
                "name" => "Gwangju Gwang'yeogsi [Kwangju-Kwangyokshi] [Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "30",
                "name" => "Daejeon Gwang'yeogsi [Taejon-Kwangyokshi] [Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "31",
                "name" => "Ulsan Gwang'yeogsi [Ulsan-Kwangyokshi] [Metropolitan City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "41",
                "name" => "Gyeonggido [Kyonggi-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "42",
                "name" => "Gang'weondo [Kang-won-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "43",
                "name" => "Chungcheongbugdo [Ch'ungch'ongbuk-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "44",
                "name" => "Chungcheongnamdo [Ch'ungch'ongnam-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "45",
                "name" => "Jeonrabugdo[Chollabuk-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "46",
                "name" => "Jeonranamdo [Chollanam-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "47",
                "name" => "Gyeongsangbugdo [Kyongsangbuk-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "48",
                "name" => "Gyeongsangnamdo [Kyongsangnam-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KR",
                "code" => "49",
                "name" => "Jejudo [Cheju-do]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KW",
                "code" => "AH",
                "name" => "Al Ahmadi [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KW",
                "code" => "FA",
                "name" => "Al Farwaniyah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KW",
                "code" => "HA",
                "name" => "Hawalli [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KW",
                "code" => "JA",
                "name" => "Al Jahrah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KW",
                "code" => "KU",
                "name" => "Al Kuwayt (Al ‘??imah) [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KW",
                "code" => "MU",
                "name" => "Mubarak al-Kabir [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "B",
                "name" => "Batken [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "C",
                "name" => "Chü [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "GB",
                "name" => "Bishkek [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "J",
                "name" => "Jalal-Abad [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "N",
                "name" => "Naryn [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "O",
                "name" => "Osh [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "T",
                "name" => "Talas [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KG",
                "code" => "Y",
                "name" => "Ysyk-Köl [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "AT",
                "name" => "Attapu [Attopeu]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "BK",
                "name" => "Bokèo"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "BL",
                "name" => "Bolikhamxai [Borikhane]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "CH",
                "name" => "Champasak [Champassak]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "HO",
                "name" => "Houaphan"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "KH",
                "name" => "Khammouan"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "LM",
                "name" => "Louang Namtha"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "LP",
                "name" => "Louangphabang [Louang Prabang]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "OU",
                "name" => "Oudômxai [Oudomsai]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "PH",
                "name" => "Phôngsali [Phong Saly]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "SL",
                "name" => "Salavan [Saravane]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "SV",
                "name" => "Savannakhét"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "VI",
                "name" => "Vientiane"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "VT",
                "name" => "Vientiane Prefecture [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "XA",
                "name" => "Xaignabouli [Sayaboury]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "XE",
                "name" => "Xékong [Sékong]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "XI",
                "name" => "Xiangkhoang [Xieng Khouang]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LA",
                "code" => "XN",
                "name" => "Xaisômboun [Special zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "001",
                "name" => "Aglonas novads (Aglona) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "002",
                "name" => "Aizkraukles novads (Aizkraukle) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "003",
                "name" => "Aizputes novads (Aizpute) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "004",
                "name" => "Akn?stes novads (Akn?ste) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "005",
                "name" => "Alojas novads (Aloja) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "006",
                "name" => "Alsungas novads (Alsunga) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "007",
                "name" => "Al?ksnes novads (Al?ksne) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "008",
                "name" => "Amatas novads (Amata) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "009",
                "name" => "Apes novads (Ape) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "010",
                "name" => "Auces novads (Auce) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "011",
                "name" => "?dažu novads (?daži) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "012",
                "name" => "Bab?tes novads (Bab?te) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "013",
                "name" => "Baldones novads (Baldone) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "014",
                "name" => "Baltinavas novads (Baltinava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "015",
                "name" => "Balvu novads (Balvi) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "016",
                "name" => "Bauskas novads (Bauska) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "017",
                "name" => "Bever?nas novads (Bever?na) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "018",
                "name" => "Broc?nu novads (Broc?ni) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "019",
                "name" => "Burtnieku novads (Burtnieki) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "020",
                "name" => "Carnikavas novads (Carnikava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "021",
                "name" => "Cesvaines novads (Cesvaine) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "022",
                "name" => "C?su novads (C?sis) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "023",
                "name" => "Ciblas novads (Cibla) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "024",
                "name" => "Dagdas novads (Dagda) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "025",
                "name" => "Daugavpils novads (Daugavpils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "026",
                "name" => "Dobeles novads (Dobele) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "027",
                "name" => "Dundagas novads (Dundaga) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "028",
                "name" => "Durbes novads (Durbe) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "029",
                "name" => "Engures novads (Engure) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "030",
                "name" => "?rg?u novads (?rg?i) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "031",
                "name" => "Garkalnes novads (Garkalne) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "032",
                "name" => "Grobi?as novads (Grobi?a) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "033",
                "name" => "Gulbenes novads (Gulbene) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "034",
                "name" => "Iecavas novads (Iecava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "035",
                "name" => "Ikš?iles novads (Ikš?ile) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "036",
                "name" => "Il?kstes novads (Il?kste) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "037",
                "name" => "In?ukalna novads (In?ukalns) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "038",
                "name" => "Jaunjelgavas novads (Jaunjelgava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "039",
                "name" => "Jaunpiebalgas novads (Jaunpiebalga) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "040",
                "name" => "Jaunpils novads (Jaunpils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "041",
                "name" => "Jelgavas novads (Jelgava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "042",
                "name" => "J?kabpils novads (J?kabpils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "043",
                "name" => "Kandavas novads (Kandava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "044",
                "name" => "K?rsavas novads (K?rsava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "045",
                "name" => "Koc?nu novads [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "046",
                "name" => "Kokneses novads (Koknese) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "047",
                "name" => "Kr?slavas novads (Kr?slava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "048",
                "name" => "Krimuldas novads (Krimulda) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "049",
                "name" => "Krustpils novads (Krustpils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "050",
                "name" => "Kuld?gas novads (Kuld?ga) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "051",
                "name" => "?eguma novads (?egums) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "052",
                "name" => "?ekavas novads (?ekava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "053",
                "name" => "Lielv?rdes novads (Lielv?rde) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "054",
                "name" => "Limbažu novads (Limbaži) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "055",
                "name" => "L?gatnes novads (L?gatne) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "056",
                "name" => "L?v?nu novads (L?v?ni) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "057",
                "name" => "Lub?nas novads (Lub?na) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "058",
                "name" => "Ludzas novads (Ludza) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "059",
                "name" => "Madonas novads (Madona) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "060",
                "name" => "Mazsalacas novads (Mazsalaca) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "061",
                "name" => "M?lpils novads (M?lpils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "062",
                "name" => "M?rupes novads (M?rupe) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "063",
                "name" => "M?rsraga novads [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "064",
                "name" => "Naukš?nu novads (Naukš?ni) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "065",
                "name" => "Neretas novads (Nereta) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "066",
                "name" => "N?cas novads (N?ca) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "067",
                "name" => "Ogres novads (Ogre) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "068",
                "name" => "Olaines novads (Olaine) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "069",
                "name" => "Ozolnieku novads (Ozolnieki) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "070",
                "name" => "P?rgaujas novads (P?rgauja) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "071",
                "name" => "P?vilostas novads (P?vilosta) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "072",
                "name" => "P?avi?u novads (P?avi?as) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "073",
                "name" => "Prei?u novads (Prei?i) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "074",
                "name" => "Priekules novads (Priekule) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "075",
                "name" => "Prieku?u novads (Prieku?i) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "076",
                "name" => "Raunas novads (Rauna) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "077",
                "name" => "R?zeknes novads (R?zekne) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "078",
                "name" => "Riebi?u novads (Riebi?i) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "079",
                "name" => "Rojas novads (Roja) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "080",
                "name" => "Ropažu novads (Ropaži) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "081",
                "name" => "Rucavas novads (Rucava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "082",
                "name" => "Rug?ju novads (Rug?ji) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "083",
                "name" => "Rund?les novads (Rund?le) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "084",
                "name" => "R?jienas novads (R?jiena) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "085",
                "name" => "Salas novads (Sala) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "086",
                "name" => "Salacgr?vas novads (Salacgr?va) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "087",
                "name" => "Salaspils novads (Salaspils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "088",
                "name" => "Saldus novads (Saldus) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "089",
                "name" => "Saulkrastu novads (Saulkrasti) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "090",
                "name" => "S?jas novads (S?ja) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "091",
                "name" => "Siguldas novads (Sigulda) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "092",
                "name" => "Skr?veru novads (Skr?veri) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "093",
                "name" => "Skrundas novads (Skrunda) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "094",
                "name" => "Smiltenes novads (Smiltene) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "095",
                "name" => "Stopi?u novads (Stopi?i) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "096",
                "name" => "Stren?u novads (Stren?i) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "097",
                "name" => "Talsu novads (Talsi) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "098",
                "name" => "T?rvetes novads (T?rvete) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "099",
                "name" => "Tukuma novads (Tukums) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "100",
                "name" => "Vai?odes novads (Vai?ode) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "101",
                "name" => "Valkas novads (Valka) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "102",
                "name" => "Varak??nu novads (Varak??ni) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "103",
                "name" => "V?rkavas novads (V?rkava) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "104",
                "name" => "Vecpiebalgas novads (Vecpiebalga) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "105",
                "name" => "Vecumnieku novads (Vecumnieki) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "106",
                "name" => "Ventspils novads (Ventspils) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "107",
                "name" => "Vies?tes novads (Vies?te) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "108",
                "name" => "Vi?akas novads (Vi?aka) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "109",
                "name" => "Vi??nu novads (Vi??ni) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "110",
                "name" => "Zilupes novads (Zilupe) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "AI",
                "name" => "Aizkraukles Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "AL",
                "name" => "Aluksnes Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "BL",
                "name" => "Balvu Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "BU",
                "name" => "Bauskas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "CE",
                "name" => "Cesu Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "DA",
                "name" => "Daugavpils Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "DGV",
                "name" => "Daugavpils [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "DO",
                "name" => "Dobeles Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "GU",
                "name" => "Gulbenes Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "JEL",
                "name" => "Jelgava [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "JK",
                "name" => "Jekabpils Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "JKB",
                "name" => "J?kabpils [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "JL",
                "name" => "Jelgavas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "JUR",
                "name" => "Jurmala [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "KR",
                "name" => "Kraslavas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "KU",
                "name" => "Kuldigas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "LE",
                "name" => "Liepajas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "LM",
                "name" => "Limbažu Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "LPX",
                "name" => "Liepaja [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "LU",
                "name" => "Ludzas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "MA",
                "name" => "Madonas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "OG",
                "name" => "Ogres Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "PR",
                "name" => "Preilu Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "RE",
                "name" => "Rezeknes Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "REZ",
                "name" => "Rezekne [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "RI",
                "name" => "Rigas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "RIX",
                "name" => "Riga [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "SA",
                "name" => "Saldus Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "TA",
                "name" => "Talsu Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "TU",
                "name" => "Tukuma Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "VE",
                "name" => "Ventspils Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "VEN",
                "name" => "Ventspils [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "VK",
                "name" => "Valkas Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "VM",
                "name" => "Valmieras Aprinkis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LV",
                "code" => "VMR",
                "name" => "Valmiera [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "AK",
                "name" => "Aakkar"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "AS",
                "name" => "Loubnâne ech Chemâli"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "BA",
                "name" => "Beirut"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "BH",
                "name" => "Baalbek-Hermel"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "BI",
                "name" => "El Béqaa"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "JA",
                "name" => "Loubnâne ej Jnoûbi"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "JL",
                "name" => "Jabal Loubnâne"
            ],
            [
                "country_id" => 0,
                "country_code" => "LB",
                "code" => "NA",
                "name" => "Nabatîyé"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "A",
                "name" => "Maseru [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "B",
                "name" => "Butha-Buthe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "C",
                "name" => "Leribe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "D",
                "name" => "Berea [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "E",
                "name" => "Mafeteng [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "F",
                "name" => "Mohale's Hoek [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "G",
                "name" => "Quthing [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "H",
                "name" => "Qacha's Nek [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "J",
                "name" => "Mokhotlong [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LS",
                "code" => "K",
                "name" => "Thaba-Tseka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "BG",
                "name" => "Bong [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "BM",
                "name" => "Bomi [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "CM",
                "name" => "Grand Cape Mount [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "GB",
                "name" => "Grand Bassa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "GG",
                "name" => "Grand Gedeh [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "GK",
                "name" => "Grand Kru [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "LO",
                "name" => "Lofa [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "MG",
                "name" => "Margibi [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "MO",
                "name" => "Montserrado [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "MY",
                "name" => "Maryland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "NI",
                "name" => "Nimba [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "RI",
                "name" => "Rivercess [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "SI",
                "name" => "Sinoe [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "X1~",
                "name" => "Gbarpolu [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LR",
                "code" => "X2~",
                "name" => "River Gee [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "AJ",
                "name" => "Ajdabiya"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "BA",
                "name" => "Banghazi [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "BU",
                "name" => "Al Butnan [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "BW",
                "name" => "Bani Walid"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "DR",
                "name" => "Darnah [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "GD",
                "name" => "Ghadamis"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "GR",
                "name" => "Gharyan"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "GT",
                "name" => "Ghat [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "HZ",
                "name" => "Al ?izam al Akh?ar"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "JA",
                "name" => "Al Jabal al Akh?ar [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "JB",
                "name" => "Jaghbub"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "JG",
                "name" => "Al Jabal al Gharb? [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "JI",
                "name" => "Al Jifarah [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "JU",
                "name" => "Al Jufrah [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "KF",
                "name" => "Al Kufrah [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "MB",
                "name" => "Al Marqab [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "MI",
                "name" => "Misratah [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "MJ",
                "name" => "Al Marj [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "MQ",
                "name" => "Murzuq [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "MZ",
                "name" => "Mizdah"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "NL",
                "name" => "Nalut [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "NQ",
                "name" => "An Nuqat al Khams [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "QB",
                "name" => "Al Qubbah"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "QT",
                "name" => "Al Qatrun"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "SB",
                "name" => "Sabha [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "SH",
                "name" => "Ash Shati' [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "SR",
                "name" => "Surt [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "SS",
                "name" => "Sabratah Surman"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "TB",
                "name" => "Tarabulus [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "TM",
                "name" => "Tarhunah-Masallatah"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "TN",
                "name" => "Tajura' wa an Nawahi Arba"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "WA",
                "name" => "Al W???t [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "WD",
                "name" => "Wadi al ?ayat [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "WS",
                "name" => "W?d? ash Sh??i? [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "YJ",
                "name" => "Yafran-Jadu"
            ],
            [
                "country_id" => 0,
                "country_code" => "LY",
                "code" => "ZA",
                "name" => "Az Zawiyah [Popularate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "01",
                "name" => "Balzers [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "02",
                "name" => "Eschen [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "03",
                "name" => "Gamprin [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "04",
                "name" => "Mauren [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "05",
                "name" => "Planken [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "06",
                "name" => "Ruggell [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "07",
                "name" => "Schaan [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "08",
                "name" => "Schellenberg [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "09",
                "name" => "Triesen [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "10",
                "name" => "Triesenberg [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LI",
                "code" => "11",
                "name" => "Vaduz [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "AL",
                "name" => "Alytaus Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "KL",
                "name" => "Klaipedos Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "KU",
                "name" => "Kauno Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "MR",
                "name" => "Marijampoles Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "PN",
                "name" => "Panevežio Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "SA",
                "name" => "Šiauliu Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "TA",
                "name" => "Taurages Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "TE",
                "name" => "Telšiu Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "UT",
                "name" => "Utenos Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LT",
                "code" => "VL",
                "name" => "Vilniaus Apskritis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LU",
                "code" => "D",
                "name" => "Diekirch [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LU",
                "code" => "G",
                "name" => "Grevenmacher [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LU",
                "code" => "L",
                "name" => "Luxembourg (fr) [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MO",
                "code" => "I",
                "name" => "Ilhas"
            ],
            [
                "country_id" => 0,
                "country_code" => "MO",
                "code" => "M",
                "name" => "Macau"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "01",
                "name" => "Aerodrom [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "02",
                "name" => "Ara?inovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "03",
                "name" => "Berovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "04",
                "name" => "Bitola [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "05",
                "name" => "Bogdanci [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "06",
                "name" => "Bogovinje [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "07",
                "name" => "Bosilovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "08",
                "name" => "Brvenica [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "09",
                "name" => "Butel [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "10",
                "name" => "Valandovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "11",
                "name" => "Vasilevo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "12",
                "name" => "Vev?ani [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "13",
                "name" => "Veles [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "14",
                "name" => "Vinica [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "15",
                "name" => "Vraneštica [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "16",
                "name" => "Vrap?ište [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "17",
                "name" => "Gazi Baba [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "18",
                "name" => "Gevgelija [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "19",
                "name" => "Gostivar [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "20",
                "name" => "Gradsko [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "21",
                "name" => "Debar [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "22",
                "name" => "Debarca [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "23",
                "name" => "Del?evo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "24",
                "name" => "Demir Kapija [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "25",
                "name" => "Demir Hisar [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "26",
                "name" => "Dojran [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "27",
                "name" => "Dolneni [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "28",
                "name" => "Drugovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "29",
                "name" => "Gjor?e Petrov [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "30",
                "name" => "Želino [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "31",
                "name" => "Zajas [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "32",
                "name" => "Zelenikovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "33",
                "name" => "Zrnovci [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "34",
                "name" => "Ilinden [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "35",
                "name" => "Jegunovce [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "36",
                "name" => "Kavadarci [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "37",
                "name" => "Karbinci [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "38",
                "name" => "Karpoš [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "39",
                "name" => "Kisela Voda [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "40",
                "name" => "Ki?evo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "41",
                "name" => "Kon?e [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "42",
                "name" => "Ko?ani [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "43",
                "name" => "Kratovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "44",
                "name" => "Kriva Palanka [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "45",
                "name" => "Krivogaštani [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "46",
                "name" => "Kruševo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "47",
                "name" => "Kumanovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "48",
                "name" => "Lipkovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "49",
                "name" => "Lozovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "50",
                "name" => "Mavrovo i Rostuša [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "51",
                "name" => "Makedonska Kamenica [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "52",
                "name" => "Makedonski Brod [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "53",
                "name" => "Mogila [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "54",
                "name" => "Negotino [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "55",
                "name" => "Novaci [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "56",
                "name" => "Novo Selo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "57",
                "name" => "Oslomej [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "58",
                "name" => "Ohrid [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "59",
                "name" => "Petrovec [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "60",
                "name" => "Peh?evo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "61",
                "name" => "Plasnica [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "62",
                "name" => "Prilep [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "63",
                "name" => "Probištip [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "64",
                "name" => "Radoviš [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "65",
                "name" => "Rankovce [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "66",
                "name" => "Resen [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "67",
                "name" => "Rosoman [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "68",
                "name" => "Saraj [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "69",
                "name" => "Sveti Nikole [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "70",
                "name" => "Sopište [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "71",
                "name" => "Staro Nagori?ane [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "72",
                "name" => "Struga [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "73",
                "name" => "Strumica [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "74",
                "name" => "Studeni?ani [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "75",
                "name" => "Tearce [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "76",
                "name" => "Tetovo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "77",
                "name" => "Centar [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "78",
                "name" => "Centar Župa [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "79",
                "name" => "?air [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "80",
                "name" => "?aška [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "81",
                "name" => "?ešinovo-Obleševo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "82",
                "name" => "?u?er Sandevo [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "83",
                "name" => "Štip [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MK",
                "code" => "84",
                "name" => "Šuto Orizari [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MG",
                "code" => "A",
                "name" => "Toamasina"
            ],
            [
                "country_id" => 0,
                "country_code" => "MG",
                "code" => "D",
                "name" => "Antsiranana"
            ],
            [
                "country_id" => 0,
                "country_code" => "MG",
                "code" => "F",
                "name" => "Fianarantsoa"
            ],
            [
                "country_id" => 0,
                "country_code" => "MG",
                "code" => "M",
                "name" => "Mahajanga"
            ],
            [
                "country_id" => 0,
                "country_code" => "MG",
                "code" => "T",
                "name" => "Antananarivo"
            ],
            [
                "country_id" => 0,
                "country_code" => "MG",
                "code" => "U",
                "name" => "Toliara"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "BA",
                "name" => "Balaka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "BL",
                "name" => "Blantyre [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "C",
                "name" => "Central Region [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "CK",
                "name" => "Chikwawa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "CR",
                "name" => "Chiradzulu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "CT",
                "name" => "Chitipa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "DE",
                "name" => "Dedza [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "DO",
                "name" => "Dowa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "KR",
                "name" => "Karonga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "KS",
                "name" => "Kasungu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "LI",
                "name" => "Lilongwe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "LK",
                "name" => "Likoma [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "MC",
                "name" => "Mchinji [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "MG",
                "name" => "Mangochi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "MH",
                "name" => "Machinga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "MU",
                "name" => "Mulanje [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "MW",
                "name" => "Mwanza [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "MZ",
                "name" => "Mzimba [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "N",
                "name" => "Northern Region [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "NB",
                "name" => "Nkhata Bay [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "NE",
                "name" => "Neno [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "NI",
                "name" => "Ntchisi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "NK",
                "name" => "Nkhotakota [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "NS",
                "name" => "Nsanje [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "NU",
                "name" => "Ntcheu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "PH",
                "name" => "Phalombe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "RU",
                "name" => "Rumphi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "S",
                "name" => "Southern Region [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "SA",
                "name" => "Salima [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "TH",
                "name" => "Thyolo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MW",
                "code" => "ZO",
                "name" => "Zomba [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "01",
                "name" => "Johor"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "02",
                "name" => "Kedah"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "03",
                "name" => "Kelantan"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "04",
                "name" => "Melaka"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "05",
                "name" => "Negeri Sembilan"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "06",
                "name" => "Pahang"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "07",
                "name" => "Pulau Pinang"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "08",
                "name" => "Perak"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "09",
                "name" => "Perlis"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "10",
                "name" => "Selangor"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "11",
                "name" => "Terengganu"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "12",
                "name" => "Sabah"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "13",
                "name" => "Sarawak"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "14",
                "name" => "Wilayah Persekutuan Kuala Lumpur [Federal territor"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "15",
                "name" => "Wilayah Persekutuan Labuan [Federal territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MY",
                "code" => "16",
                "name" => "Wilayah Persekutuan Putrajaya [Federal territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "00",
                "name" => "Alif Dhaal"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "01",
                "name" => "Seenu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "02",
                "name" => "Alif [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "03",
                "name" => "Lhaviyani [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "04",
                "name" => "Vaavu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "05",
                "name" => "Laamu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "07",
                "name" => "Haa Alif [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "08",
                "name" => "Thaa [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "12",
                "name" => "Meemu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "13",
                "name" => "Raa [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "14",
                "name" => "Faafu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "17",
                "name" => "Dhaalu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "20",
                "name" => "Baa [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "23",
                "name" => "Haa Dhaalu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "24",
                "name" => "Shaviyani [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "25",
                "name" => "Noonu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "26",
                "name" => "Kaafu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "27",
                "name" => "Gaaf Alif [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "28",
                "name" => "Gaafu Dhaalu [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "29",
                "name" => "Gnaviyani [Administrative atoll]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "CE",
                "name" => "Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "MLE",
                "name" => "Male [Capital]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "NC",
                "name" => "North Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "NO",
                "name" => "North"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "SC",
                "name" => "South Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "SU",
                "name" => "South"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "UN",
                "name" => "Upper North"
            ],
            [
                "country_id" => 0,
                "country_code" => "MV",
                "code" => "US",
                "name" => "Upper South"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "1",
                "name" => "Kayes [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "2",
                "name" => "Koulikoro [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "3",
                "name" => "Sikasso [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "4",
                "name" => "Ségou [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "5",
                "name" => "Mopti [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "6",
                "name" => "Tombouctou [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "7",
                "name" => "Gao [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "8",
                "name" => "Kidal [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ML",
                "code" => "BKO",
                "name" => "Bamako [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "ALK",
                "name" => "Ailuk [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "ALL",
                "name" => "Ailinglaplap [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "ARN",
                "name" => "Arno [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "AUR",
                "name" => "Aur [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "EBO",
                "name" => "Ebon [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "ENI",
                "name" => "Enewetak [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "JAB",
                "name" => "Jabat [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "JAL",
                "name" => "Jaluit [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "KIL",
                "name" => "Kili [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "KWA",
                "name" => "Kwajalein [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "L",
                "name" => "Ralik chain [Chain of Islands]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "LAE",
                "name" => "Lae [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "LIB",
                "name" => "Lib [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "LIK",
                "name" => "Likiep [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "MAJ",
                "name" => "Majuro [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "MAL",
                "name" => "Maloelap [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "MEJ",
                "name" => "Mejit [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "MIL",
                "name" => "Mili [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "NMK",
                "name" => "Namdrik [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "NMU",
                "name" => "Namu [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "RON",
                "name" => "Rongelap [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "T",
                "name" => "Ratak chain [Chain of Islands]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "UJA",
                "name" => "Ujae [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "UJL",
                "name" => "Ujelang [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "UTI",
                "name" => "Utirik [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "WTH",
                "name" => "Wotho [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MH",
                "code" => "WTJ",
                "name" => "Wotje [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "01",
                "name" => "Hodh ech Chargui [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "02",
                "name" => "Hodh el Gharbi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "03",
                "name" => "Assaba [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "04",
                "name" => "Gorgol [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "05",
                "name" => "Brakna [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "06",
                "name" => "Trarza [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "07",
                "name" => "Adrar [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "08",
                "name" => "Dakhlet Nouâdhibou [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "09",
                "name" => "Tagant [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "10",
                "name" => "Guidimaka [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "11",
                "name" => "Tiris Zemmour [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "12",
                "name" => "Inchiri [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MR",
                "code" => "NKC",
                "name" => "Nouakchott [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "AG",
                "name" => "Agalega Islands [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "BL",
                "name" => "Black River [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "BR",
                "name" => "Beau Bassin-Rose Hill [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "CC",
                "name" => "Cargados Carajos Shoals [Saint Brandon Islands] [D"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "CU",
                "name" => "Curepipe [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "FL",
                "name" => "Flacq [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "GP",
                "name" => "Grand Port [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "MO",
                "name" => "Moka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "PA",
                "name" => "Pamplemousses [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "PL",
                "name" => "Port Louis City [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "PU",
                "name" => "Port Louis District [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "PW",
                "name" => "Plaines Wilhems [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "QB",
                "name" => "Quatre Bornes [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "RO",
                "name" => "Rodrigues Island [Dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "RR",
                "name" => "Rivière du Rempart [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "SA",
                "name" => "Savanne [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MU",
                "code" => "VP",
                "name" => "Vacoas-Phoenix [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "FM",
                "code" => "KSA",
                "name" => "Kosrae"
            ],
            [
                "country_id" => 0,
                "country_code" => "FM",
                "code" => "PNI",
                "name" => "Pohnpei"
            ],
            [
                "country_id" => 0,
                "country_code" => "FM",
                "code" => "TRK",
                "name" => "Chuuk"
            ],
            [
                "country_id" => 0,
                "country_code" => "FM",
                "code" => "YAP",
                "name" => "Yap"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "AN",
                "name" => "Anenii Noi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "BA",
                "name" => "B?l?i [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "BD",
                "name" => "Tighina [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "BR",
                "name" => "Briceni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "BS",
                "name" => "Basarabeasca [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CA",
                "name" => "Cahul [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CH",
                "name" => "Chisinau City [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CL",
                "name" => "C?l?ra?i [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CM",
                "name" => "Cimi?lia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CR",
                "name" => "Criuleni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CS",
                "name" => "C?u?eni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CT",
                "name" => "Cantemir [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "CU",
                "name" => "Chisinau [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "DO",
                "name" => "Dondu?eni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "DR",
                "name" => "Drochia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "DU",
                "name" => "Dub?sari [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "ED",
                "name" => "Edinet [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "FA",
                "name" => "F?le?ti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "FL",
                "name" => "Flore?ti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "GA",
                "name" => "Gagauzia, Unitatea teritoriala autonoma (UTAG) [Au"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "GL",
                "name" => "Glodeni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "HI",
                "name" => "Hînce?ti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "IA",
                "name" => "Ialoveni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "LA",
                "name" => "L?pu?ina [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "LE",
                "name" => "Leova [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "NI",
                "name" => "Nisporeni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "OC",
                "name" => "Ocni?a [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "OR",
                "name" => "Orhei [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "RE",
                "name" => "Rezina [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "RI",
                "name" => "Rî?cani [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "SD",
                "name" => "?old?ne?ti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "SI",
                "name" => "Sîngerei [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "SN",
                "name" => "Stînga Nistrului, unitatea teritoriala din [Territ"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "SO",
                "name" => "Soroca [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "ST",
                "name" => "Str??eni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "SV",
                "name" => "?tefan Vod? [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "TA",
                "name" => "Taraclia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "TE",
                "name" => "Telene?ti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "TI",
                "name" => "Tighina [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MD",
                "code" => "UN",
                "name" => "Ungheni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "CL",
                "name" => "La Colle [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "CO",
                "name" => "La Condamine [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "FO",
                "name" => "Fontvieille [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "GA",
                "name" => "La Gare [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "JE",
                "name" => "Jardin Exotique [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "LA",
                "name" => "Larvotto [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "MA",
                "name" => "Malbousquet [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "MC",
                "name" => "Monte-Carlo [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "MG",
                "name" => "Moneghetti [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "MO",
                "name" => "Monaco-Ville [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "MU",
                "name" => "Moulins [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "PH",
                "name" => "Port-Hercule [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "SD",
                "name" => "Sainte-Dévote [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "SO",
                "name" => "La Source [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "SP",
                "name" => "Spélugues [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "SR",
                "name" => "Saint-Roman [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MC",
                "code" => "VR",
                "name" => "Vallon de la Rousse [Quarter]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "1",
                "name" => "Ulaanbaatar [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "035",
                "name" => "Orhon [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "037",
                "name" => "Darhan uul [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "039",
                "name" => "Hentiy"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "041",
                "name" => "Hövsgöl"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "043",
                "name" => "Hovd"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "046",
                "name" => "Uvs"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "047",
                "name" => "Töv"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "049",
                "name" => "Selenge"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "051",
                "name" => "Sühbaatar"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "053",
                "name" => "Ömnögovi"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "055",
                "name" => "Övörhangay"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "057",
                "name" => "Dzavhan"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "059",
                "name" => "Dundgovi"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "061",
                "name" => "Dornod"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "063",
                "name" => "Dornogovi"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "064",
                "name" => "Govi-Sümber [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "065",
                "name" => "Govi-Altay"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "067",
                "name" => "Bulgan"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "069",
                "name" => "Bayanhongor"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "071",
                "name" => "Bayan-Ölgiy"
            ],
            [
                "country_id" => 0,
                "country_code" => "MN",
                "code" => "073",
                "name" => "Arhangay"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "01",
                "name" => "Andrijevica [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "02",
                "name" => "Bar [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "03",
                "name" => "Berane [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "04",
                "name" => "Bijelo Polje [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "05",
                "name" => "Budva [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "06",
                "name" => "Cetinje [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "07",
                "name" => "Danilovgrad [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "08",
                "name" => "Herceg-Novi [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "09",
                "name" => "Kolašin [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "10",
                "name" => "Kotor [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "11",
                "name" => "Mojkovac [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "12",
                "name" => "Nikšic´ [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "13",
                "name" => "Plav [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "14",
                "name" => "Pljevlja [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "15",
                "name" => "Plužine [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "16",
                "name" => "Podgorica [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "17",
                "name" => "Rožaje [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "18",
                "name" => "Šavnik [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "19",
                "name" => "Tivat [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "20",
                "name" => "Ulcinj [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ME",
                "code" => "21",
                "name" => "Žabljak [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "01",
                "name" => "Tanger-Tetouan [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "02",
                "name" => "Gharb-Chrarda-Beni Hssen [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "03",
                "name" => "Taza-Al Hoceima-Taounate [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "04",
                "name" => "L'Oriental [Rerion]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "05",
                "name" => "Fes-Boulemane [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "06",
                "name" => "Meknes-Tafilalet [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "07",
                "name" => "Rabat-Salé-Zemmour-Zaer [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "08",
                "name" => "Grand Casablanca [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "09",
                "name" => "Chaouia-Ouardigh [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "10",
                "name" => "Doukkala-Abda [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "11",
                "name" => "Marrakech-Tensift-Al Haouz [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "12",
                "name" => "Tadla-Azilal [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "13",
                "name" => "Souss-Massa-Draa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "14",
                "name" => "Guelmim-Es Smar [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "15",
                "name" => "Laayoune-Boujdour-Sakia El Hamra [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "16",
                "name" => "Oued ed Dahab-Lagouira [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "AGD",
                "name" => "Agadir-Ida-Outanane [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "AOU",
                "name" => "Aousserd [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "ASZ",
                "name" => "Assa-Zag"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "AZI",
                "name" => "Azilal"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "BAH",
                "name" => "Aït Baha"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "BEM",
                "name" => "Beni Mellal"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "BER",
                "name" => "Berkane"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "BES",
                "name" => "Ben Slimane"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "BOD",
                "name" => "Boujdour (EH)"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "BOM",
                "name" => "Boulemane"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "CAS",
                "name" => "Casablanca [Dar el Beïda]* [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "CHE",
                "name" => "Chefchaouen"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "CHI",
                "name" => "Chichaoua"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "CHT",
                "name" => "Chtouka-Ait Baha"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "ERR",
                "name" => "Errachidia"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "ESI",
                "name" => "Essaouira"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "ESM",
                "name" => "Es Smara (EH)"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "FAH",
                "name" => "Fahs-Beni Makada [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "FES",
                "name" => "Fès-Dar-Dbibegh [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "FIG",
                "name" => "Figuig"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "GUE",
                "name" => "Guelmim"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "HAJ",
                "name" => "El Hajeb"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "HAO",
                "name" => "Al Haouz"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "HOC",
                "name" => "Al Hoceïma"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "IFR",
                "name" => "Ifrane"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "INE",
                "name" => "Inezgane-Ait Melloul [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "JDI",
                "name" => "El Jadida"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "JRA",
                "name" => "Jrada"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "KEN",
                "name" => "Kénitra"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "KES",
                "name" => "Kelaat es Sraghna"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "KHE",
                "name" => "Khemisset"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "KHN",
                "name" => "Khenifra"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "KHO",
                "name" => "Khouribga"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "LAA",
                "name" => "Laâyoune*"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "LAR",
                "name" => "Larache"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MAR",
                "name" => "Marrakech*"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MED",
                "name" => "Mediouna"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MEK",
                "name" => "Meknès [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MEL",
                "name" => "Aït Melloul"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MMD",
                "name" => "Marrakech-Medina [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MMN",
                "name" => "Marrakech-Menara [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MOH",
                "name" => "Mohammadia [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "MOU",
                "name" => "Moulay Yacoub"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "NAD",
                "name" => "Nador"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "NOU",
                "name" => "Nouaceur"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "OUA",
                "name" => "Ouarzazate"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "OUD",
                "name" => "Oued ed Dahab (EH)"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "OUJ",
                "name" => "Oujda* [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "RAB",
                "name" => "Rabat [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "RBA",
                "name" => "Rabat-Salé*"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SAF",
                "name" => "Safi"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SAL",
                "name" => "Connaught Salé [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SEF",
                "name" => "Sefrou"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SET",
                "name" => "Settat"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SIK",
                "name" => "Sidi Kacem"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SKH",
                "name" => "Skhirate-Témara [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "SYB",
                "name" => "Sidi Youssef Ben Ali [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TAI",
                "name" => "Taourirt"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TAO",
                "name" => "Taounate"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TAR",
                "name" => "Taroudant"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TAT",
                "name" => "Tata"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TAZ",
                "name" => "Taza"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TET",
                "name" => "Tétouan*"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TIZ",
                "name" => "Tiznit"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TNG",
                "name" => "Tanger-Assilah [Prefecture]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TNG",
                "name" => "Tanger"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "TNT",
                "name" => "Tan-Tan"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "X1~",
                "name" => "Laayoune-Boujdour-Sakia El Hamra"
            ],
            [
                "country_id" => 0,
                "country_code" => "MA",
                "code" => "ZAG",
                "name" => "Zagora"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "A",
                "name" => "Niassa"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "B",
                "name" => "Manica"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "G",
                "name" => "Gaza"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "I",
                "name" => "Inhambane"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "L",
                "name" => "Maputo"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "MPM",
                "name" => "Maputo City [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "N",
                "name" => "Nampula"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "P",
                "name" => "Cabo Delgado"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "Q",
                "name" => "Zambézia"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "S",
                "name" => "Sofala"
            ],
            [
                "country_id" => 0,
                "country_code" => "MZ",
                "code" => "T",
                "name" => "Tete"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "01",
                "name" => "Sagaing [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "02",
                "name" => "Bago [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "03",
                "name" => "Magway [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "04",
                "name" => "Mandalay [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "05",
                "name" => "Tanintharyi [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "06",
                "name" => "Yangon [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "07",
                "name" => "Ayeyarwady [Division]"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "11",
                "name" => "Kachin"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "12",
                "name" => "Kayah"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "13",
                "name" => "Kayin"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "14",
                "name" => "Chin"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "15",
                "name" => "Mon"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "16",
                "name" => "Rakhine"
            ],
            [
                "country_id" => 0,
                "country_code" => "MM",
                "code" => "17",
                "name" => "Shan"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "CA",
                "name" => "Caprivi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "ER",
                "name" => "Erongo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "HA",
                "name" => "Hardap [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "KA",
                "name" => "Karas [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "KH",
                "name" => "Khomas [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "KU",
                "name" => "Kunene [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "OD",
                "name" => "Otjozondjupa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "OH",
                "name" => "Omaheke [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "OK",
                "name" => "Okavango [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "ON",
                "name" => "Oshana [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "OS",
                "name" => "Omusati [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "OT",
                "name" => "Oshikoto [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NA",
                "code" => "OW",
                "name" => "Ohangwena [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "01",
                "name" => "Aiwo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "02",
                "name" => "Anabar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "03",
                "name" => "Anetan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "04",
                "name" => "Anibare [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "05",
                "name" => "Baiti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "06",
                "name" => "Boe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "07",
                "name" => "Buada [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "08",
                "name" => "Denigomodu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "09",
                "name" => "Ewa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "10",
                "name" => "Ijuw [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "11",
                "name" => "Meneng [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "12",
                "name" => "Nibok [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "13",
                "name" => "Uaboe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NR",
                "code" => "14",
                "name" => "Yaren [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "1",
                "name" => "Madhyamanchal [Development regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "2",
                "name" => "Madhya Pashchimanchal [Development regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "3",
                "name" => "Pashchimanchal [Development regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "4",
                "name" => "Purwanchal [Development regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "5",
                "name" => "Sudur Pashchimanchal [Development regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "BA",
                "name" => "Bagmati [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "BH",
                "name" => "Bheri [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "DH",
                "name" => "Dhawalagiri [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "GA",
                "name" => "Gandaki [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "JA",
                "name" => "Janakpur [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "KA",
                "name" => "Karnali [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "KO",
                "name" => "Kosi [Koshi] [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "LU",
                "name" => "Lumbini [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "MA",
                "name" => "Mahakali [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "ME",
                "name" => "Mechi [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "NA",
                "name" => "Narayani [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "RA",
                "name" => "Rapti [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "SA",
                "name" => "Sagarmatha [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NP",
                "code" => "SE",
                "name" => "Seti [Zone]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "AW",
                "name" => "Aruba (see also separate entry under AW)"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "BQ1",
                "name" => "Bonaire (see also separate entry under BQ) [Specia"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "BQ2",
                "name" => "Saba (see also separate entry under BQ) [Special m"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "BQ3",
                "name" => "Sint Eustatius (see also separate entry under BQ) "
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "CW",
                "name" => "Curaçao (see also separate entry under CW)"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "DR",
                "name" => "Drenthe"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "FL",
                "name" => "Flevoland"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "FR",
                "name" => "Friesland"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "GE",
                "name" => "Gelderland"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "GR",
                "name" => "Groningen"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "LI",
                "name" => "Limburg"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "NB",
                "name" => "Noord-Brabant"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "NH",
                "name" => "Noord-Holland"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "OV",
                "name" => "Overijssel"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "SX",
                "name" => "Sint Maarten (see also separate entry under SX)"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "UT",
                "name" => "Utrecht"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "ZE",
                "name" => "Zeeland"
            ],
            [
                "country_id" => 0,
                "country_code" => "NL",
                "code" => "ZH",
                "name" => "Zuid-Holland"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "AUK",
                "name" => "Auckland [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "BOP",
                "name" => "Bay of Plenty [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "CAN",
                "name" => "Canterbury [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "CIT",
                "name" => "Chatham Islands Territory [Special Island Authorit"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "GIS",
                "name" => "Gisborne District [Unitary Authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "HKB",
                "name" => "Hawkes's Bay [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "MBH",
                "name" => "Marlborough District [Unitary Authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "MWT",
                "name" => "Manawatu-Wanganui [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "N",
                "name" => "North Island [Island]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "NSN",
                "name" => "Nelson City [Unitary Authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "NTL",
                "name" => "Northland [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "OTA",
                "name" => "Otago [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "S",
                "name" => "South Island [Island]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "STL",
                "name" => "Southland [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "TAS",
                "name" => "Tasman District [Unitary Authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "TKI",
                "name" => "Taranaki [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "WGN",
                "name" => "Wellington [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "WKO",
                "name" => "Waikato [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NZ",
                "code" => "WTC",
                "name" => "West Coast [Regional Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "AN",
                "name" => "Atlántico Norte* [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "AS",
                "name" => "Atlántico Sur* [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "BO",
                "name" => "Boaco [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "CA",
                "name" => "Carazo [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "CI",
                "name" => "Chinandega [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "CO",
                "name" => "Chontales [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "ES",
                "name" => "Estelí [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "GR",
                "name" => "Granada [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "JI",
                "name" => "Jinotega [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "LE",
                "name" => "León [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "MD",
                "name" => "Madriz [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "MN",
                "name" => "Managua [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "MS",
                "name" => "Masaya [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "MT",
                "name" => "Matagalpa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "NS",
                "name" => "Nueva Segovia [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "RI",
                "name" => "Rivas [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NI",
                "code" => "SJ",
                "name" => "Río San Juan [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "1",
                "name" => "Agadez [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "2",
                "name" => "Diffa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "3",
                "name" => "Dosso [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "4",
                "name" => "Maradi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "5",
                "name" => "Tahoua [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "6",
                "name" => "Tillabéri [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "7",
                "name" => "Zinder [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NE",
                "code" => "8",
                "name" => "Niamey [Capital District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "AB",
                "name" => "Abia"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "AD",
                "name" => "Adamawa"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "AK",
                "name" => "Akwa Ibom"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "AN",
                "name" => "Anambra"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "BA",
                "name" => "Bauchi"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "BE",
                "name" => "Benue"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "BO",
                "name" => "Borno"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "BY",
                "name" => "Bayelsa"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "CR",
                "name" => "Cross River"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "DE",
                "name" => "Delta"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "EB",
                "name" => "Ebonyi"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "ED",
                "name" => "Edo"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "EK",
                "name" => "Ekiti"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "EN",
                "name" => "Enugu"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "FC",
                "name" => "Abuja Federal Capital Territory [Capital territory"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "GO",
                "name" => "Gombe"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "IM",
                "name" => "Imo"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "JI",
                "name" => "Jigawa"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "KD",
                "name" => "Kaduna"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "KE",
                "name" => "Kebbi"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "KN",
                "name" => "Kano"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "KO",
                "name" => "Kogi"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "KT",
                "name" => "Katsina"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "KW",
                "name" => "Kwara"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "LA",
                "name" => "Lagos"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "NA",
                "name" => "Nassarawa"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "NI",
                "name" => "Niger"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "OG",
                "name" => "Ogun"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "ON",
                "name" => "Ondo"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "OS",
                "name" => "Osun"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "OY",
                "name" => "Oyo"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "PL",
                "name" => "Plateau"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "RI",
                "name" => "Rivers"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "SO",
                "name" => "Sokoto"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "TA",
                "name" => "Taraba"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "YO",
                "name" => "Yobe"
            ],
            [
                "country_id" => 0,
                "country_code" => "NG",
                "code" => "ZA",
                "name" => "Zamfara"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "01",
                "name" => "Østfold [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "02",
                "name" => "Akershus [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "03",
                "name" => "Oslo [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "04",
                "name" => "Hedmark [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "05",
                "name" => "Oppland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "06",
                "name" => "Buskerud [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "07",
                "name" => "Vestfold [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "08",
                "name" => "Telemark [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "09",
                "name" => "Aust-Agder [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "10",
                "name" => "Vest-Agder [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "11",
                "name" => "Rogaland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "12",
                "name" => "Hordaland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "14",
                "name" => "Sogn og Fjordane [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "15",
                "name" => "Møre og Romsdal [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "16",
                "name" => "Sør-Trøndelag [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "17",
                "name" => "Nord-Trøndelag [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "18",
                "name" => "Nordland [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "19",
                "name" => "Troms [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "20",
                "name" => "Finnmark [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "21",
                "name" => "Svalbard (Arctic Region) (See also country code SJ"
            ],
            [
                "country_id" => 0,
                "country_code" => "NO",
                "code" => "22",
                "name" => "Jan Mayen (Arctic Region) (See also country code S"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "BA",
                "name" => "Al Batinah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "BU",
                "name" => "Al Buraymi [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "DA",
                "name" => "Ad Dakhiliyah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "JA",
                "name" => "Dhofar [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "MA",
                "name" => "Masqat [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "MU",
                "name" => "Musandam [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "SH",
                "name" => "Ash Sharqiyah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "WU",
                "name" => "Al Wustá [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "ZA",
                "name" => "Az? Z??hirah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "OM",
                "code" => "ZU",
                "name" => "Z?uf?r [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "BA",
                "name" => "Baluchistan (en)"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "GB",
                "name" => "Gilgit-Baltistan [Administered areas]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "IS",
                "name" => "Islamabad [Federal capital territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "JK",
                "name" => "Azad Kashmir [Pakistan administered area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "KP",
                "name" => "Khyber Pakhtunkhwa"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "NA",
                "name" => "Northern Areas [Pakistan administered area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "NW",
                "name" => "North-West Frontier"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "PB",
                "name" => "Punjab"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "SD",
                "name" => "Sindh"
            ],
            [
                "country_id" => 0,
                "country_code" => "PK",
                "code" => "TA",
                "name" => "Federally Administered Tribal Areas [Territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "002",
                "name" => "Aimeliik"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "004",
                "name" => "Airai"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "010",
                "name" => "Angaur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "050",
                "name" => "Hatobohei"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "100",
                "name" => "Kayangel"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "150",
                "name" => "Koror"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "212",
                "name" => "Melekeok"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "214",
                "name" => "Ngaraard"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "218",
                "name" => "Ngarchelong"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "222",
                "name" => "Ngardmau"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "224",
                "name" => "Ngatpang"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "226",
                "name" => "Ngchesar"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "227",
                "name" => "Ngeremlengui"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "228",
                "name" => "Ngiwal"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "350",
                "name" => "Peleliu"
            ],
            [
                "country_id" => 0,
                "country_code" => "PW",
                "code" => "370",
                "name" => "Sonsorol"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "BTH",
                "name" => "Bethlehem Bayt La?m [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "DEB",
                "name" => "Deir El Balah Dayr al Bala? [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "GZA",
                "name" => "Gaza Ghazzah [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "HBN",
                "name" => "Hebron Al Khal?l [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "JEM",
                "name" => "Jerusalem Al Quds [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "JEN",
                "name" => "Jenin Jan?n [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "JRH",
                "name" => "Jericho – Al Aghwar Ar??? wa al Aghw?r [Governorat"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "KYS",
                "name" => "Khan Yunis Kh?n Y?nis [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "NBS",
                "name" => "Nablus N?blus [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "NGZ",
                "name" => "North Gaza Sham?l Ghazzah [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "QQA",
                "name" => "Qalqilya Qalq?lyah [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "RBH",
                "name" => "Ramallah R?m All?h wa al B?rah [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "RFH",
                "name" => "Rafah Rafa? [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "SLT",
                "name" => "Salfit Salf?t [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "TBS",
                "name" => "Tubas ??b?s [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PS",
                "code" => "TKM",
                "name" => "Tulkarm ??lkarm [Governorates]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "0",
                "name" => "Comarca de San Blas [Comarca]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "1",
                "name" => "Bocas del Toro"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "2",
                "name" => "Coclé"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "3",
                "name" => "Colón"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "4",
                "name" => "Chiriquí"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "5",
                "name" => "Darién"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "6",
                "name" => "Herrera"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "7",
                "name" => "Los Santos"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "8",
                "name" => "Panamá"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "9",
                "name" => "Veraguas"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "EM",
                "name" => "Emberá [Indigenous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "KY",
                "name" => "Kuna Yala [Indigenous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PA",
                "code" => "NB",
                "name" => "Ngöbe-Buglé [Indigenous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "CPK",
                "name" => "Chimbu"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "CPM",
                "name" => "Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "EBR",
                "name" => "East New Britain"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "EHG",
                "name" => "Eastern Highlands"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "EPW",
                "name" => "Enga"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "ESW",
                "name" => "East Sepik"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "GPK",
                "name" => "Gulf"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "MBA",
                "name" => "Milne Bay"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "MPL",
                "name" => "Morobe"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "MPM",
                "name" => "Madang"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "MRL",
                "name" => "Manus"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "NCD",
                "name" => "National Capital District (Port Moresby) [District"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "NIK",
                "name" => "New Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "NPP",
                "name" => "Northern"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "NSA",
                "name" => "North Solomons"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "NSB",
                "name" => "Bougainville [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "SAN",
                "name" => "Sandaun [West Sepik]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "SHM",
                "name" => "Southern Highlands"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "WBK",
                "name" => "West New Britain"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "WHM",
                "name" => "Western Highlands"
            ],
            [
                "country_id" => 0,
                "country_code" => "PG",
                "code" => "WPD",
                "name" => "Western"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "1",
                "name" => "Concepción [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "2",
                "name" => "San Pedro [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "3",
                "name" => "Cordillera [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "4",
                "name" => "Guairá [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "5",
                "name" => "Caaguazú [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "6",
                "name" => "Caazapá [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "7",
                "name" => "Itapúa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "8",
                "name" => "Misiones [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "9",
                "name" => "Paraguarí [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "10",
                "name" => "Alto Paraná [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "11",
                "name" => "Central [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "12",
                "name" => "Ñeembucú [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "13",
                "name" => "Amambay [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "14",
                "name" => "Canindeyú [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "15",
                "name" => "Presidente Hayes [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "16",
                "name" => "Alto Paraguay [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "19",
                "name" => "Boquerón [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PY",
                "code" => "ASU",
                "name" => "Asunción [Capital]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "AMA",
                "name" => "Amazonas [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "ANC",
                "name" => "Ancash [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "APU",
                "name" => "Apurímac [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "ARE",
                "name" => "Arequipa [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "AYA",
                "name" => "Ayacucho [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "CAJ",
                "name" => "Cajamarca [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "CAL",
                "name" => "El Callao [Constitutional province]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "CUS",
                "name" => "Cusco [Cuzco] [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "HUC",
                "name" => "Huánuco [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "HUV",
                "name" => "Huancavelica [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "ICA",
                "name" => "Ica [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "JUN",
                "name" => "Junín [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "LAL",
                "name" => "La Libertad [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "LAM",
                "name" => "Lambayeque [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "LIM",
                "name" => "Lima [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "LMA",
                "name" => "Municipalidad Metropolitana de Lima [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "LOR",
                "name" => "Loreto [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "MDD",
                "name" => "Madre de Dios [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "MOQ",
                "name" => "Moquegua [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "PAS",
                "name" => "Pasco [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "PIU",
                "name" => "Piura [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "PUN",
                "name" => "Puno [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "SAM",
                "name" => "San Martín [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "TAC",
                "name" => "Tacna [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "TUM",
                "name" => "Tumbes [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PE",
                "code" => "UCA",
                "name" => "Ucayali [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "00",
                "name" => "National Capital Region [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "01",
                "name" => "Ilocos (Region I) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "02",
                "name" => "Cagayan Valley (Region II) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "03",
                "name" => "Central Luzon (Region III) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "05",
                "name" => "Bicol (Region V) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "06",
                "name" => "Western Visayas (Region VI) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "07",
                "name" => "Central Visayas (Region VII) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "08",
                "name" => "Eastern Visayas (Region VIII) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "09",
                "name" => "Zamboanga Peninsula (Region IX) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "10",
                "name" => "Northern Mindanao (Region X) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "11",
                "name" => "Davao (Region XI) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "12",
                "name" => "Soccsksargen (Region XII) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "13",
                "name" => "Caraga (Region XIII) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "14",
                "name" => "Autonomous Region in Muslim Mindanao (ARMM) [Regio"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "15",
                "name" => "Cordillera Administrative Region (CAR) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "40",
                "name" => "CALABARZON (Region IV-A) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "41",
                "name" => "MIMAROPA (Region IV-B) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ABR",
                "name" => "Abra"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "AGN",
                "name" => "Agusan del Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "AGS",
                "name" => "Agusan del Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "AKL",
                "name" => "Aklan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ALB",
                "name" => "Albay"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ANT",
                "name" => "Antique"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "APA",
                "name" => "Apayao"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "AUR",
                "name" => "Aurora"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BAN",
                "name" => "Bataan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BAS",
                "name" => "Basilan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BEN",
                "name" => "Benguet"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BIL",
                "name" => "Biliran"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BOH",
                "name" => "Bohol"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BTG",
                "name" => "Batangas"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BTN",
                "name" => "Batanes"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BUK",
                "name" => "Bukidnon"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "BUL",
                "name" => "Bulacan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAG",
                "name" => "Cagayan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAM",
                "name" => "Camiguin"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAN",
                "name" => "Camarines Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAP",
                "name" => "Capiz"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAS",
                "name" => "Camarines Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAT",
                "name" => "Catanduanes"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CAV",
                "name" => "Cavite"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "CEB",
                "name" => "Cebu"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "COM",
                "name" => "Compostela Valley"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "DAO",
                "name" => "Davao Oriental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "DAS",
                "name" => "Davao del Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "DAV",
                "name" => "Davao del Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "DIN",
                "name" => "Dinagat Islands"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "EAS",
                "name" => "Eastern Samar"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "GUI",
                "name" => "Guimaras"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "IFU",
                "name" => "Ifugao"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ILI",
                "name" => "Iloilo"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ILN",
                "name" => "Ilocos Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ILS",
                "name" => "Ilocos Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ISA",
                "name" => "Isabela"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "KAL",
                "name" => "Kalinga"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "LAG",
                "name" => "Laguna"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "LAN",
                "name" => "Lanao del Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "LAS",
                "name" => "Lanao del Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "LEY",
                "name" => "Leyte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "LUN",
                "name" => "La Union"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MAD",
                "name" => "Marinduque"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MAG",
                "name" => "Maguindanao"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MAS",
                "name" => "Masbate"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MDC",
                "name" => "Mindoro Occidental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MDR",
                "name" => "Mindoro Oriental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MOU",
                "name" => "Mountain Province"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MSC",
                "name" => "Misamis Occidental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "MSR",
                "name" => "Misamis Oriental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "NCO",
                "name" => "Cotabato"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "NEC",
                "name" => "Negros Occidental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "NER",
                "name" => "Negros Oriental"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "NSA",
                "name" => "Northern Samar"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "NUE",
                "name" => "Nueva Ecija"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "NUV",
                "name" => "Nueva Vizcaya"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "PAM",
                "name" => "Pampanga"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "PAN",
                "name" => "Pangasinan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "PLW",
                "name" => "Palawan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "QUE",
                "name" => "Quezon"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "QUI",
                "name" => "Quirino"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "RIZ",
                "name" => "Rizal"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ROM",
                "name" => "Romblon"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SAR",
                "name" => "Sarangani"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SCO",
                "name" => "South Cotabato"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SIG",
                "name" => "Siquijor"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SLE",
                "name" => "Southern Leyte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SLU",
                "name" => "Sulu"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SOR",
                "name" => "Sorsogon"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SUK",
                "name" => "Sultan Kudarat"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SUN",
                "name" => "Surigao del Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "SUR",
                "name" => "Surigao del Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "TAR",
                "name" => "Tarlac"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "TAW",
                "name" => "Tawi-Tawi"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "WSA",
                "name" => "Western Samar"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "X1~",
                "name" => "Dinagat Islands"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "X2~",
                "name" => "Shariff Kabunsuan"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ZAN",
                "name" => "Zamboanga del Norte"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ZAS",
                "name" => "Zamboanga del Sur"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ZMB",
                "name" => "Zambales"
            ],
            [
                "country_id" => 0,
                "country_code" => "PH",
                "code" => "ZSI",
                "name" => "Zamboanga Sibuguey [Zamboanga Sibugay]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "DS",
                "name" => "Dolnoslaskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "KP",
                "name" => "Kujawsko-pomorskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "LB",
                "name" => "Lubuskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "LD",
                "name" => "Lódzkie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "LU",
                "name" => "Lubelskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "MA",
                "name" => "Malopolskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "MZ",
                "name" => "Mazowieckie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "OP",
                "name" => "Opolskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "PD",
                "name" => "Podlaskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "PK",
                "name" => "Podkarpackie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "PM",
                "name" => "Pomorskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "SK",
                "name" => "Swietokrzyskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "SL",
                "name" => "Slaskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "WN",
                "name" => "Warminsko-mazurskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "WP",
                "name" => "Wielkopolskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PL",
                "code" => "ZP",
                "name" => "Zachodniopomorskie [Voivodship]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "01",
                "name" => "Aveiro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "02",
                "name" => "Beja [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "03",
                "name" => "Braga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "04",
                "name" => "Bragança [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "05",
                "name" => "Castelo Branco [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "06",
                "name" => "Coimbra [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "07",
                "name" => "Évora [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "08",
                "name" => "Faro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "09",
                "name" => "Guarda [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "10",
                "name" => "Leiria [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "11",
                "name" => "Lisboa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "12",
                "name" => "Portalegre [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "13",
                "name" => "Porto [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "14",
                "name" => "Santarém [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "15",
                "name" => "Setúbal [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "16",
                "name" => "Viana do Castelo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "17",
                "name" => "Vila Real [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "18",
                "name" => "Viseu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "20",
                "name" => "Região Autónoma dos Açores [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "PT",
                "code" => "30",
                "name" => "Região Autónoma da Madeira [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "DA",
                "name" => "Ad Dawhah [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "GH",
                "name" => "Al Ghuwayriyah [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "JB",
                "name" => "Jariyan al Batnah [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "JU",
                "name" => "Al Jumayliyah [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "KH",
                "name" => "Al Khawr wa adh Dhakh?rah [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "MS",
                "name" => "Madinat ash Shamal [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "RA",
                "name" => "Ar Rayyan [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "US",
                "name" => "Umm Salal [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "WA",
                "name" => "Al Wakrah [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "X1~",
                "name" => "Umm Sa'id [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "QA",
                "code" => "ZA",
                "name" => "Az? Z?a‘?yin [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "AB",
                "name" => "Alba [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "AG",
                "name" => "Arges [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "AR",
                "name" => "Arad [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "B",
                "name" => "Bucuresti [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BC",
                "name" => "Bacau [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BH",
                "name" => "Bihor [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BN",
                "name" => "Bistrita-Nasaud [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BR",
                "name" => "Braila [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BT",
                "name" => "Botosani [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BV",
                "name" => "Brasov [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "BZ",
                "name" => "Buzau [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "CJ",
                "name" => "Cluj [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "CL",
                "name" => "Calarasi [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "CS",
                "name" => "Caras-Severin [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "CT",
                "name" => "Constanta [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "CV",
                "name" => "Covasna [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "DB",
                "name" => "Dâmbovita [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "DJ",
                "name" => "Dolj [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "GJ",
                "name" => "Gorj [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "GL",
                "name" => "Galati [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "GR",
                "name" => "Giurgiu [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "HD",
                "name" => "Hunedoara [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "HR",
                "name" => "Harghita [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "IF",
                "name" => "Ilfov [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "IL",
                "name" => "Ialomita [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "IS",
                "name" => "Iasi [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "MH",
                "name" => "Mehedinti [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "MM",
                "name" => "Maramures [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "MS",
                "name" => "Mures [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "NT",
                "name" => "Neamt [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "OT",
                "name" => "Olt [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "PH",
                "name" => "Prahova [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "SB",
                "name" => "Sibiu [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "SJ",
                "name" => "Salaj [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "SM",
                "name" => "Satu Mare [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "SV",
                "name" => "Suceava [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "TL",
                "name" => "Tulcea [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "TM",
                "name" => "Timis [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "TR",
                "name" => "Teleorman [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "VL",
                "name" => "Vâlcea [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "VN",
                "name" => "Vrancea [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RO",
                "code" => "VS",
                "name" => "Vaslui [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "AD",
                "name" => "Adygeya, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "AGB",
                "name" => "Aginskiy Buryatskiy avtonomnyy okrug [Autonomous d"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "AL",
                "name" => "Altay, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ALT",
                "name" => "Altayskiy kray [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "AMU",
                "name" => "Amurskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ARK",
                "name" => "Arkhangel'skaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "AST",
                "name" => "Astrakhanskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "BA",
                "name" => "Bashkortostan, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "BEL",
                "name" => "Belgorodskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "BRY",
                "name" => "Bryanskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "BU",
                "name" => "Buryatiya, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "CE",
                "name" => "Chechenskaya Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "CHE",
                "name" => "Chelyabinskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "CHI",
                "name" => "Chitinskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "CHU",
                "name" => "Chukotskiy avtonomnyy okrug [Autonomous district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "CU",
                "name" => "Chuvashskaya Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "DA",
                "name" => "Dagestan, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "EVE",
                "name" => "Evenkiyskiy avtonomnyy okrug [Autonomous district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "IN",
                "name" => "Ingushskaya Respublika [Respublika Ingushetiya] [R"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "IRK",
                "name" => "Irkutskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "IVA",
                "name" => "Ivanovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KAM",
                "name" => "Kamchatskaya oblast' [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KB",
                "name" => "Kabardino-Balkarskaya Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KC",
                "name" => "Karachayevo-Cherkesskaya Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KDA",
                "name" => "Krasnodarskiy kray [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KEM",
                "name" => "Kemerovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KGD",
                "name" => "Kaliningradskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KGN",
                "name" => "Kurganskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KHA",
                "name" => "Khabarovskiy kray [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KHM",
                "name" => "Khanty-Mansiyskiy avtonomnyy okrug [Yugra] [Autono"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KIR",
                "name" => "Kirovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KK",
                "name" => "Khakasiya, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KL",
                "name" => "Kalmykiya, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KLU",
                "name" => "Kaluzhskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KO",
                "name" => "Komi, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KOR",
                "name" => "Koryakskiy avtonomnyy okrug [Autonomous district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KOS",
                "name" => "Kostromskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KR",
                "name" => "Kareliya, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KRS",
                "name" => "Kurskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "KYA",
                "name" => "Krasnoyarskiy kray [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "LEN",
                "name" => "Leningradskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "LIP",
                "name" => "Lipetskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "MAG",
                "name" => "Magadanskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ME",
                "name" => "Mariy El, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "MO",
                "name" => "Mordoviya, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "MOS",
                "name" => "Moskovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "MOW",
                "name" => "Moskva [Autonomous city]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "MUR",
                "name" => "Murmanskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "NEN",
                "name" => "Nenetskiy avtonomnyy okrug [Autonomous district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "NGR",
                "name" => "Novgorodskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "NIZ",
                "name" => "Nizhegorodskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "NVS",
                "name" => "Novosibirskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "OMS",
                "name" => "Omskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ORE",
                "name" => "Orenburgskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ORL",
                "name" => "Orlovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "PER",
                "name" => "Perm [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "PNZ",
                "name" => "Penzenskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "PRI",
                "name" => "Primorskiy kray [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "PSK",
                "name" => "Pskovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ROS",
                "name" => "Rostovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "RYA",
                "name" => "Ryazanskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SA",
                "name" => "Sakha, Respublika [Yakutiya] [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SAK",
                "name" => "Sakhalinskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SAM",
                "name" => "Samarskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SAR",
                "name" => "Saratovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SE",
                "name" => "Severnaya Osetiya, Respublika [Alaniya] [Respublik"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SMO",
                "name" => "Smolenskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SPE",
                "name" => "Sankt-Peterburg [Autonomous city]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "STA",
                "name" => "Stavropol'skiy kray [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "SVE",
                "name" => "Sverdlovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TA",
                "name" => "Tatarstan, Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TAM",
                "name" => "Tambovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TAY",
                "name" => "Taymyrskiy (Dolgano-Nenetskiy) avtonomnyy okrug [A"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TOM",
                "name" => "Tomskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TUL",
                "name" => "Tul'skaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TVE",
                "name" => "Tverskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TY",
                "name" => "Tyva, Respublika [Tuva] [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "TYU",
                "name" => "Tyumenskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "UD",
                "name" => "Udmurtskaya Respublika [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ULY",
                "name" => "Ul'yanovskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "UOB",
                "name" => "Ust'-Ordynskiy Buryatskiy avtonomnyy okrug [Autono"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "VGG",
                "name" => "Volgogradskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "VLA",
                "name" => "Vladimirskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "VLG",
                "name" => "Vologodskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "VOR",
                "name" => "Voronezhskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "X1~",
                "name" => "Komi-Permyak"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "YAN",
                "name" => "Yamalo-Nenetskiy avtonomnyy okrug [Autonomous dist"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "YAR",
                "name" => "Yaroslavskaya oblast' [Administrative region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "YEV",
                "name" => "Yevreyskaya avtonomnaya oblast' [Autonomous region"
            ],
            [
                "country_id" => 0,
                "country_code" => "RU",
                "code" => "ZAB",
                "name" => "Zabajkal'skij kraj [Administrative territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RW",
                "code" => "01",
                "name" => "Ville de Kigali"
            ],
            [
                "country_id" => 0,
                "country_code" => "RW",
                "code" => "02",
                "name" => "Est"
            ],
            [
                "country_id" => 0,
                "country_code" => "RW",
                "code" => "03",
                "name" => "Nord"
            ],
            [
                "country_id" => 0,
                "country_code" => "RW",
                "code" => "04",
                "name" => "Ouest"
            ],
            [
                "country_id" => 0,
                "country_code" => "RW",
                "code" => "05",
                "name" => "Sud"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "01",
                "name" => "Christ Church Nichola Town [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "02",
                "name" => "Saint Anne Sandy Point [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "03",
                "name" => "Saint George Basseterre [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "04",
                "name" => "Saint George Gingerland [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "05",
                "name" => "Saint James Windward [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "06",
                "name" => "Saint John Capisterre [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "07",
                "name" => "Saint John Figtree [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "08",
                "name" => "Saint Mary Cayon [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "09",
                "name" => "Saint Paul Capisterre [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "10",
                "name" => "Saint Paul Charlestown [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "11",
                "name" => "Saint Peter Basseterre [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "12",
                "name" => "Saint Thomas Lowland [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "13",
                "name" => "Saint Thomas Middle Island [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "15",
                "name" => "Trinity Palmetto Point [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "K",
                "name" => "Saint Kitts"
            ],
            [
                "country_id" => 0,
                "country_code" => "KN",
                "code" => "N",
                "name" => "Nevis"
            ],
            [
                "country_id" => 0,
                "country_code" => "VC",
                "code" => "01",
                "name" => "Charlotte [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VC",
                "code" => "02",
                "name" => "Saint Andrew [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VC",
                "code" => "03",
                "name" => "Saint David [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VC",
                "code" => "04",
                "name" => "Saint George [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VC",
                "code" => "05",
                "name" => "Saint Patrick [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VC",
                "code" => "06",
                "name" => "Grenadines [Parish]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "AA",
                "name" => "A'ana [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "AL",
                "name" => "Aiga-i-le-Tai [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "AT",
                "name" => "Atua [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "FA",
                "name" => "Fa'asaleleaga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "GE",
                "name" => "Gaga'emauga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "GI",
                "name" => "Gagaifomauga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "PA",
                "name" => "Palauli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "SA",
                "name" => "Satupa'itea [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "TU",
                "name" => "Tuamasaga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "VF",
                "name" => "Va'a-o-Fonoti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "WS",
                "code" => "VS",
                "name" => "Vaisigano [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "01",
                "name" => "Acquaviva [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "02",
                "name" => "Chiesanuova [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "03",
                "name" => "Domagnano [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "04",
                "name" => "Faetano [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "05",
                "name" => "Fiorentino [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "06",
                "name" => "Borgo Maggiore [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "07",
                "name" => "San Marino [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "08",
                "name" => "Montegiardino [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SM",
                "code" => "09",
                "name" => "Serravalle [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ST",
                "code" => "P",
                "name" => "Príncipe [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ST",
                "code" => "S",
                "name" => "São Tomé [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "01",
                "name" => "Ar Riy?? [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "02",
                "name" => "Makkah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "03",
                "name" => "Al Madinah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "04",
                "name" => "Ash Sharqiyah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "05",
                "name" => "Al Qasim [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "06",
                "name" => "?a'il [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "07",
                "name" => "Tabuk [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "08",
                "name" => "Al ?ud?d ash Sham?l?yah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "09",
                "name" => "Jizan [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "10",
                "name" => "Najran [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "11",
                "name" => "Al B??ah [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "12",
                "name" => "Al Jawf [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SA",
                "code" => "14",
                "name" => "?Asir [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "DB",
                "name" => "Diourbel [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "DK",
                "name" => "Dakar [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "FK",
                "name" => "Fatick [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "KA",
                "name" => "Kaffrine [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "KD",
                "name" => "Kolda [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "KE",
                "name" => "Kédougou [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "KL",
                "name" => "Kaolack [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "LG",
                "name" => "Louga [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "MT",
                "name" => "Matam [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "SE",
                "name" => "Sédhiou [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "SL",
                "name" => "Saint-Louis [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "TC",
                "name" => "Tambacounda [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "TH",
                "name" => "Thiès [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SN",
                "code" => "ZG",
                "name" => "Ziguinchor [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "00",
                "name" => "Belgrade [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "01",
                "name" => "Severnoba?ki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "02",
                "name" => "Srednjebanatski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "03",
                "name" => "Severnobanatski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "04",
                "name" => "Južnobanatski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "05",
                "name" => "Zapadnobaèki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "06",
                "name" => "Južnoba?ki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "07",
                "name" => "Sremski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "08",
                "name" => "Ma?vanski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "09",
                "name" => "Kolubarski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "10",
                "name" => "Podunavski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "11",
                "name" => "Brani?evski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "12",
                "name" => "Šumadijski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "13",
                "name" => "Pomoravski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "14",
                "name" => "Borski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "15",
                "name" => "Zajeèarski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "16",
                "name" => "Zlatiborski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "17",
                "name" => "Moravi?ki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "18",
                "name" => "Raška okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "19",
                "name" => "Rasinski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "20",
                "name" => "Nišavski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "21",
                "name" => "Toplièki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "22",
                "name" => "Pirotski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "23",
                "name" => "Jablani?ki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "24",
                "name" => "P?injski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "25",
                "name" => "Kosovski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "26",
                "name" => "Pe?ki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "27",
                "name" => "Prizrenski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "28",
                "name" => "Kosovsko-Mitrova?ki okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "RS",
                "code" => "29",
                "name" => "Kosovsko-Pomoravski okrug [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "01",
                "name" => "Anse aux Pins [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "02",
                "name" => "Anse Boileau [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "03",
                "name" => "Anse Étoile [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "04",
                "name" => "Au Cap [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "05",
                "name" => "Anse Royale [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "06",
                "name" => "Baie Lazare [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "07",
                "name" => "Baie Sainte Anne [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "08",
                "name" => "Beau Vallon [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "09",
                "name" => "Bel Air [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "10",
                "name" => "Bel Ombre [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "11",
                "name" => "Cascade [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "12",
                "name" => "Glacis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "13",
                "name" => "Grand Anse Mahe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "14",
                "name" => "Grand Anse Praslin [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "15",
                "name" => "La Digue [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "16",
                "name" => "English River [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "17",
                "name" => "Mont Buxton [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "18",
                "name" => "Mont Fleuri [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "19",
                "name" => "Plaisance [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "20",
                "name" => "Pointe La Rue [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "21",
                "name" => "Port Glaud [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "22",
                "name" => "Saint Louis [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "23",
                "name" => "Takamaka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "24",
                "name" => "Les Mamelles [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SC",
                "code" => "25",
                "name" => "Roche Caiman [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SL",
                "code" => "E",
                "name" => "Eastern"
            ],
            [
                "country_id" => 0,
                "country_code" => "SL",
                "code" => "N",
                "name" => "Northern"
            ],
            [
                "country_id" => 0,
                "country_code" => "SL",
                "code" => "S",
                "name" => "Southern"
            ],
            [
                "country_id" => 0,
                "country_code" => "SL",
                "code" => "W",
                "name" => "Western Area (Freetown) [Area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SG",
                "code" => "01",
                "name" => "Central Singapore [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SG",
                "code" => "02",
                "name" => "North East [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SG",
                "code" => "03",
                "name" => "North West [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SG",
                "code" => "04",
                "name" => "South East [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SG",
                "code" => "05",
                "name" => "South West [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SG",
                "code" => "X1~",
                "name" => "Singapore - No State"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "BC",
                "name" => "Banskobystrický kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "BL",
                "name" => "Bratislavský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "KI",
                "name" => "Košický kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "NI",
                "name" => "Nitriansky kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "PV",
                "name" => "Prešovský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "TA",
                "name" => "Trnavský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "TC",
                "name" => "Trenciansky kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SK",
                "code" => "ZI",
                "name" => "Žilinský kraj [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "001",
                "name" => "Ajdovšcina"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "002",
                "name" => "Beltinci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "003",
                "name" => "Bled"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "004",
                "name" => "Bohinj"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "005",
                "name" => "Borovnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "006",
                "name" => "Bovec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "007",
                "name" => "Brda"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "008",
                "name" => "Brezovica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "009",
                "name" => "Brežice"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "010",
                "name" => "Tišina"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "011",
                "name" => "Celje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "012",
                "name" => "Cerklje na Gorenjskem"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "013",
                "name" => "Cerknica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "014",
                "name" => "Cerkno"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "015",
                "name" => "Crenšovci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "016",
                "name" => "Crna na Koroškem"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "017",
                "name" => "Crnomelj"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "018",
                "name" => "Destrnik"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "019",
                "name" => "Divaca"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "020",
                "name" => "Dobrepolje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "021",
                "name" => "Dobrova-Polhov Gradec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "022",
                "name" => "Dol pri Ljubljani"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "023",
                "name" => "Domžale"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "024",
                "name" => "Dornava"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "025",
                "name" => "Dravograd"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "026",
                "name" => "Duplek"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "027",
                "name" => "Gorenja vas-Poljane"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "028",
                "name" => "Gorišnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "029",
                "name" => "Gornja Radgona"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "030",
                "name" => "Gornji Grad"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "031",
                "name" => "Gornji Petrovci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "032",
                "name" => "Grosuplje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "033",
                "name" => "Šalovci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "034",
                "name" => "Hrastnik"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "035",
                "name" => "Hrpelje-Kozina"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "036",
                "name" => "Idrija"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "037",
                "name" => "Ig"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "038",
                "name" => "Ilirska Bistrica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "039",
                "name" => "Ivancna Gorica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "040",
                "name" => "Izola/Isola"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "041",
                "name" => "Jesenice"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "042",
                "name" => "Juršinci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "043",
                "name" => "Kamnik"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "044",
                "name" => "Kanal"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "045",
                "name" => "Kidricevo"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "046",
                "name" => "Kobarid"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "047",
                "name" => "Kobilje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "048",
                "name" => "Kocevje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "049",
                "name" => "Komen"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "050",
                "name" => "Koper/Capodistria"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "051",
                "name" => "Kozje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "052",
                "name" => "Kranj"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "053",
                "name" => "Kranjska Gora"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "054",
                "name" => "Krško"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "055",
                "name" => "Kungota"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "056",
                "name" => "Kuzma"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "057",
                "name" => "Laško"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "058",
                "name" => "Lenart"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "059",
                "name" => "Lendava/Lendva"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "060",
                "name" => "Litija"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "061",
                "name" => "Ljubljana"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "062",
                "name" => "Ljubno"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "063",
                "name" => "Ljutomer"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "064",
                "name" => "Logatec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "065",
                "name" => "Loška dolina"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "066",
                "name" => "Loški Potok"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "067",
                "name" => "Luce"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "068",
                "name" => "Lukovica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "069",
                "name" => "Majšperk"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "070",
                "name" => "Maribor"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "071",
                "name" => "Medvode"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "072",
                "name" => "Mengeš"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "073",
                "name" => "Metlika"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "074",
                "name" => "Mežica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "075",
                "name" => "Miren-Kostanjevica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "076",
                "name" => "Mislinja"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "077",
                "name" => "Moravce"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "078",
                "name" => "Moravske Toplice"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "079",
                "name" => "Mozirje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "080",
                "name" => "Murska Sobota"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "081",
                "name" => "Muta"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "082",
                "name" => "Naklo"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "083",
                "name" => "Nazarje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "084",
                "name" => "Nova Gorica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "085",
                "name" => "Novo mesto"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "086",
                "name" => "Odranci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "087",
                "name" => "Ormož"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "088",
                "name" => "Osilnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "089",
                "name" => "Pesnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "090",
                "name" => "Piran/Pirano"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "091",
                "name" => "Pivka"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "092",
                "name" => "Podcetrtek"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "093",
                "name" => "Podvelka"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "094",
                "name" => "Postojna"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "095",
                "name" => "Preddvor"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "096",
                "name" => "Ptuj"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "097",
                "name" => "Puconci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "098",
                "name" => "Race-Fram"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "099",
                "name" => "Radece"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "100",
                "name" => "Radenci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "101",
                "name" => "Radlje ob Dravi"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "102",
                "name" => "Radovljica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "103",
                "name" => "Ravne na Koroškem"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "104",
                "name" => "Ribnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "105",
                "name" => "Rogašovci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "106",
                "name" => "Rogaška Slatina"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "107",
                "name" => "Rogatec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "108",
                "name" => "Ruše"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "109",
                "name" => "Semic"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "110",
                "name" => "Sevnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "111",
                "name" => "Sežana"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "112",
                "name" => "Slovenj Gradec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "113",
                "name" => "Slovenska Bistrica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "114",
                "name" => "Slovenske Konjice"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "115",
                "name" => "Starše"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "116",
                "name" => "Sveti Jurij"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "117",
                "name" => "Šencur"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "118",
                "name" => "Šentilj"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "119",
                "name" => "Šentjernej"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "120",
                "name" => "Šentjur pri Celju"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "121",
                "name" => "Škocjan"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "122",
                "name" => "Škofja Loka"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "123",
                "name" => "Škofljica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "124",
                "name" => "Šmarje pri Jelšah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "125",
                "name" => "Šmartno ob Paki"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "126",
                "name" => "Šoštanj"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "127",
                "name" => "Štore"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "128",
                "name" => "Tolmin"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "129",
                "name" => "Trbovlje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "130",
                "name" => "Trebnje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "131",
                "name" => "Tržic"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "132",
                "name" => "Turnišce"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "133",
                "name" => "Velenje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "134",
                "name" => "Velike Lašce"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "135",
                "name" => "Videm"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "136",
                "name" => "Vipava"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "137",
                "name" => "Vitanje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "138",
                "name" => "Vodice"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "139",
                "name" => "Vojnik"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "140",
                "name" => "Vrhnika"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "141",
                "name" => "Vuzenica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "142",
                "name" => "Zagorje ob Savi"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "143",
                "name" => "Zavrc"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "144",
                "name" => "Zrece"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "146",
                "name" => "Železniki"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "147",
                "name" => "Žiri"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "148",
                "name" => "Benedikt"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "149",
                "name" => "Bistrica ob Sotli"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "150",
                "name" => "Bloke"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "151",
                "name" => "Braslovce"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "152",
                "name" => "Cankova"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "153",
                "name" => "Cerkvenjak"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "154",
                "name" => "Dobje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "155",
                "name" => "Dobrna"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "156",
                "name" => "Dobrovnik/Dobronak"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "157",
                "name" => "Dolenjske Toplice"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "158",
                "name" => "Grad"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "159",
                "name" => "Hajdina"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "160",
                "name" => "Hoce-Slivnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "161",
                "name" => "Hodoš/Hodos"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "162",
                "name" => "Horjul"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "163",
                "name" => "Jezersko"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "164",
                "name" => "Komenda"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "165",
                "name" => "Kostel"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "166",
                "name" => "Križevci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "167",
                "name" => "Lovrenc na Pohorju"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "168",
                "name" => "Markovci"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "169",
                "name" => "Miklavž na Dravskem polju"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "170",
                "name" => "Mirna Pec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "171",
                "name" => "Oplotnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "172",
                "name" => "Podlehnik"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "173",
                "name" => "Polzela"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "174",
                "name" => "Prebold"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "175",
                "name" => "Prevalje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "176",
                "name" => "Razkrižje"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "177",
                "name" => "Ribnica na Pohorju"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "178",
                "name" => "Selnica ob Dravi"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "179",
                "name" => "Sodražica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "180",
                "name" => "Solcava"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "181",
                "name" => "Sveta Ana"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "182",
                "name" => "Sveti Andraž v Slovenskih goricah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "183",
                "name" => "Šempeter-Vrtojba"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "184",
                "name" => "Tabor"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "185",
                "name" => "Trnovska vas"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "186",
                "name" => "Trzin"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "187",
                "name" => "Velika Polana"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "188",
                "name" => "Veržej"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "189",
                "name" => "Vransko"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "190",
                "name" => "Žalec"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "191",
                "name" => "Žetale"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "192",
                "name" => "Žirovnica"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "193",
                "name" => "Žužemberk"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "194",
                "name" => "Šmartno pri Litiji [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "194",
                "name" => "Šmartno pri Litiji"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "195",
                "name" => "Apa?e [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "196",
                "name" => "Kosanjevica na Krki [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "197",
                "name" => "Cirkulane [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "198",
                "name" => "Makole [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "199",
                "name" => "Mokronog-Trebelno [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "200",
                "name" => "Polj?ane [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "201",
                "name" => "Ren?e-Vogrsko [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "202",
                "name" => "Središ?e ob Dravi [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "203",
                "name" => "Straža [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "204",
                "name" => "Sveta Trojica v Slovenskih Goricah [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "205",
                "name" => "Sveti Tomaž [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "206",
                "name" => "Šmarješke Toplice [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "207",
                "name" => "Gorje [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "208",
                "name" => "Log-Dragomer [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "209",
                "name" => "Re?ica ob Savinji [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "210",
                "name" => "Sveti Jurij v Slovenskih Goricah [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SI",
                "code" => "211",
                "name" => "Šentrupert [Commune]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "CE",
                "name" => "Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "CH",
                "name" => "Choiseul"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "CT",
                "name" => "Capital Territory (Honiara) [Capital territory]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "GU",
                "name" => "Guadalcanal"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "IS",
                "name" => "Isabel"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "MK",
                "name" => "Makira"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "ML",
                "name" => "Malaita"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "RB",
                "name" => "Rennell and Bellona"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "TE",
                "name" => "Temotu"
            ],
            [
                "country_id" => 0,
                "country_code" => "SB",
                "code" => "WE",
                "name" => "Western"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "AW",
                "name" => "Awdal [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "BK",
                "name" => "Bakool [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "BN",
                "name" => "Banaadir [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "BR",
                "name" => "Bari [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "BY",
                "name" => "Bay [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "GA",
                "name" => "Galguduud [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "GE",
                "name" => "Gedo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "HI",
                "name" => "Hiiraan [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "JD",
                "name" => "Jubbada Dhexe [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "JH",
                "name" => "Jubbada Hoose [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "MU",
                "name" => "Mudug [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "NU",
                "name" => "Nugaal [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "SA",
                "name" => "Sanaag [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "SD",
                "name" => "Shabeellaha Dhexe [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "SH",
                "name" => "Shabeellaha Hoose [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "SO",
                "name" => "Sool [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "TO",
                "name" => "Togdheer [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SO",
                "code" => "WO",
                "name" => "Woqooyi Galbeed [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "EC",
                "name" => "Eastern Cape"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "FS",
                "name" => "Free State"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "GT",
                "name" => "Gauteng"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "LP",
                "name" => "Limpopo"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "MP",
                "name" => "Mpumalanga"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "NC",
                "name" => "Northern Cape"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "NL",
                "name" => "Kwazulu-Natal"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "NW",
                "name" => "North-West"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZA",
                "code" => "WC",
                "name" => "Western Cape"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "A",
                "name" => "Alicante"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "AB",
                "name" => "Albacete"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "AL",
                "name" => "Almería"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "AN",
                "name" => "Andalucía"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "AR",
                "name" => "Aragón"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "AS",
                "name" => "Asturias, Principado de [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "AV",
                "name" => "Ávila"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "B",
                "name" => "Barcelona"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "BA",
                "name" => "Badajoz"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "BI",
                "name" => "Vizcaya"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "BU",
                "name" => "Burgos"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "C",
                "name" => "A Coruña"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CA",
                "name" => "Cádiz"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CB",
                "name" => "Cantabria [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CC",
                "name" => "Cáceres"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CE",
                "name" => "Ceuta [Autonomous city]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CL",
                "name" => "Castilla y León [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CM",
                "name" => "Castilla-La Mancha [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CN",
                "name" => "Canarias"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CO",
                "name" => "Córdoba"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CR",
                "name" => "Ciudad Real"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CS",
                "name" => "Castellón"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CT",
                "name" => "Catalunya [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "CU",
                "name" => "Cuenca"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "EX",
                "name" => "Extremadura [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "GA",
                "name" => "Galicia [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "GC",
                "name" => "Las Palmas"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "GI",
                "name" => "Girona"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "GR",
                "name" => "Granada"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "GU",
                "name" => "Guadalajara"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "H",
                "name" => "Huelva"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "HU",
                "name" => "Huesca"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "IB",
                "name" => "Illes Balears [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "J",
                "name" => "Jaén"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "L",
                "name" => "Lleida"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "LE",
                "name" => "León"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "LO",
                "name" => "La Rioja"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "LU",
                "name" => "Lugo"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "M",
                "name" => "Madrid"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "MA",
                "name" => "Málaga"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "MC",
                "name" => "Murcia, Región de [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "MD",
                "name" => "Madrid, Comunidad de [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "ML",
                "name" => "Melilla [Autonomous city]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "MU",
                "name" => "Murcia"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "NA",
                "name" => "Navarra"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "NC",
                "name" => "Navarra, Comunidad Foral de [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "O",
                "name" => "Asturias"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "OR",
                "name" => "Ourense"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "P",
                "name" => "Palencia"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "PM",
                "name" => "Baleares"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "PO",
                "name" => "Pontevedra"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "PV",
                "name" => "País Vasco [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "RI",
                "name" => "La Rioja [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "S",
                "name" => "Cantabria"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "SA",
                "name" => "Salamanca"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "SE",
                "name" => "Sevilla"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "SG",
                "name" => "Segovia"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "SO",
                "name" => "Soria"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "SS",
                "name" => "Guipúzcoa"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "T",
                "name" => "Tarragona"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "TE",
                "name" => "Teruel"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "TF",
                "name" => "Santa Cruz de Tenerife"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "TO",
                "name" => "Toledo"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "V",
                "name" => "Valencia"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "VA",
                "name" => "Valladolid"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "VC",
                "name" => "Valenciana, Comunidad [Autonomous community]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "VI",
                "name" => "Álava"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "Z",
                "name" => "Zaragoza"
            ],
            [
                "country_id" => 0,
                "country_code" => "ES",
                "code" => "ZA",
                "name" => "Zamora"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "1",
                "name" => "Basn?hira pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "2",
                "name" => "Madhyama pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "3",
                "name" => "Daku?u pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "4",
                "name" => "Uturu pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "5",
                "name" => "Mattiya m?k??am"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "6",
                "name" => "Vayamba pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "7",
                "name" => "Uturumæ?da pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "8",
                "name" => "?va pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "9",
                "name" => "Sabaragamuva pa??ta"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "11",
                "name" => "K??amba [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "12",
                "name" => "Gampaha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "13",
                "name" => "Kalutara [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "21",
                "name" => "Mahanuvara [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "22",
                "name" => "M?tale [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "23",
                "name" => "Nuvara ?liya [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "31",
                "name" => "G?lla [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "32",
                "name" => "M?tara [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "33",
                "name" => "Hambant??a [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "41",
                "name" => "Y?panaya [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "42",
                "name" => "Kilin?chchi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "43",
                "name" => "Mann?rama [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "44",
                "name" => "Vavuniy?va [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "45",
                "name" => "Mulativ [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "51",
                "name" => "Madakalapuva [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "52",
                "name" => "Amp?ra [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "53",
                "name" => "Triku??malaya [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "61",
                "name" => "Kuru?ægala [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "62",
                "name" => "Puttalama [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "71",
                "name" => "Anur?dhapura [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "72",
                "name" => "P???nnaruva [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "81",
                "name" => "Badulla [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "82",
                "name" => "M??ar?gala [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "91",
                "name" => "Ratnapura [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "LK",
                "code" => "92",
                "name" => "Kegalla [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "DC",
                "name" => "Zalingei"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "DE",
                "name" => "Sharq D?rf?r"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "DN",
                "name" => "Shamal Darfur"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "DS",
                "name" => "Janub Darfur"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "DW",
                "name" => "Gharb Darfur"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "GD",
                "name" => "Al Qa??rif"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "GZ",
                "name" => "Al Jazirah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "KA",
                "name" => "Kassala"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "KH",
                "name" => "Al Khartum"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "KN",
                "name" => "Shamal Kurdufan"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "KS",
                "name" => "Janub Kurdufan"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "NB",
                "name" => "An Nil al Azraq"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "NO",
                "name" => "Ash Shamaliyah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "NR",
                "name" => "An Nil"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "NW",
                "name" => "An N?l al Abya?"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "RS",
                "name" => "Al Bah¸r al Ah¸mar"
            ],
            [
                "country_id" => 0,
                "country_code" => "SD",
                "code" => "SI",
                "name" => "Sinnar"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "BR",
                "name" => "Brokopondo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "CM",
                "name" => "Commewijne [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "CR",
                "name" => "Coronie [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "MA",
                "name" => "Marowijne [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "NI",
                "name" => "Nickerie [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "PM",
                "name" => "Paramaribo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "PR",
                "name" => "Para [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "SA",
                "name" => "Saramacca [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "SI",
                "name" => "Sipaliwini [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SR",
                "code" => "WA",
                "name" => "Wanica [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SZ",
                "code" => "HH",
                "name" => "Hhohho [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SZ",
                "code" => "LU",
                "name" => "Lubombo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SZ",
                "code" => "MA",
                "name" => "Manzini [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SZ",
                "code" => "SH",
                "name" => "Shiselweni [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "AB",
                "name" => "Stockholms län [SE-01] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "AC",
                "name" => "Västerbottens län [SE-24] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "BD",
                "name" => "Norrbottens län [SE-25] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "C",
                "name" => "Uppsala län [SE-03] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "D",
                "name" => "Södermanlands län [SE-04] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "E",
                "name" => "Östergötlands län [SE-05] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "F",
                "name" => "Jönköpings län [SE-06] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "G",
                "name" => "Kronobergs län [SE-07] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "H",
                "name" => "Kalmar län [SE-08] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "I",
                "name" => "Gotlands län [SE-09] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "K",
                "name" => "Blekinge län [SE-10] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "M",
                "name" => "Skåne län [SE-12] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "N",
                "name" => "Hallands län [SE-13] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "O",
                "name" => "Västra Götalands län [SE-14] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "S",
                "name" => "Värmlands län [SE-17] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "T",
                "name" => "Örebro län [SE-18] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "U",
                "name" => "Västmanlands län [SE-19] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "W",
                "name" => "Dalarnas län [SE-20] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "X",
                "name" => "Gävleborgs län [SE-21] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "Y",
                "name" => "Västernorrlands län [SE-22] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SE",
                "code" => "Z",
                "name" => "Jämtlands län [SE-23] [County]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "AG",
                "name" => "Aargau (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "AI",
                "name" => "Appenzell Innerrhoden (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "AR",
                "name" => "Appenzell Ausserrhoden (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "BE",
                "name" => "Bern (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "BL",
                "name" => "Basel-Landschaft (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "BS",
                "name" => "Basel-Stadt (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "FR",
                "name" => "Fribourg (fr) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "GE",
                "name" => "Genève (fr) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "GL",
                "name" => "Glarus (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "GR",
                "name" => "Graubünden (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "JU",
                "name" => "Jura (fr) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "LU",
                "name" => "Luzern (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "NE",
                "name" => "Neuchâtel (fr) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "NW",
                "name" => "Nidwalden (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "OW",
                "name" => "Obwalden (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "SG",
                "name" => "Sankt Gallen (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "SH",
                "name" => "Schaffhausen (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "SO",
                "name" => "Solothurn (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "SZ",
                "name" => "Schwyz (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "TG",
                "name" => "Thurgau (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "TI",
                "name" => "Ticino (it) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "UR",
                "name" => "Uri (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "VD",
                "name" => "Vaud (fr) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "VS",
                "name" => "Valais (fr) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "ZG",
                "name" => "Zug (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "CH",
                "code" => "ZH",
                "name" => "Zürich (de) [Canton]"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "DI",
                "name" => "Dimashq"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "DR",
                "name" => "Dar?a"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "DY",
                "name" => "Dayr az Zawr"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "HA",
                "name" => "Al ?asakah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "HI",
                "name" => "?ims"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "HL",
                "name" => "?alab"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "HM",
                "name" => "?amah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "ID",
                "name" => "Idlib"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "LA",
                "name" => "Al Ladhiqiyah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "QU",
                "name" => "Al Qunaytirah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "RA",
                "name" => "Ar Raqqah"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "RD",
                "name" => "Rif Dimashq"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "SU",
                "name" => "As Suwayda'"
            ],
            [
                "country_id" => 0,
                "country_code" => "SY",
                "code" => "TA",
                "name" => "Tartus"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "CHA",
                "name" => "Changhua [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "CYI",
                "name" => "Chiayi Municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "CYQ",
                "name" => "Chiayi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "HSQ",
                "name" => "Hsinchu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "HSZ",
                "name" => "Hsinchu Municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "HUA",
                "name" => "Hualien [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "ILA",
                "name" => "Ilan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "KEE",
                "name" => "Keelung Municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "KHH",
                "name" => "Kaohsiung Special Municipality [Special municipali"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "KHQ",
                "name" => "Kaohsiung [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "MIA",
                "name" => "Miaoli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "NAN",
                "name" => "Nantou [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "PEN",
                "name" => "Penghu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "PIF",
                "name" => "Pingtung [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TAO",
                "name" => "Taoyuan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TNN",
                "name" => "Tainan Municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TNQ",
                "name" => "Tainan [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TPE",
                "name" => "Taipei Special Municipality [Special municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TPQ",
                "name" => "Taipei [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TTT",
                "name" => "Taitung [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TXG",
                "name" => "Taichung Municipality [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "TXQ",
                "name" => "Taichung [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TW",
                "code" => "YUN",
                "name" => "Yunlin [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TJ",
                "code" => "GB",
                "name" => "Gorno-Badakhshan [Autonomous region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TJ",
                "code" => "KT",
                "name" => "Khatlon [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TJ",
                "code" => "SU",
                "name" => "Sughd [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "01",
                "name" => "Arusha [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "02",
                "name" => "Dar es Salaam [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "03",
                "name" => "Dodoma [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "04",
                "name" => "Iringa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "05",
                "name" => "Kagera [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "06",
                "name" => "Kaskazini Pemba [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "07",
                "name" => "Kaskazini Unguja [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "08",
                "name" => "Kigoma [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "09",
                "name" => "Kilimanjaro [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "10",
                "name" => "Kusini Pemba [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "11",
                "name" => "Kusini Unguja [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "12",
                "name" => "Lindi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "13",
                "name" => "Mara [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "14",
                "name" => "Mbeya [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "15",
                "name" => "Mjini Magharibi [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "16",
                "name" => "Morogoro [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "17",
                "name" => "Mtwara [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "18",
                "name" => "Mwanza [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "19",
                "name" => "Pwani [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "20",
                "name" => "Rukwa [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "21",
                "name" => "Ruvuma [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "22",
                "name" => "Shinyanga [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "23",
                "name" => "Singida [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "24",
                "name" => "Tabora [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "25",
                "name" => "Tanga [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TZ",
                "code" => "26",
                "name" => "Manyara [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "10",
                "name" => "Krung Thep Maha Nakhon [Bangkok] [Metropolitan adm"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "11",
                "name" => "Samut Prakan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "12",
                "name" => "Nonthaburi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "13",
                "name" => "Pathum Thani"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "14",
                "name" => "Phra Nakhon Si Ayutthaya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "15",
                "name" => "Ang Thong"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "16",
                "name" => "Lop Buri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "17",
                "name" => "Sing Buri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "18",
                "name" => "Chai Nat"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "19",
                "name" => "Saraburi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "20",
                "name" => "Chon Buri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "21",
                "name" => "Rayong"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "22",
                "name" => "Chanthaburi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "23",
                "name" => "Trat"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "24",
                "name" => "Chachoengsao"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "25",
                "name" => "Prachin Buri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "26",
                "name" => "Nakhon Nayok"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "27",
                "name" => "Sa Kaeo"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "30",
                "name" => "Nakhon Ratchasima"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "31",
                "name" => "Buri Ram"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "32",
                "name" => "Surin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "33",
                "name" => "Si Sa Ket"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "34",
                "name" => "Ubon Ratchathani"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "35",
                "name" => "Yasothon"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "36",
                "name" => "Chaiyaphum"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "37",
                "name" => "Amnat Charoen"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "39",
                "name" => "Nong Bua Lam Phu"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "40",
                "name" => "Khon Kaen"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "41",
                "name" => "Udon Thani"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "42",
                "name" => "Loei"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "43",
                "name" => "Nong Khai"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "44",
                "name" => "Maha Sarakham"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "45",
                "name" => "Roi Et"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "46",
                "name" => "Kalasin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "47",
                "name" => "Sakon Nakhon"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "48",
                "name" => "Nakhon Phanom"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "49",
                "name" => "Mukdahan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "50",
                "name" => "Chiang Mai"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "51",
                "name" => "Lamphun"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "52",
                "name" => "Lampang"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "53",
                "name" => "Uttaradit"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "54",
                "name" => "Phrae"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "55",
                "name" => "Nan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "56",
                "name" => "Phayao"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "57",
                "name" => "Chiang Rai"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "58",
                "name" => "Mae Hong Son"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "60",
                "name" => "Nakhon Sawan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "61",
                "name" => "Uthai Thani"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "62",
                "name" => "Kamphaeng Phet"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "63",
                "name" => "Tak"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "64",
                "name" => "Sukhothai"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "65",
                "name" => "Phitsanulok"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "66",
                "name" => "Phichit"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "67",
                "name" => "Phetchabun"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "70",
                "name" => "Ratchaburi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "71",
                "name" => "Kanchanaburi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "72",
                "name" => "Suphan Buri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "73",
                "name" => "Nakhon Pathom"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "74",
                "name" => "Samut Sakhon"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "75",
                "name" => "Samut Songkhram"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "76",
                "name" => "Phetchaburi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "77",
                "name" => "Prachuap Khiri Khan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "80",
                "name" => "Nakhon Si Thammarat"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "81",
                "name" => "Krabi"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "82",
                "name" => "Phangnga"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "83",
                "name" => "Phuket"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "84",
                "name" => "Surat Thani"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "85",
                "name" => "Ranong"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "86",
                "name" => "Chumphon"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "90",
                "name" => "Songkhla"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "91",
                "name" => "Satun"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "92",
                "name" => "Trang"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "93",
                "name" => "Phatthalung"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "94",
                "name" => "Pattani"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "95",
                "name" => "Yala"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "96",
                "name" => "Narathiwat"
            ],
            [
                "country_id" => 0,
                "country_code" => "TH",
                "code" => "S",
                "name" => "Phatthaya [Special administrative city]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "AL",
                "name" => "Aileu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "AN",
                "name" => "Ainaro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "BA",
                "name" => "Baucau [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "BO",
                "name" => "Bobonaro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "CO",
                "name" => "Cova Lima [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "DI",
                "name" => "Díli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "ER",
                "name" => "Ermera [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "LA",
                "name" => "Lautem [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "LI",
                "name" => "Liquiça [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "MF",
                "name" => "Manufahi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "MT",
                "name" => "Manatuto [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "OE",
                "name" => "Oecussi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TL",
                "code" => "VI",
                "name" => "Viqueque [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TG",
                "code" => "C",
                "name" => "Centre [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TG",
                "code" => "K",
                "name" => "Kara [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TG",
                "code" => "M",
                "name" => "Maritime (Région) [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TG",
                "code" => "P",
                "name" => "Plateaux [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TG",
                "code" => "S",
                "name" => "Savannes [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TO",
                "code" => "01",
                "name" => "Eua [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TO",
                "code" => "02",
                "name" => "Ha'apai [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TO",
                "code" => "03",
                "name" => "Niuas [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TO",
                "code" => "04",
                "name" => "Tongatapu [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TO",
                "code" => "05",
                "name" => "Vava'u [Island group]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "ARI",
                "name" => "Arima [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "CHA",
                "name" => "Chaguanas [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "CTT",
                "name" => "Couva-Tabaquite-Talparo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "DMN",
                "name" => "Diego Martin [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "ETO",
                "name" => "Eastern Tobago [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "PED",
                "name" => "Penal-Debe [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "POS",
                "name" => "Port of Spain [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "PRT",
                "name" => "Princes Town [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "PTF",
                "name" => "Point Fortin [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "RCM",
                "name" => "Rio Claro-Mayaro [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "SFO",
                "name" => "San Fernando [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "SGE",
                "name" => "Sangre Grande [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "SIP",
                "name" => "Siparia [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "SJL",
                "name" => "San Juan-Laventille [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "TUP",
                "name" => "Tunapuna-Piarco [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TT",
                "code" => "WTO",
                "name" => "Western Tobago [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "11",
                "name" => "Tunis [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "12",
                "name" => "Ariana [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "13",
                "name" => "Ben Arous [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "14",
                "name" => "La Manouba [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "21",
                "name" => "Nabeul [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "22",
                "name" => "Zaghouan [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "23",
                "name" => "Bizerte [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "31",
                "name" => "Béja [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "32",
                "name" => "Jendouba [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "33",
                "name" => "Le Kef [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "34",
                "name" => "Siliana [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "41",
                "name" => "Kairouan [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "42",
                "name" => "Kasserine [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "43",
                "name" => "Sidi Bouzid [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "51",
                "name" => "Sousse [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "52",
                "name" => "Monastir [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "53",
                "name" => "Mahdia [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "61",
                "name" => "Sfax [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "71",
                "name" => "Gafsa [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "72",
                "name" => "Tozeur [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "73",
                "name" => "Kebili [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "81",
                "name" => "Gabès [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "82",
                "name" => "Medenine [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TN",
                "code" => "83",
                "name" => "Tataouine [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "01",
                "name" => "Adana"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "02",
                "name" => "Adiyaman"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "03",
                "name" => "Afyonkarahisar"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "04",
                "name" => "Agri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "05",
                "name" => "Amasya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "06",
                "name" => "Ankara"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "07",
                "name" => "Antalya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "08",
                "name" => "Artvin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "09",
                "name" => "Aydin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "10",
                "name" => "Balikesir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "11",
                "name" => "Bilecik"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "12",
                "name" => "Bingöl"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "13",
                "name" => "Bitlis"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "14",
                "name" => "Bolu"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "15",
                "name" => "Burdur"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "16",
                "name" => "Bursa"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "17",
                "name" => "Çanakkale"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "18",
                "name" => "Çankiri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "19",
                "name" => "Çorum"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "20",
                "name" => "Denizli"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "21",
                "name" => "Diyarbakir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "22",
                "name" => "Edirne"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "23",
                "name" => "Elazig"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "24",
                "name" => "Erzincan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "25",
                "name" => "Erzurum"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "26",
                "name" => "Eskisehir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "27",
                "name" => "Gaziantep"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "28",
                "name" => "Giresun"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "29",
                "name" => "Gümüshane"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "30",
                "name" => "Hakkâri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "31",
                "name" => "Hatay"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "32",
                "name" => "Isparta"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "33",
                "name" => "Mersin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "34",
                "name" => "Istanbul"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "35",
                "name" => "Izmir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "36",
                "name" => "Kars"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "37",
                "name" => "Kastamonu"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "38",
                "name" => "Kayseri"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "39",
                "name" => "Kirklareli"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "40",
                "name" => "Kirsehir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "41",
                "name" => "Kocaeli"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "42",
                "name" => "Konya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "43",
                "name" => "Kütahya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "44",
                "name" => "Malatya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "45",
                "name" => "Manisa"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "46",
                "name" => "Kahramanmaras"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "47",
                "name" => "Mardin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "48",
                "name" => "Mugla"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "49",
                "name" => "Mus"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "50",
                "name" => "Nevsehir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "51",
                "name" => "Nigde"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "52",
                "name" => "Ordu"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "53",
                "name" => "Rize"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "54",
                "name" => "Sakarya"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "55",
                "name" => "Samsun"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "56",
                "name" => "Siirt"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "57",
                "name" => "Sinop"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "58",
                "name" => "Sivas"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "59",
                "name" => "Tekirdag"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "60",
                "name" => "Tokat"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "61",
                "name" => "Trabzon"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "62",
                "name" => "Tunceli"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "63",
                "name" => "Sanliurfa"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "64",
                "name" => "Usak"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "65",
                "name" => "Van"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "66",
                "name" => "Yozgat"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "67",
                "name" => "Zonguldak"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "68",
                "name" => "Aksaray"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "69",
                "name" => "Bayburt"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "70",
                "name" => "Karaman"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "71",
                "name" => "Kirikkale"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "72",
                "name" => "Batman"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "73",
                "name" => "Sirnak"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "74",
                "name" => "Bartin"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "75",
                "name" => "Ardahan"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "76",
                "name" => "Igdir"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "77",
                "name" => "Yalova"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "78",
                "name" => "Karabük"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "79",
                "name" => "Kilis"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "80",
                "name" => "Osmaniye"
            ],
            [
                "country_id" => 0,
                "country_code" => "TR",
                "code" => "81",
                "name" => "Düzce"
            ],
            [
                "country_id" => 0,
                "country_code" => "TM",
                "code" => "A",
                "name" => "Ahal [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TM",
                "code" => "B",
                "name" => "Balkan [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TM",
                "code" => "D",
                "name" => "Dasoguz [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TM",
                "code" => "L",
                "name" => "Lebap [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TM",
                "code" => "M",
                "name" => "Mary [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TM",
                "code" => "S",
                "name" => "A?gabat [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "FUN",
                "name" => "Funafuti [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "NIT",
                "name" => "Niutao [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "NIU",
                "name" => "Nui [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "NKF",
                "name" => "Nukufetau [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "NKL",
                "name" => "Nukulaelae [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "NMA",
                "name" => "Nanumea [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "NMG",
                "name" => "Nanumanga [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "TV",
                "code" => "VAI",
                "name" => "Vaitupu [Island Council]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "101",
                "name" => "Kalangala [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "102",
                "name" => "Kampala [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "103",
                "name" => "Kiboga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "104",
                "name" => "Luwero [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "105",
                "name" => "Masaka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "106",
                "name" => "Mpigi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "107",
                "name" => "Mubende [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "108",
                "name" => "Mukono [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "109",
                "name" => "Nakasongola [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "110",
                "name" => "Rakai [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "111",
                "name" => "Sembabule [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "112",
                "name" => "Kayunga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "113",
                "name" => "Wakiso [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "114",
                "name" => "Mityana [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "115",
                "name" => "Nakaseke [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "116",
                "name" => "Lyantonde [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "201",
                "name" => "Bugiri [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "202",
                "name" => "Busia [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "203",
                "name" => "Iganga [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "204",
                "name" => "Jinja [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "205",
                "name" => "Kamuli [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "206",
                "name" => "Kapchorwa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "207",
                "name" => "Katakwi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "208",
                "name" => "Kumi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "209",
                "name" => "Mbale [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "210",
                "name" => "Pallisa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "211",
                "name" => "Soroti [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "212",
                "name" => "Tororo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "213",
                "name" => "Kaberamaido [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "214",
                "name" => "Mayuge [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "215",
                "name" => "Sironko [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "216",
                "name" => "Amuria [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "217",
                "name" => "Budaka [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "218",
                "name" => "Bukwa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "219",
                "name" => "Butaleja [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "220",
                "name" => "Kaliro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "221",
                "name" => "Manafwa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "222",
                "name" => "Namutumba [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "223",
                "name" => "Bududa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "224",
                "name" => "Bukedea [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "301",
                "name" => "Adjumani [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "302",
                "name" => "Apac [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "303",
                "name" => "Arua [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "304",
                "name" => "Gulu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "305",
                "name" => "Kitgum [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "306",
                "name" => "Kotido [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "307",
                "name" => "Lira [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "308",
                "name" => "Moroto [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "309",
                "name" => "Moyo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "310",
                "name" => "Nebbi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "311",
                "name" => "Nakapiripirit [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "312",
                "name" => "Pader [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "313",
                "name" => "Yumbe [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "314",
                "name" => "Amolatar [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "315",
                "name" => "Kaabong [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "316",
                "name" => "Koboko [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "317",
                "name" => "Abim [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "318",
                "name" => "Dokolo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "319",
                "name" => "Amuru [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "320",
                "name" => "Maracha [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "321",
                "name" => "Oyam [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "401",
                "name" => "Bundibugyo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "402",
                "name" => "Bushenyi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "403",
                "name" => "Hoima [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "404",
                "name" => "Kabale [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "405",
                "name" => "Kabarole [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "406",
                "name" => "Kasese [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "407",
                "name" => "Kibaale [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "408",
                "name" => "Kisoro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "409",
                "name" => "Masindi [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "410",
                "name" => "Mbarara [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "411",
                "name" => "Ntungamo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "412",
                "name" => "Rukungiri [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "413",
                "name" => "Kamwenge [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "414",
                "name" => "Kanungu [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "415",
                "name" => "Kyenjojo [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "416",
                "name" => "Ibanda [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "417",
                "name" => "Isingiro [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "418",
                "name" => "Kiruhura [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "419",
                "name" => "Buliisa [District]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "C",
                "name" => "Central [Geographic regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "E",
                "name" => "Eastern [Geographic regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "N",
                "name" => "Northern [Geographic regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UG",
                "code" => "W",
                "name" => "Western [Geographic regions]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "05",
                "name" => "Vinnyts'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "07",
                "name" => "Volyns'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "09",
                "name" => "Luhans'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "12",
                "name" => "Dnipropetrovs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "14",
                "name" => "Donets'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "18",
                "name" => "Zhytomyrs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "21",
                "name" => "Zakarpats'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "23",
                "name" => "Zaporiz'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "26",
                "name" => "Ivano-Frankivs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "30",
                "name" => "Kyïv [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "32",
                "name" => "Kyïvs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "35",
                "name" => "Kirovohrads'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "40",
                "name" => "Sevastopol' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "43",
                "name" => "Respublika Krym [Autonomous Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "46",
                "name" => "L'vivs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "48",
                "name" => "Mykolaïvs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "51",
                "name" => "Odes'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "53",
                "name" => "Poltavs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "56",
                "name" => "Rivnens'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "59",
                "name" => "Sums'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "61",
                "name" => "Ternopil's'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "63",
                "name" => "Kharkivs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "65",
                "name" => "Khersons'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "68",
                "name" => "Khmel'nyts'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "71",
                "name" => "Cherkas'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "74",
                "name" => "Chernihivs'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UA",
                "code" => "77",
                "name" => "Chernivets'ka Oblast' [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "AJ",
                "name" => "Ajman [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "AZ",
                "name" => "Abu Z¸aby [Abu Dhabi] [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "DU",
                "name" => "Dubayy [Dubai] [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "FU",
                "name" => "Al Fujayrah [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "RK",
                "name" => "Ra’s al Khaymah [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "SH",
                "name" => "Ash Shariqah [Sharjah] [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "AE",
                "code" => "UQ",
                "name" => "Umm al Qaywayn [Emirate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ABD",
                "name" => "Aberdeenshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ABE",
                "name" => "Aberdeen City [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "AGB",
                "name" => "Argyll and Bute [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "AGY",
                "name" => "Isle of Anglesey [Sir Ynys Môn GB-YNM] [Unitary au"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ANS",
                "name" => "Angus [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ANT",
                "name" => "Antrim [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ARD",
                "name" => "Ards [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ARM",
                "name" => "Armagh [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BAS",
                "name" => "Bath and North East Somerset [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BBD",
                "name" => "Blackburn with Darwen [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BDF",
                "name" => "Bedfordshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BDG",
                "name" => "Barking and Dagenham [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BEN",
                "name" => "Brent [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BEX",
                "name" => "Bexley [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BFS",
                "name" => "Belfast [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BGE",
                "name" => "Bridgend [Pen-y-bont ar Ogwr GB-POG] [Unitary auth"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BGW",
                "name" => "Blaenau Gwent [Unitary authority (Wales)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BIR",
                "name" => "Birmingham [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BKM",
                "name" => "Buckinghamshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BLA",
                "name" => "Ballymena [District council area (Northern Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BLY",
                "name" => "Ballymoney [District council area (Northern Irelan"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BMH",
                "name" => "Bournemouth [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BNB",
                "name" => "Banbridge [District council area (Northern Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BNE",
                "name" => "Barnet [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BNH",
                "name" => "Brighton and Hove [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BNS",
                "name" => "Barnsley [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BOL",
                "name" => "Bolton [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BPL",
                "name" => "Blackpool [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BRC",
                "name" => "Bracknell Forest [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BRD",
                "name" => "Bradford [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BRY",
                "name" => "Bromley [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BST",
                "name" => "Bristol, City of [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "BUR",
                "name" => "Bury [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CAM",
                "name" => "Cambridgeshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CAY",
                "name" => "Caerphilly [Caerffili GB-CAF] [Unitary authority ("
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CGN",
                "name" => "Ceredigion [Sir Ceredigion] [Unitary authority (Wa"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CGV",
                "name" => "Craigavon [District council area (Northern Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CHS",
                "name" => "Cheshire"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CKF",
                "name" => "Carrickfergus [District council area (Northern Ire"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CKT",
                "name" => "Cookstown [District council area (Northern Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CLD",
                "name" => "Calderdale [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CLK",
                "name" => "Clackmannanshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CLR",
                "name" => "Coleraine [District council area (Northern Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CMA",
                "name" => "Cumbria [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CMD",
                "name" => "Camden [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CMN",
                "name" => "Carmarthenshire [Sir Gaerfyrddin GB-GFY] [Unitary "
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CON",
                "name" => "Cornwall [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "COV",
                "name" => "Coventry [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CRF",
                "name" => "Cardiff [Caerdydd GB-CRD] [Unitary authority (Wale"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CRY",
                "name" => "Croydon [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CSR",
                "name" => "Castlereagh [District council area (Northern Irela"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "CWY",
                "name" => "Conwy [Unitary authority (Wales)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DAL",
                "name" => "Darlington [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DBY",
                "name" => "Derbyshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DEN",
                "name" => "Denbighshire [Sir Ddinbych GB-DDB] [Unitary author"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DER",
                "name" => "Derby [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DEV",
                "name" => "Devon [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DGN",
                "name" => "Dungannon and South Tyrone [District council area "
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DGY",
                "name" => "Dumfries and Galloway [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DNC",
                "name" => "Doncaster [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DND",
                "name" => "Dundee City [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DOR",
                "name" => "Dorset [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DOW",
                "name" => "Down [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DRY",
                "name" => "Derry [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DUD",
                "name" => "Dudley [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "DUR",
                "name" => "Durham [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "EAL",
                "name" => "Ealing [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "EAY",
                "name" => "East Ayrshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "EDH",
                "name" => "Edinburgh, City of [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "EDU",
                "name" => "East Dunbartonshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ELN",
                "name" => "East Lothian [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ELS",
                "name" => "Eilean Siar [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ENF",
                "name" => "Enfield [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ERW",
                "name" => "East Renfrewshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ERY",
                "name" => "East Riding of Yorkshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ESS",
                "name" => "Essex [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ESX",
                "name" => "East Sussex [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "FAL",
                "name" => "Falkirk [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "FER",
                "name" => "Fermanagh [District council area (Northern Ireland"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "FIF",
                "name" => "Fife [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "FLN",
                "name" => "Flintshire [Sir y Fflint GB-FFL] [Unitary authorit"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "GAT",
                "name" => "Gateshead [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "GLG",
                "name" => "Glasgow City [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "GLS",
                "name" => "Gloucestershire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "GRE",
                "name" => "Greenwich [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "GWN",
                "name" => "Gwynedd [Unitary authority (Wales)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HAL",
                "name" => "Halton [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HAM",
                "name" => "Hampshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HAV",
                "name" => "Havering [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HCK",
                "name" => "Hackney [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HEF",
                "name" => "Herefordshire, County of [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HIL",
                "name" => "Hillingdon [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HLD",
                "name" => "Highland [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HMF",
                "name" => "Hammersmith and Fulham [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HNS",
                "name" => "Hounslow [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HPL",
                "name" => "Hartlepool [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HRT",
                "name" => "Hertfordshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HRW",
                "name" => "Harrow [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "HRY",
                "name" => "Haringey [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "IOS",
                "name" => "Isles of Scilly"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "IOW",
                "name" => "Isle of Wight [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ISL",
                "name" => "Islington [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "IVC",
                "name" => "Inverclyde [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "KEC",
                "name" => "Kensington and Chelsea [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "KEN",
                "name" => "Kent [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "KHL",
                "name" => "Kingston upon Hull, City of [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "KIR",
                "name" => "Kirklees [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "KTT",
                "name" => "Kingston upon Thames [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "KWL",
                "name" => "Knowsley [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LAN",
                "name" => "Lancashire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LBH",
                "name" => "Lambeth [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LCE",
                "name" => "Leicester [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LDS",
                "name" => "Leeds [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LEC",
                "name" => "Leicestershire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LEW",
                "name" => "Lewisham [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LIN",
                "name" => "Lincolnshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LIV",
                "name" => "Liverpool [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LMV",
                "name" => "Limavady [District council area (Northern Ireland)"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LND",
                "name" => "London, City of [City corporation]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LRN",
                "name" => "Larne [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LSB",
                "name" => "Lisburn [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "LUT",
                "name" => "Luton [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MAN",
                "name" => "Manchester [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MDB",
                "name" => "Middlesbrough [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MDW",
                "name" => "Medway [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MFT",
                "name" => "Magherafelt [District council area (Northern Irela"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MIK",
                "name" => "Milton Keynes [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MLN",
                "name" => "Midlothian [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MON",
                "name" => "Monmouthshire [Sir Fynwy GB-FYN] [Unitary authorit"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MRT",
                "name" => "Merton [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MRY",
                "name" => "Moray [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MTY",
                "name" => "Merthyr Tydfil [Merthyr Tudful GB-MTU] [Unitary au"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "MYL",
                "name" => "Moyle [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NAY",
                "name" => "North Ayrshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NBL",
                "name" => "Northumberland [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NDN",
                "name" => "North Down [District council area (Northern Irelan"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NEL",
                "name" => "North East Lincolnshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NET",
                "name" => "Newcastle upon Tyne [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NFK",
                "name" => "Norfolk [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NGM",
                "name" => "Nottingham [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NLK",
                "name" => "North Lanarkshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NLN",
                "name" => "North Lincolnshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NSM",
                "name" => "North Somerset [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NTA",
                "name" => "Newtownabbey [District council area (Northern Irel"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NTH",
                "name" => "Northamptonshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NTL",
                "name" => "Neath Port Talbot [Castell-nedd Port Talbot GB-CTL"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NTT",
                "name" => "Nottinghamshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NTY",
                "name" => "North Tyneside [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NWM",
                "name" => "Newham [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NWP",
                "name" => "Newport [Casnewydd GB-CNW] [Unitary authority (Wal"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NYK",
                "name" => "North Yorkshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "NYM",
                "name" => "Newry and Mourne [District council area (Northern "
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "OLD",
                "name" => "Oldham [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "OMH",
                "name" => "Omagh [District council area (Northern Ireland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ORK",
                "name" => "Orkney Islands [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "OXF",
                "name" => "Oxfordshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "PEM",
                "name" => "Pembrokeshire [Sir Benfro GB-BNF] [Unitary authori"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "PKN",
                "name" => "Perth and Kinross [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "PLY",
                "name" => "Plymouth [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "POL",
                "name" => "Poole [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "POR",
                "name" => "Portsmouth [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "POW",
                "name" => "Powys [Unitary authority (Wales)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "PTE",
                "name" => "Peterborough [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RCC",
                "name" => "Redcar and Cleveland [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RCH",
                "name" => "Rochdale [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RCT",
                "name" => "Rhondda, Cynon, Taff [Rhondda, Cynon,Taf] [Unitary"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RDB",
                "name" => "Redbridge [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RDG",
                "name" => "Reading [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RFW",
                "name" => "Renfrewshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RIC",
                "name" => "Richmond upon Thames [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ROT",
                "name" => "Rotherham [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "RUT",
                "name" => "Rutland [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SAW",
                "name" => "Sandwell [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SAY",
                "name" => "South Ayrshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SCB",
                "name" => "Scottish Borders, The [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SFK",
                "name" => "Suffolk [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SFT",
                "name" => "Sefton [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SGC",
                "name" => "South Gloucestershire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SHF",
                "name" => "Sheffield [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SHN",
                "name" => "St. Helens [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SHR",
                "name" => "Shropshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SKP",
                "name" => "Stockport [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SLF",
                "name" => "Salford [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SLG",
                "name" => "Slough [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SLK",
                "name" => "South Lanarkshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SND",
                "name" => "Sunderland [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SOL",
                "name" => "Solihull [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SOM",
                "name" => "Somerset [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SOS",
                "name" => "Southend-on-Sea [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SRY",
                "name" => "Surrey [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STB",
                "name" => "Strabane [District council area (Northern Ireland)"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STE",
                "name" => "Stoke-on-Trent [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STG",
                "name" => "Stirling [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STH",
                "name" => "Southampton [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STN",
                "name" => "Sutton [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STS",
                "name" => "Staffordshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STT",
                "name" => "Stockton-on-Tees [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "STY",
                "name" => "South Tyneside [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SWA",
                "name" => "Swansea [Abertawe GB-ATA] [Unitary authority (Wale"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SWD",
                "name" => "Swindon [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "SWK",
                "name" => "Southwark [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "TAM",
                "name" => "Tameside [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "TFW",
                "name" => "Telford and Wrekin [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "THR",
                "name" => "Thurrock [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "TOB",
                "name" => "Torbay [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "TOF",
                "name" => "Torfaen [Tor-faen] [Unitary authority (Wales)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "TRF",
                "name" => "Trafford [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "TWH",
                "name" => "Tower Hamlets [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "VGL",
                "name" => "Vale of Glamorgan, The [Bro Morgannwg GB-BMG] [Uni"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WAR",
                "name" => "Warwickshire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WBK",
                "name" => "West Berkshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WDU",
                "name" => "West Dunbartonshire [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WFT",
                "name" => "Waltham Forest [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WGN",
                "name" => "Wigan [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WIL",
                "name" => "Wiltshire [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WKF",
                "name" => "Wakefield [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WLL",
                "name" => "Walsall [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WLN",
                "name" => "West Lothian [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WLV",
                "name" => "Wolverhampton [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WND",
                "name" => "Wandsworth [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WNM",
                "name" => "Windsor and Maidenhead [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WOK",
                "name" => "Wokingham [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WOR",
                "name" => "Worcestershire [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WRL",
                "name" => "Wirral [Metropolitan district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WRT",
                "name" => "Warrington [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WRX",
                "name" => "Wrexham [Wrecsam GB-WRC] [Unitary authority (Wales"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WSM",
                "name" => "Westminster [Borough]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "WSX",
                "name" => "West Sussex [Two-tier county]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "YOR",
                "name" => "York [Unitary authority]"
            ],
            [
                "country_id" => 0,
                "country_code" => "GB",
                "code" => "ZET",
                "name" => "Shetland Islands [Council area (Scotland)]"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "AS",
                "name" => "American Samoa [Outlying area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "GU",
                "name" => "Guam [Outlying area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "MP",
                "name" => "Northern Mariana Islands [Outlying area]"
            ],
            [
                "country_id" => 0,
                "country_code" => "US",
                "code" => "UM",
                "name" => "United States Minor Outlying Islands [Outlying are"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "AR",
                "name" => "Artigas [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "DU",
                "name" => "Durazno [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "FD",
                "name" => "Florida [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "FS",
                "name" => "Flores [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "LA",
                "name" => "Lavalleja [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "MA",
                "name" => "Maldonado [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "MO",
                "name" => "Montevideo [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "PA",
                "name" => "Paysandú [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "RN",
                "name" => "Río Negro [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "RO",
                "name" => "Rocha [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "RV",
                "name" => "Rivera [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "SA",
                "name" => "Salto [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "SJ",
                "name" => "San José [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "SO",
                "name" => "Soriano [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "TA",
                "name" => "Tacuarembó [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UY",
                "code" => "TT",
                "name" => "Treinta y Tres [Department]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "AN",
                "name" => "Andijon [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "BU",
                "name" => "Buxoro [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "FA",
                "name" => "Farg‘ona [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "JI",
                "name" => "Jizzax [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "NG",
                "name" => "Namangan [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "NW",
                "name" => "Navoiy [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "QA",
                "name" => "Qashqadaryo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "QR",
                "name" => "Qoraqalpog‘iston Respublikasi [Republic]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "SA",
                "name" => "Samarqand [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "SI",
                "name" => "Sirdaryo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "SU",
                "name" => "Surxondaryo [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "TK",
                "name" => "Toshkent City [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "TO",
                "name" => "Toshkent [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "UZ",
                "code" => "XO",
                "name" => "Xorazm [Region]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VU",
                "code" => "MAP",
                "name" => "Malampa"
            ],
            [
                "country_id" => 0,
                "country_code" => "VU",
                "code" => "PAM",
                "name" => "Pénama"
            ],
            [
                "country_id" => 0,
                "country_code" => "VU",
                "code" => "SAM",
                "name" => "Sanma"
            ],
            [
                "country_id" => 0,
                "country_code" => "VU",
                "code" => "SEE",
                "name" => "Shéfa"
            ],
            [
                "country_id" => 0,
                "country_code" => "VU",
                "code" => "TAE",
                "name" => "Taféa"
            ],
            [
                "country_id" => 0,
                "country_code" => "VU",
                "code" => "TOB",
                "name" => "Torba"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "A",
                "name" => "Distrito Federal [Federal district]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "B",
                "name" => "Anzoátegui"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "C",
                "name" => "Apure"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "D",
                "name" => "Aragua"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "E",
                "name" => "Barinas"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "F",
                "name" => "Bolívar"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "G",
                "name" => "Carabobo"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "H",
                "name" => "Cojedes"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "I",
                "name" => "Falcón"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "J",
                "name" => "Guárico"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "K",
                "name" => "Lara"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "L",
                "name" => "Mérida"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "M",
                "name" => "Miranda"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "N",
                "name" => "Monagas"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "O",
                "name" => "Nueva Esparta"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "P",
                "name" => "Portuguesa"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "R",
                "name" => "Sucre"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "S",
                "name" => "Táchira"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "T",
                "name" => "Trujillo"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "U",
                "name" => "Yaracuy"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "V",
                "name" => "Zulia"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "W",
                "name" => "Dependencias Federales [Federal dependency]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "X",
                "name" => "Vargas"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "Y",
                "name" => "Delta Amacuro"
            ],
            [
                "country_id" => 0,
                "country_code" => "VE",
                "code" => "Z",
                "name" => "Amazonas"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "01",
                "name" => "Lai Chau"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "02",
                "name" => "Lao Cai"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "03",
                "name" => "Ha Giang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "04",
                "name" => "Cao Bang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "05",
                "name" => "Son La"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "06",
                "name" => "Yen Bai"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "07",
                "name" => "Tuyen Quang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "09",
                "name" => "Lang Son"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "13",
                "name" => "Quang Ninh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "14",
                "name" => "Hoa Binh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "15",
                "name" => "Ha Tay"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "18",
                "name" => "Ninh Binh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "20",
                "name" => "Thai Binh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "21",
                "name" => "Thanh Hoa"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "22",
                "name" => "Nghe An"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "23",
                "name" => "Ha Tinh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "24",
                "name" => "Quang Binh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "25",
                "name" => "Quang Tri"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "26",
                "name" => "Thua Thien-Hue"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "27",
                "name" => "Quang Nam"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "28",
                "name" => "Kon Tum"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "29",
                "name" => "Quang Ngai"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "30",
                "name" => "Gia Lai"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "31",
                "name" => "Binh Dinh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "32",
                "name" => "Phu Yen"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "33",
                "name" => "Dac Lac"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "34",
                "name" => "Khanh Hoa"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "35",
                "name" => "Lam Dong"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "36",
                "name" => "Ninh Thuan"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "37",
                "name" => "Tay Ninh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "39",
                "name" => "Dong Nai"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "40",
                "name" => "Binh Thuan"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "41",
                "name" => "Long An"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "43",
                "name" => "Ba Ria-Vung Tau"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "44",
                "name" => "An Giang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "45",
                "name" => "Dong Thap"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "46",
                "name" => "Tien Giang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "47",
                "name" => "Kien Giang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "48",
                "name" => "Can Tho"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "49",
                "name" => "Vinh Long"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "50",
                "name" => "Ben Tre"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "51",
                "name" => "Tra Vinh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "52",
                "name" => "Soc Trang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "53",
                "name" => "Bac Can"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "54",
                "name" => "Bac Giang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "55",
                "name" => "Bac Lieu"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "56",
                "name" => "Bac Ninh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "57",
                "name" => "Binh Duong"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "58",
                "name" => "Binh Phuoc"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "59",
                "name" => "Ca Mau"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "60",
                "name" => "Da Nang, thanh pho"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "61",
                "name" => "Hai Duong"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "62",
                "name" => "Hai Phong, thanh pho"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "63",
                "name" => "Ha Nam"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "64",
                "name" => "Ha Noi, thu do"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "65",
                "name" => "Ho Chi Minh, thanh pho [Sai Gon]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "66",
                "name" => "Hung Yen"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "67",
                "name" => "Nam Dinh"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "68",
                "name" => "Phu Tho"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "69",
                "name" => "Thai Nguyen"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "70",
                "name" => "Vinh Phuc"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "71",
                "name" => "Dien Bien"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "72",
                "name" => "Dak Nong"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "73",
                "name" => "Hau Giang"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "CT",
                "name" => "Can Tho [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "DN",
                "name" => "Da Nang [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "HN",
                "name" => "Ha Noi [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "HP",
                "name" => "Hai Phong [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "VN",
                "code" => "SG",
                "name" => "Ho Chi Minh [Sai Gon] [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "EH",
                "code" => "BOD",
                "name" => "Boujdour"
            ],
            [
                "country_id" => 0,
                "country_code" => "EH",
                "code" => "ESM",
                "name" => "Es Semara"
            ],
            [
                "country_id" => 0,
                "country_code" => "EH",
                "code" => "LAA",
                "name" => "Laayoune"
            ],
            [
                "country_id" => 0,
                "country_code" => "EH",
                "code" => "OUD",
                "name" => "Oued el Dahab"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "AB",
                "name" => "Abyan [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "AD",
                "name" => "?Adan [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "AM",
                "name" => "Amran [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "BA",
                "name" => "Al Bay?a' [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "DA",
                "name" => "Ad D?li‘ [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "DH",
                "name" => "Dhamar [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "HD",
                "name" => "Hadramawt [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "HJ",
                "name" => "Hajjah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "HU",
                "name" => "Al ?udaydah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "IB",
                "name" => "Ibb [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "JA",
                "name" => "Al Jawf [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "LA",
                "name" => "La?ij [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "MA",
                "name" => "Ma'rib [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "MR",
                "name" => "Al Mahrah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "MW",
                "name" => "Al Mahwit [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "RA",
                "name" => "Raymah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "SA",
                "name" => "?an‘? [Municipality]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "SD",
                "name" => "Sa`dah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "SH",
                "name" => "Shabwah [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "SN",
                "name" => "San?? [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "YE",
                "code" => "TA",
                "name" => "Ta?izz [Governorate]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "01",
                "name" => "Western"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "02",
                "name" => "Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "03",
                "name" => "Eastern"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "04",
                "name" => "Luapula"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "05",
                "name" => "Northern"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "06",
                "name" => "North-Western"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "07",
                "name" => "Southern"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "08",
                "name" => "Copperbelt"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZM",
                "code" => "09",
                "name" => "Lusaka"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "BU",
                "name" => "Bulawayo [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "HA",
                "name" => "Harare [City]"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MA",
                "name" => "Manicaland"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MC",
                "name" => "Mashonaland Central"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "ME",
                "name" => "Mashonaland East"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MI",
                "name" => "Midlands"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MN",
                "name" => "Matabeleland North"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MS",
                "name" => "Matabeleland South"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MV",
                "name" => "Masvingo"
            ],
            [
                "country_id" => 0,
                "country_code" => "ZW",
                "code" => "MW",
                "name" => "Mashonaland West"
            ]
        ]);

        $countries = App\Model\Country::all();

        foreach ($countries as $country) {
            DB::table('state')->where('country_code', $country->country_code)->update([
                'country_id' => $country->id
            ]);
        }

    }
}
