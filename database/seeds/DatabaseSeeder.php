<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserTypesSeeder::class);
        $this->call(AddressTypeTableSeeder::class);
        $this->call(FactoryTypeTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(CertificationTypeTableSeeder::class);
        $this->call(MaterialTypeTableSeeder::class);
        $this->call(HazardousSubstanceTableSeeder::class);
        $this->call(UnitOfMeasureTableSeeder::class);
        $this->call(EmployeeCountTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(MachineManufacturerTableSeeder::class);
        $this->call(MachineProcessTypeTableSeeder::class);
        $this->call(MachineTypeTableSeeder::class);
        $this->call(QsaCriteriaTypeTableSeeder::class);
        $this->call(ContactRoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserBusinessTableSeeder::class);
        $this->call(UserTypeAlterTableSeeder::class);
        $this->call(UserTypePermissionTableSeeder::class);
        $this->call(FormSubmissionStatusSeeder::class);
        $this->call(FormTypeSeeder::class);
        $this->call(SupplierStatusSeeder::class);
        $this->call(PrimaryContactSeeder::class);
    }
}
