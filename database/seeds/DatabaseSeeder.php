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
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    	DB::table('authors')->truncate();
    	DB::table('books')->truncate();

    	factory(App\Author::class, 20)->create()->each(function($author){
    		$author->book()->save(factory(App\Book::class)->make());
    	});
    }
}
