<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['section_code' => 'MSL', 'name' => 'Sales'],
            ['section_code' => 'MMS', 'name' => 'Marketing Support'],
            ['section_code' => 'MBD', 'name' => 'Business Development'],
            ['section_code' => 'INC', 'name' => 'IT Non Cellular'],
            ['section_code' => 'ITC', 'name' => 'IT Cellular'],
            ['section_code' => 'ITS', 'name' => 'IT Support'],
            ['section_code' => 'IMS', 'name' => 'Information Management System'],
            ['section_code' => 'FCL', 'name' => 'Calculation'],
            ['section_code' => 'FCC', 'name' => 'Cost Control'],
            ['section_code' => 'FAC', 'name' => 'Accounting'],
            ['section_code' => 'FEF', 'name' => 'Efficiency'],
            ['section_code' => 'FPR', 'name' => 'Procurement'],
            ['section_code' => 'LPP', 'name' => 'Production Planning'],
            ['section_code' => 'LIC', 'name' => 'Inventory Control'],
            ['section_code' => 'LSH', 'name' => 'Shipment'],
            ['section_code' => 'FPR', 'name' => 'Printing'],
            ['section_code' => 'PLM', 'name' => 'Lamination'],
            ['section_code' => 'PIS', 'name' => 'Inspection'],
            ['section_code' => 'PME', 'name' => 'Module Embedding'],
            ['section_code' => 'PRS', 'name' => 'Perso Cellular'],
            ['section_code' => 'PRN', 'name' => 'Perso Non-Cellular'],
            ['section_code' => 'PPP', 'name' => 'Packing'],
            ['section_code' => 'QPE', 'name' => 'Product Engineering'],
            ['section_code' => 'QLC', 'name' => 'Quality Control'],
            ['section_code' => 'TEC', 'name' => 'Technic'],
            ['section_code' => 'HHR', 'name' => 'Human Resources'],
            ['section_code' => 'HGA', 'name' => 'General Affairs'],
            ['section_code' => 'HLG', 'name' => 'Legal'],
            ['section_code' => 'SSI', 'name' => 'Internal Security'],
            ['section_code' => 'QMS', 'name' => 'Quality Management System'],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                ['section_code' => $section['section_code']],
                ['name' => $section['name']]
            );
        }
    }
}
