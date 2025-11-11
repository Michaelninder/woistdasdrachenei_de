<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\User;

class AnonymeDiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'fabianeternis@gmail.com')->first();

        if ($adminUser) {
            Thread::firstOrCreate(
                ['title' => 'Anonyme Diskussion'],
                [
                    'user_id' => $adminUser->id,
                    'is_pinned' => true,
                ]
            );
        }
    }
}
