<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key'   => 'title',
                // 'value' => 'The Annual<br><span>Marketing</span> Conference'
                'value' => 'Cybersecurity for<br><span>Small</span>&<span>Medium</span> Enterprises'
            ],
            [
                'key'   => 'subtitle',
                'value' => '10-12 December, Downtown Conference Center, New York'
            ],
            [
                'key'   => 'youtube_link',
                'value' => 'https://www.youtube.com/watch?v=jDDaplaOz7Q'
            ],
            [
                'key'   => 'about_description',
                'value' => 'We are your smart go-to SME for scaling your system in terms of Cyber Security. We offer alot of combined cyber needed skills at such affordable & low prices'
            ],
            [
                'key'   => 'about_where',
                'value' => 'Downtown Conference Center, New York'
            ],
            [
                'key'   => 'about_when',
                'value' => 'Monday to Wednesday<br>10-12 December'
            ],
            [
                'key'   => 'contact_address',
                'value' => 'A108 Adam Street, NY 535022, USA'
            ],
            [
                'key'   => 'contact_phone',
                'value' => '+1 5589 55488 55'
            ],
            [
                'key'   => 'contact_email',
                'value' => 'info@example.com'
            ],
            [
                'key'   => 'footer_description',
                'value' => 'In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.'
            ],
            [
                'key'   => 'footer_address',
                'value' => 'A108 Adam Street <br> New York, NY 535022<br> United States '
            ],
            [
                'key'   => 'footer_twitter',
                'value' => '#'
            ],
            [
                'key'   => 'footer_facebook',
                'value' => '#'
            ],
            [
                'key'   => 'footer_instagram',
                'value' => '#'
            ],
            [
                'key'   => 'footer_googleplus',
                'value' => '#'
            ],
            [
                'key'   => 'footer_linkedin',
                'value' => '#'
            ],
        ];

        foreach($settings as $setting)
        {
            Setting::create($setting);
        }
    }
}