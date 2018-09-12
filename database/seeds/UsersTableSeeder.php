<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 批量生成数据
        $arr = [];
        for($i=0;$i<49;$i++) {
        	$tmp = [];
        	$tmp['username'] = str_random(16);
        	$tmp['email'] = str_random(8).'@163.com';
        	$tmp['password'] = Hash::make('root');
        	$tmp['profile'] = '/uploads/20180911/15366833112667.png';
        	$tmp['intro'] = str_random(1000);
        	$tmp['created_at'] = date('Y-m-d H:i:s');
        	$tmp['updated_at'] = date('Y-m-d H:i:s');

        	$arr[] = $tmp;
        }
        DB::table('users') -> insert($arr);
    }
}
