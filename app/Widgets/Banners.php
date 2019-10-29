<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Banners extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Banner::count();
        $string = 'Banners';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-images',
            'title'  => "{$count} {$string}",
            'text'   => "",
            'button' => [
                'class' => 'btn btn-danger',
                'text' => 'View All Banners',
                'link' => route('voyager.banners.index'),
            ],
            'image' => 'images/widgets/banner.jpg',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user();
    }
}
