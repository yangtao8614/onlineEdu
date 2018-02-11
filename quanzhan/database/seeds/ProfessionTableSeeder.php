<?php

use Illuminate\Database\Seeder;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profession')->insert([
        		[
        			'profession_name'=>'PHP学科',
        			'profession_desc'=>'是世界上最好的语言'
        		],
        		[
        			'profession_name'=>'HTML5&全栈',
        			'profession_desc'=>'是世界上最好的语言'
        		],
        		[
        			'profession_name'=>'Python全栈',
        			'profession_desc'=>'是世界上最好的语言'
        		]

        ]);
    }
}
