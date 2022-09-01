<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Level;
use nataalam\Models\School;
use nataalam\Models\User;
use Phine\Path\Path;
use Symfony\Component\Finder\SplFileInfo;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10)->create();
        $levels = Level::all();

        foreach ($users as $user) {
            $chosenLevel = $levels->random();

            $user->branch_id = $chosenLevel->branches->random()->id;
            $user->level_id = $chosenLevel->id;
            $user->save();
        }

        $photosFolder = 'database/seeds/files/users/photos';
        $dest = 'app/public/users/photos';
        $photos = File::allFiles(base_path($photosFolder));

        /** @var $photo SplFileInfo */
        $allUsers = User::all();
        foreach ($photos as $i => $photo) {
            if ($allUsers->has($i))
                File::copy(
                    $photo->getPathName(),
                    storage_path(
                        join_paths($dest, $allUsers->get($i)->id . '.jpg')
                    )
                );
            else
                break;
        }

    }
}
