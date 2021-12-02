<?php

use Illuminate\Database\Seeder;

class HazardousSubstanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('hazardous_substance')->delete();
        
        \DB::table('hazardous_substance')->insert(array (
        	[
        		'cas_num' => '-',
        		'name' => 'Inflammable Gas',
        		'description' => '인화성 가스',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '-',
        		'name' => 'Inflammable Liquid',
        		'description' => '인화성 액체',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '624-83-9',
        		'name' => 'Methyl Isocyanate',
        		'description' => '메틸 이소시아네이트',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '75-44-5',
        		'name' => 'Phosgene',
        		'description' => '포스겐',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '107-13-1',
        		'name' => 'Acrylonitrile',
        		'description' => '아크릴로니트릴',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7664-41-7',
        		'name' => 'Ammonia',
        		'description' => '암모니아',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7782-50-5',
        		'name' => 'Chlorine',
        		'description' => '염소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7446-09-5',
        		'name' => 'Sulfur Dioxide',
        		'description' => '이산화황',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7446-11-9',
        		'name' => 'Sulfur Trioxide',
        		'description' => '삼산화황',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '75-15-0',
        		'name' => 'Carbon Disulfide',
        		'description' => '이황화탄소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '74-90-8',
        		'name' => 'Hydrogen Cyanide',
        		'description' => '시안화수소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7664-39-3',
        		'name' => 'Hydrofluoric Acid',
        		'description' => '불화수소(무수불산)',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7647-01-0',
        		'name' => 'Hydrochloric Acid',
        		'description' => '염화수소(무수염산)',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7783-06-4',
        		'name' => 'Hydrogen Sulfide',
        		'description' => '황화수소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '6484-52-2',
        		'name' => 'Ammonium Nitrate (AN)',
        		'description' => '질산암모늄',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '55-63-0',
        		'name' => 'Nitroglycerin',
        		'description' => '니트로글리세린',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '118-96-7',
        		'name' => '2,4,6-Trinitrotoluene (TNT)',
        		'description' => '트리니트로톨루엔',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '1333-74-0',
        		'name' => 'Hydrogen',
        		'description' => '수소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '75-21-8',
        		'name' => 'Ethylene Oxide; Oxirane',
        		'description' => '산화에틸렌',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7803-51-2',
        		'name' => 'Phosphine',
        		'description' => '포스핀',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7803-62-5',
        		'name' => 'Silane',
        		'description' => '실란(Silane)',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7697-37-2',
        		'name' => 'Nitric Acid',
        		'description' => '질산(중량 94.5% 이상)',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '8014-95-7',
        		'name' => 'Sulfuric Acid',
        		'description' => '발연황산(삼산화황 중량 65% 이상 80% 미만)',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7722-84-1',
        		'name' => 'Hydrogen Peroxide',
        		'description' => '과산화수소(중량 52% 이상)',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '26471-62-5',
        		'name' => 'M-Tolylidene Diisocyanate; Toluene-Diisocyanate',
        		'description' => '톨루엔디이소시아네이트',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7790-94-5',
        		'name' => 'Chlorosulfonic Acid',
        		'description' => '클로로술폰산',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '10035-10-6',
        		'name' => 'Hydrogen Bromide',
        		'description' => '브롬화수소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7719-12-2',
        		'name' => 'Phosphorus(III) Chloride',
        		'description' => '삼염화인',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '100-44-7',
        		'name' => 'Benzyl Chloride',
        		'description' => '염화 벤질',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '10049-04-4',
        		'name' => 'Chlorine Dioxide',
        		'description' => '이산화염소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7719-09-7',
        		'name' => 'Thionyl Chloride',
        		'description' => '염화 티오닐',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7726-95-6',
        		'name' => '브롬',
        		'description' => '브롬',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '10102-43-9',
        		'name' => '일산화질소',
        		'description' => '일산화질소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '10294-34-5',
        		'name' => '#N/A',
        		'description' => '붕소 트리염화물',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '1338-23-4',
        		'name' => '메틸에틸케톤과산화물',
        		'description' => '메틸에틸케톤과산화물',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '7637-07-2',
        		'name' => '삼불화 붕소',
        		'description' => '삼불화 붕소',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '88-74-4',
        		'name' => 'O-Nitroaniline',
        		'description' => '니트로아닐린',
        		'created_at' => \Carbon::now()
        	],
            [
        		'cas_num' => '99-09-2',
        		'name' => 'M-Nitroaniline',
        		'description' => '니트로아닐린',
        		'created_at' => \Carbon::now()
        	],
            [
                "cas_num" => "100-01-6", 
                "name" => "4-Nitroaniline", 
                "description" => "니트로아닐린", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7790-91-2", 
                "name" => "Trifluorochlorine", 
                "description" => "염소 트리플루오르화", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7782-41-4", 
                "name" => "Fluorine", 
                "description" => "불소", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "675-14-9", 
                "name" => "Cyanuric Fluoride", 
                "description" => "시아누르 플루오르화물", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7783-54-2", 
                "name" => "Nitrogen Trifluoride", 
                "description" => "질소 트리플루오르화물", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "9004-70-0", 
                "name" => "Nitrocellulose", 
                "description" => "니트로 셀롤로오스(질소 함유량 12.6% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "94-36-0", 
                "name" => "Benzoyl Peroxide", 
                "description" => "과산화벤조일", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7790-98-9", 
                "name" => "Ammonium Perchlorate", 
                "description" => "과염소산 암모늄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "4109-96-0", 
                "name" => "Dichlorosilane", 
                "description" => "디클로로실란", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "96-10-6", 
                "name" => "Diethylaluminum Chloride", 
                "description" => "디에틸 알루미늄 염화물", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "105-64-6", 
                "name" => "Diisopropyl Peroxydicarbonate", 
                "description" => "디이소프로필 퍼옥시디카보네이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7664-39-3", 
                "name" => "Hydrofluoric Acid", 
                "description" => "불산(중량 1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7647-01-0", 
                "name" => "Hydrochloric Acid", 
                "description" => "염산(중량 10% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7664-93-9", 
                "name" => "Sulfuric Acid ", 
                "description" => "황산(중량 10% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7664-41-7", 
                "name" => "Ammonia", 
                "description" => "암모니아수(중량 10% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "87-86-5", 
                "name" => "Pentachlorophenol", 
                "description" => "펜타클로로페놀", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7440-47-3", 
                "name" => "Chromium, Metallic", 
                "description" => "크롬광 및 함유제제(열소성처리 경우만)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-52-5", 
                "name" => "Nitromethane", 
                "description" => "니트로메탄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "98-95-3", 
                "name" => "Nitrobenzene", 
                "description" => "니트로벤젠", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "100-00-5", 
                "name" => "1-Chloro-4-Nitrobenzene", 
                "description" => "p-니트로클로로벤젠", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "25321-14-6", 
                "name" => "Dinitrotoluene", 
                "description" => "디니트로톨루엔 ( 다이나이트로벤젠 확인 )", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "121-69-7", 
                "name" => "N,N-Dimethylaniline", 
                "description" => "디메틸아닐린(아미노디메틸벤젠)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "127-19-5", 
                "name" => "N,N-Dimethylacetamide", 
                "description" => "N,N-디메틸아세트아미드", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "68-12-2", 
                "name" => "Dimethylformamide", 
                "description" => "디메틸포름아미드", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "111-42-2", 
                "name" => "Diethanolamine", 
                "description" => "디에탄올아민", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "123-91-1", 
                "name" => "1,4-Dioxane", 
                "description" => "1,4-디옥산", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-09-2", 
                "name" => "Dichloromethane; Methylene Chloride", 
                "description" => "디클로로메탄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "123-31-9", 
                "name" => "1,4-Dihydroxybenzene; Hydroquinone; Quinol", 
                "description" => "디하이드록시벤젠", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "109-86-4", 
                "name" => "2-Methoxyethanol; Ethylene Glycol Monomethyl Ether", 
                "description" => "2-메톡시에탄올", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "101-68-8", 
                "name" => "4,4'-Methylenediphenyl Diisocyanate; Diphenylmethane-4,4'-Diisocyanate", 
                "description" => "메틸렌비스페닐디이소시아네이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "108-10-1", 
                "name" => "Methyl Isobutyl Ketone (Mibk)", 
                "description" => "메틸이소부틸케톤", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "74-87-3", 
                "name" => "Chloromethane; Methyl Chloride", 
                "description" => "메틸클로라이드(염화메틸)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "591-78-6", 
                "name" => "2-Hexanone", 
                "description" => "메틸n-부틸케톤", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "71-43-2", 
                "name" => "Benzene", 
                "description" => "벤젠(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "106-99-0", 
                "name" => "1,3-Butadiene; Buta-1,3-Diene", 
                "description" => "1,3-부타디엔(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "106-94-5", 
                "name" => "1-Bromopropane", 
                "description" => "1-브로모프로판(중량비율 0.3% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-26-3", 
                "name" => "2-Bromopropane", 
                "description" => "2-브로모프로판(중량비율 0.3% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "74-83-9", 
                "name" => "Bromomethane; Methyl Bromide", 
                "description" => "브롬화메틸", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "108-05-4", 
                "name" => "Vinyl Acetate", 
                "description" => "비닐 아세테이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "56-23-5", 
                "name" => "Carbon Tetrachloride; Tetrachloromethane", 
                "description" => "사염화탄소(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "100-42-5", 
                "name" => "Styrene", 
                "description" => "스티렌", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "108-94-1", 
                "name" => "Cyclohexanone", 
                "description" => "시클로헥사논", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "62-53-3", 
                "name" => "Aniline", 
                "description" => "아닐린(아미노벤젠)과 그 동족체", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-07-0", 
                "name" => "Acetaldehyde; Ethanal", 
                "description" => "아세트알데히드", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "107-13-1", 
                "name" => "Acrylonitrile", 
                "description" => "아크릴로니트릴", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "79-06-1", 
                "name" => "Acrylamide; Prop-2-Enamide", 
                "description" => "아크릴아미드", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "106-92-3", 
                "name" => "Allyl Glycidyl Ether", 
                "description" => "알릴글리시딜에테르", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "100-41-4", 
                "name" => "Ethylbenzene", 
                "description" => "에틸벤젠", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "140-88-5", 
                "name" => "Ethyl Acrylate", 
                "description" => "에틸아크릴레이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "110-49-6", 
                "name" => "2-Methoxyethyl Acetate; Methylglycol Acetate", 
                "description" => "2-메톡시에틸아세테이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "110-80-5", 
                "name" => "2-Ethoxyethanol; Ethylene Glycol Monoethyl Ether", 
                "description" => "2-에톡시에탄올", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "111-15-9", 
                "name" => "2-Ethoxyethyl Acetate; Ethylglycol Acetate", 
                "description" => "2-에톡시에틸아세테이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "111-76-2", 
                "name" => "Ethylene Glycol Monobutyl Ether (Egbe) (2-Butoxyethanol)", 
                "description" => "2-부톡시에탄올", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "112-07-2", 
                "name" => "2-Butoxyethyl Acetate(Egbea)", 
                "description" => "에틸렌글리콜모노부틸아세테이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "151-56-4", 
                "name" => "Ethyleneimine; Aziridine", 
                "description" => "에틸렌이민", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "556-52-5", 
                "name" => "2,3-Epoxypropan-1-Ol; Glycidol; Oxiranemethanol", 
                "description" => "2,3-에폭시-1-프로판올", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-56-9", 
                "name" => "Propylene Oxide; 1,2-Epoxypropane; Methyloxirane", 
                "description" => "1,2-에폭시프로판", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "106-89-8", 
                "name" => "1-Chloro-2,3-Epoxypropane; Epichlorhydrin", 
                "description" => "에피클로로하이드린(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "74-88-4", 
                "name" => "Methyl Iodide; Iodomethane", 
                "description" => "요오드화메틸", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-15-0", 
                "name" => "Carbon Disulfide", 
                "description" => "이황화탄소", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "108-90-7", 
                "name" => "Chlorobenzene", 
                "description" => "클로로벤젠", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "79-34-5", 
                "name" => "1,1,2,2-Tetrachloroethane", 
                "description" => "1,1,2,2-테트라클로로에탄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "79-00-5", 
                "name" => "1,1,2-Trichloroethane", 
                "description" => "1,1,2-트리클로로에탄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "96-18-4", 
                "name" => "1,2,3-Trichloropropane", 
                "description" => "1,2,3-트리클로로프로판", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "109-99-9", 
                "name" => "Tetrahydrofuran", 
                "description" => "테트라하이드로퓨란", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "108-88-3", 
                "name" => "Toluene", 
                "description" => "톨루엔", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "584-84-9", 
                "name" => "4-Methyl-M-Phenylene Diisocyanate; Toluene-2,6-Di-Isocyanate", 
                "description" => "톨루엔-2,4-디이소시아네이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "91-08-7", 
                "name" => "2-Methyl-M-Phenylene Diisocyanate; Toluene-2,4-Di-Isocyanate", 
                "description" => "톨루엔-2,6-디이소시아네이트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "67-66-3", 
                "name" => "Trichloromethane; Chloroform", 
                "description" => "트리클로로메탄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "79-01-6", 
                "name" => "Trichloroethylene; Trichloroethene", 
                "description" => "트리클로로에틸렌(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "127-18-4", 
                "name" => "Tetrachloroethylene", 
                "description" => "퍼클로로에틸렌", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "108-95-2", 
                "name" => "Phenol", 
                "description" => "페놀(중량비율 0.3% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "50-00-0", 
                "name" => "Formaldehyde", 
                "description" => "포름알데히드(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "8052-41-3", 
                "name" => "Stoddard Solvent", 
                "description" => "스토다드솔벤트", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-55-8", 
                "name" => "2-Methylaziridine; Propyleneimine", 
                "description" => "프로필렌이민", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "110-86-1", 
                "name" => "Pyridine", 
                "description" => "피리딘", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "302-01-2", 
                "name" => "Hydrazine", 
                "description" => "하이드라진", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "110-54-3", 
                "name" => "N-Hexane", 
                "description" => "헥산(n-헥산)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "77-78-1", 
                "name" => "Dimethyl Sulphate", 
                "description" => "황산디메틸", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "107-06-2", 
                "name" => "1,2-Dichloroethane; Ethylene Dichloride", 
                "description" => "1,2-디클로로에탄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7439-92-1", 
                "name" => "Lead And Compounds (Inorganic)", 
                "description" => "납 및 그 무기화합물(중량비율 0.3% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7440-02-0", 
                "name" => "Nickel(Metal)", 
                "description" => "니켈 및 그 화합물(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7439-97-6", 
                "name" => "Mercury, Elemental, Aryl Compounds, As Hg", 
                "description" => "수은 및 그 화합물", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "13463-67-7", 
                "name" => "Titanium Dioxide", 
                "description" => "이산화티타늄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7440-43-9", 
                "name" => "Cadmium (Non-Pyrophoric); Cadmium (Pyrophoric)", 
                "description" => "카드뮴 및 그 화합물(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7440-48-4", 
                "name" => "Cobalt Metal With Tungsten Carbide", 
                "description" => "코발트 및 그 무기화합물", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "1314-62-1", 
                "name" => "Vanadium Pentoxide", 
                "description" => "오산화바나듐", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7722-84-1", 
                "name" => "Hydrogen Peroxide", 
                "description" => "과산화수소", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "76-03-9", 
                "name" => "Trichloroacetic Acid", 
                "description" => "트리클로로아세트산(삼염화초산)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "7664-93-9", 
                "name" => "Sulfuric Acid ", 
                "description" => "황산(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-21-8", 
                "name" => "Ethylene Oxide; Oxirane", 
                "description" => "산화에틸렌(중량비율 0.1% 이상)", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "630-08-0", 
                "name" => "Carbon Monoxide", 
                "description" => "일산화탄소", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-09-2", 
                "name" => "Dichloromethane; Methylene Chloride", 
                "description" => "염화메틸렌 ", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "1309-64-4", 
                "name" => "Antimony Trioxide", 
                "description" => "삼산화안티몬", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "67-66-3", 
                "name" => "Trichloromethane; Chloroform", 
                "description" => "클로로포름", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "74-90-8", 
                "name" => "Hydrogen Cyanide", 
                "description" => "시안화수소", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "67-56-1", 
                "name" => "Methanol", 
                "description" => "메탄올", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-59-2", 
                "name" => "Tetramethylammonium Hydroxide", 
                "description" => "수산화테트라메틸암모늄", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "78-87-5", 
                "name" => "1,2-Dichloropropane", 
                "description" => "1,2-디클로로프로판", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "111-96-6", 
                "name" => "Diethylene Glycol Dimet...", 
                "description" => "비스(2-메톡시에틸)에테르", 
                "created_at" => \Carbon::now()
            ], 
            [
                "cas_num" => "75-01-4", 
                "name" => "Chloroethylene", 
                "description" => "염화비닐", 
                "created_at" => \Carbon::now()
            ]
        ));
    }
}
