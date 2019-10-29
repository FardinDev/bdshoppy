<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Categories extends AbstractWidget
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
        $count = \App\ProductCategory::count();
        $string = 'Categories';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-tag',
            'title'  => "{$count} {$string}",
            'text'   => "",
            'button' => [
                'class' => 'btn btn-danger',
                'text' => 'View All Categories',
                'link' => route('voyager.product-categories.index'),
            ],
            'image' => 'images/widgets/category.png',
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
