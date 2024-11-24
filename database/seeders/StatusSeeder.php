<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    private array $taskStatuses = ['TODO', 'DONE', 'DOING', 'DONE'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->taskStatuses as $status) {
            Status::create([
                'status' => $status
            ]);
        }

    }


}
