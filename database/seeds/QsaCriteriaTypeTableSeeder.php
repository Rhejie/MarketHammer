<?php

use Illuminate\Database\Seeder;
use App\Model\QSACriteria;
use App\Model\QSAType;

class QsaCriteriaTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // delete all current data
        \DB::table('qsa_criteria')->delete();
        \DB::table('qsa_type')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE qsa_criteria AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE qsa_type AUTO_INCREMENT = 1;');

        $criteria_list = array (
            [
                'attributes' => [
                    'name' => 'system',
                    'description' => '',
                ],
                'children' => array (
                    [
                        'name' => 'Resource Management',
                        'description' => '',
                        'created_at' => \Carbon::now()
                    ],
                )
            ],
            [
                'attributes' => [
                    'name' => 'process',
                    'description' => '',
                ],
                'children' => array (
                    [
                        'name' => 'SPC',
                        'description' => '',
                        'created_at' => \Carbon::now()
                    ],
                    [
                        'name' => 'Material Control',
                        'description' => '',
                        'created_at' => \Carbon::now()
                    ],
                    [
                        'name' => 'Operation Standard',
                        'description' => '',
                        'created_at' => \Carbon::now()
                    ],
                    [
                        'name' => 'Work shift manual',
                        'description' => '',
                        'created_at' => \Carbon::now()
                    ],
                    [
                        'name' => 'Process Improvement',
                        'description' => '',
                        'created_at' => \Carbon::now()
                    ],
                )
            ],
            [
                'attributes' => [
                    'name' => 'product',
                    'description' => ''
                ]
            ],
        );

        foreach($criteria_list as $criteria) {
            $model_criteria_arr = $criteria['attributes'];
            $model_criteria_arr['created_at'] = \Carbon::now();
            $model_criteria = QSACriteria::create($model_criteria_arr);

            if(isset($criteria['children']) && count($criteria['children']) > 0){
                $qsa_type_arr = [];
                foreach($criteria['children'] as $type) {
                    $qsa_type_arr[] = new QSAType($type);
                }
                $model_criteria->qsaType()->saveMany($qsa_type_arr);
            }
        }
    }
}