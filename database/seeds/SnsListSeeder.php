<?php

use Illuminate\Database\Seeder;

class SnsListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all current data
        \DB::table('sns_list')->delete();

        // reset auto increment to zero
        DB::statement('ALTER TABLE sns_list AUTO_INCREMENT = 1;');

        \DB::table('sns_list')->insert(array (
            [
                'name' => 'Facebook',
                'color' => '#3B5998',
                'description' => 'Facebook is defined as an online social networking website where people can create profiles, share information such as photos and quotes about themselves, and respond or link to the information posted by others.',
                'website' => 'https://facebook.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Twitter',
                'color' => '#60B1EF',
                'description' => 'Twitter is a free social networking microblogging service that allows registered members to broadcast short posts called tweets.  Tweets and replies to tweets can be sent by cell phone text message, desktop client or by posting at the Twitter.com website.',
                'website' => 'https://twitter.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'LinkedIn',
                'color' => '#3D7BB7',
                'description' => 'LinkedIn is an American business and employment-oriented online service that operates via websites and mobile apps. Launched on May 5, 2003, the platform is mainly used for professional networking, and allows job seekers to post their CVs and employers to post jobs.',
                'website' => 'https://www.linkedin.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Instagram',
                'color' => '#DD357D',
                'description' => 'Instagram is a free, online photo-sharing application and social network platform that was acquired by Facebook in 2012. Each post by a user appears on their followers\' Instagram feeds and can also be viewed by the public when tagged using hashtags or geotags.',
                'website' => 'https://www.instagram.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'WhatsApp',
                'color' => '#62CD42',
                'description' => 'WhatsApp Messenger is a cross-platform instant messaging application that allows iPhone, BlackBerry, Android, Windows Phone and Nokia smartphone users to exchange text, image, video and audio messages for free. WhatsApp is especially popular with end users who do not have unlimited text messaging.',
                'website' => 'https://www.whatsapp.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Tumblr',
                'color' => '#2B4662',
                'description' => 'The service allows users to post multimedia and other content to a short-form blog. Users can follow other users\' blogs.',
                'website' => 'http://tumblr.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Snapchat',
                'color' => '#FDFC00',
                'description' => 'Snapchat is a popular messaging app that lets users exchange pictures and videos (called snaps) that are meant to disappear after they\'re viewed. It\'s advertised as a "new type of camera" because the essential function is to take a picture or video, add filters, lenses or other effects and share them with friends.',
                'website' => 'https://www.snapchat.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pinterest',
                'color' => '#CB2827',
                'description' => 'Pinterest is a visual discovery engine for finding ideas like recipes, home and style inspiration, and more. With billions of Pins on Pinterest, you\'ll always find ideas to spark inspiration. When you discover Pins you love, save them to boards to keep your ideas organized and easy to find.',
                'website' => 'https://www.pinterest.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Reddit',
                'color' => '#E7412C',
                'description' => 'Reddit is a social news aggregation, web content rating, and discussion website. Registered members submit content to the site such as links, text posts, and images, which are then voted up or down by other members.',
                'website' => 'https://www.reddit.com/',
                'created_at' => \Carbon::now()->format('Y-m-d H:i:s')
            ],
        ));
    }
}
