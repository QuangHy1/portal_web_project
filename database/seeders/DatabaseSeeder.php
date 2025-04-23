<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            JobCategoriesSeeder::class,
            JobTypesSeeder::class,
            ExperiencesSeeder::class,
            LocationsSeeder::class,
            IndustriesSeeder::class,
            SalaryRangesSeeder::class,
            VacanciesSeeder::class,
            CompaniesSeeder::class,
            TopBarsSeeder::class,
            FooterContentsSeeder::class,
            PageHomeItemsSeeder::class,
            UsersSeeder::class,
            AdminsSeeder::class,
            EditorsSeeder::class,
            EmployeesSeeder::class,
            ResumesSeeder::class,
            EmployersSeeder::class,
            UserRolesSeeder::class,
            HiringsSeeder::class,
            EmployeeApplicationsSeeder::class,
            EmployeeBookmarksSeeder::class,
            PostsSeeder::class,
            UserTestimonialsSeeder::class,
        ]);
    }
}
