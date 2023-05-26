<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'What is Laravel cotroller ?',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit culpa neque accusamus eum,
             non animi a exercitationem consequuntur esse ut eaque, iure, perspiciatis laudantium distinctio?
             Voluptas cum nam aut ipsam!',
             'image' => "",
             'user_id' => 12
        ]);

        Post::create([
            'title' => 'What is Laravel cotroller ?',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit culpa neque accusamus eum,
             non animi a exercitationem consequuntur esse ut eaque, iure, perspiciatis laudantium distinctio?
             Voluptas cum nam aut ipsam!',
             'image' => "",
             'user_id' => 13
        ]);

        Post::create([
            'title' => 'What is Laravel cotroller ?',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit culpa neque accusamus eum,
             non animi a exercitationem consequuntur esse ut eaque, iure, perspiciatis laudantium distinctio?
             Voluptas cum nam aut ipsam!',
             'image' => "",
             'user_id' => 14
        ]);
    }
}
