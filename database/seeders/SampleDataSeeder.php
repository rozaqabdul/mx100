<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Company;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::firstOrCreate(
            ['slug' => 'koperasi-nusantara'],
            [
                'name'        => 'Koperasi Nusantara',
                'industry'    => 'IT Services',
                'website'     => 'https://koperasi-nusantara.test',
                'description' => 'Divisi IT Development yang mengelola platform MX100.',
            ]
        );

        /** @var \App\Models\User $employer */
        $employer = User::firstOrCreate(
            ['email' => 'employer@mx100.test'],
            [
                'name'       => 'MX100 Employer',
                'password'   => bcrypt('password'),
                'company_id' => $company->id,
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );
        $employer->syncRoles(['employer']);

        /** @var \App\Models\User $freelancer1 */
        $freelancer1 = User::firstOrCreate(
            ['email' => 'freelancer1@mx100.test'],
            [
                'name'     => 'Freelancer Satu',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );
        $freelancer1->syncRoles(['freelancer']);

        /** @var \App\Models\User $freelancer2 */
        $freelancer2 = User::firstOrCreate(
            ['email' => 'freelancer2@mx100.test'],
            [
                'name'     => 'Freelancer Dua',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );
        $freelancer2->syncRoles(['freelancer']);

        /** @var \App\Models\JobVacancy $publishedJob */
        $publishedJob = JobVacancy::firstOrCreate(
            [
                'company_id' => $company->id,
                'title'      => 'Laravel Backend Developer (Remote)',
            ],
            [
                'posted_by'   => $employer->id,
                'description' => 'Membangun API MX100 untuk menghubungkan perusahaan dan freelancer.',
                'status'      => 'published',
                'location'    => 'Remote',
                'budget_min'  => 8000000,
                'budget_max'  => 12000000,
            ]
        );

        JobVacancy::firstOrCreate(
            [
                'company_id' => $company->id,
                'title'      => 'Part-time Frontend Vue.js Developer',
            ],
            [
                'posted_by'   => $employer->id,
                'description' => 'Mengembangkan frontend dashboard MX100.',
                'status'      => 'draft',
                'location'    => 'Jakarta',
                'budget_min'  => 5000000,
                'budget_max'  => 9000000,
            ]
        );

        Application::firstOrCreate(
            [
                'job_vacancy_id'    => $publishedJob->id,
                'freelancer_id'     => $freelancer1->id,
            ],
            [
                'cv_path'      => 'cvs/freelancer1-sample-cv.pdf',
                'cover_letter' => 'Saya memiliki pengalaman 3 tahun menggunakan Laravel dan microservices.',
            ]
        );

        Application::firstOrCreate(
            [
                'job_vacancy_id'    => $publishedJob->id,
                'freelancer_id'     => $freelancer2->id,
            ],
            [
                'cv_path'      => 'cvs/freelancer2-sample-cv.pdf',
                'cover_letter' => 'Saya terbiasa mengerjakan API berperforma tinggi dan scalable.',
            ]
        );
    }
}
