<?php

use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('processes')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE processes AUTO_INCREMENT = 1;');

        \DB::table('processes')->insert(array (
            [
                'process_type_id' => 1,
                'name' => 'Centrifugal Casting (Industrial)',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Continuous Casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Evaporative-pattern Casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Investmenet Casting (Lost-wax casting)',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Low pressure die casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Permanent mold casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Resin casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Sand casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Slush casting, Slurry casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Vacuum molding',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Die casting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 1,
                'name' => 'Shell molding',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 2,
                'name' => 'Laser engraving',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 2,
                'name' => 'Inkjet printing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 2,
                'name' => 'Chemical vapor deposition',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 2,
                'name' => 'Sputter deposition',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 2,
                'name' => 'Plating',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 2,
                'name' => 'Thermal spraying',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 4,
                'name' => 'Powder metallurgy',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 4,
                'name' => 'Plastics',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 4,
                'name' => 'Shrink wrapping',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'End tube forming',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Forging',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Rolling',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Extrusion',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Pressing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Bending',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Shearing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 5,
                'name' => 'Other',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Mills',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Milling',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Drilling',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Reaming',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Countersinking',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Tapping',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Sawing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Broaching',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Shaping',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Planing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Honing (Sharpening)',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Finishing & industrial finishing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Routing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Hobbing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Ultrasonic machining',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Electrical discharge',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Electrical discharge machining (EDM)',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Electron beam machining',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Electrochemical machining',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Chemical',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Photochemical',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Laser cutting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Grinding',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Gashing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 6,
                'name' => 'Biomachining',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Welding',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Brazing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Soldering',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Sintering',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Adhesive bonding (incomplete)',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Fastening wood and metal',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 7,
                'name' => 'Press fitting',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => '3D printing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Direct metal laser sintering[',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Filament winding, produces composite pipes, tanks, etc.',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Fused deposition modeling',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Laminated object manufacturing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Laser engineered net shaping',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Rapid Induction Printing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Selective laser sintering',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Spark plasma sintering',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 8,
                'name' => 'Stereolithography',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Mining',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Chemical manufacturing',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Petroleum refining',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Semiconductor fabrication',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Assembly line',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Packaging and labeling',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Logistics',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Woodworking',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Vulcanization',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Heat treating',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'process_type_id' => 10,
                'name' => 'Bake-out',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
        ));
    }
}
