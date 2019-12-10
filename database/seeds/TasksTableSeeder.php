<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title'=>'Laravel Backend',
            'description'=>'Design and build Laravel Backend',
            'status'=>'Completed',
            'dueDate'=>'2019-11-24',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('tasks')->insert([
            'title'=>'Passport API',
            'description'=>'Add Passport API support to the backend',
            'status'=>'Completed',
            'dueDate'=>'2019-11-28',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('tasks')->insert([
            'title'=>'Test API',
            'description'=>'Test API for all the necessary requests using Postman or other tool',
            'status'=>'Completed',
            'dueDate'=>'2019-11-29',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('tasks')->insert([
            'title'=>'Normal Frontend',
            'description'=>'Develop Normal Bootstrap Frontend to perform CRUD',
            'status'=>'In Progress',
            'dueDate'=>'2019-11-30',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
          DB::table('tasks')->insert([
            'title'=>'jQuery/Ajax Frontend',
            'description'=>'Build another frontend using bootstrap, jQuery, JS and Ajax',
            'status'=>'In Progress',
            'dueDate'=>'2019-12-05',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('tasks')->insert([
            'title'=>'React Frontend',
            'description'=>'Develop React frontend that operates using API',
            'status'=>'In Progress',
            'dueDate'=>'2019-12-10',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('tasks')->insert([
            'title'=>'Perform Testing',
            'description'=>'Perform testing of all functionality for both frontend and set them to root page',
            'status'=>'In Progress',
            'dueDate'=>'2019-12-10',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
        DB::table('tasks')->insert([
            'title'=>'Mobile applications',
            'description'=>'Build iOS and Android application that works through the API',
            'status'=>'Queue',
            'dueDate'=>'2019-12-20',
            'user_id'=>'1',
            'created_at'=> \DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'=> \DB::raw('CURRENT_TIMESTAMP'),
          ]);
    }
}
