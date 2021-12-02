<?php

use Illuminate\Database\Seeder;

class AdditionalSnsListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sns_list')->insert(array (
            [
                'name' => 'WeChat',
                'color' => '#42f57b',
                'description' => "WeChat is a Chinese multi-purpose messaging, social media and mobile payment app developed by Tencent. First released in 2011, it became the world's largest standalone mobile app in 2018, with over 1 billion monthly active users.",
                'website' => 'https://www.wechat.com',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kakao',
                'color' => '#f5e042',
                'description' => "Kakao is a South Korean Internet company that was established in 2010. It formed as a result of a merger between Daum Communications and the original Kakao Inc. In 2014, the company was renamed Daum Kakao. The company rebranded once more in 2015, reverting simply to Kakao.",
                'website' => 'https://www.kakaocorp.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Line',
                'color' => '#42f57b',
                'description' => "LINE is a freeware app for instant communications on electronic devices such as smartphones, tablet computers, and personal computers. LINE users exchange texts, images, video and audio, and conduct free VoIP conversations and video conferences.",
                'website' => 'https://line.me/en/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ]
        ));
    }
}
