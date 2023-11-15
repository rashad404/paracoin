<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Seo;
use App\Models\Team;

class MainController extends Controller
{
    public function notFound()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => '404',
        ];
        return view(__FUNCTION__)->with($data);
    }

    public function development()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'Development...',
        ];
        return view(__FUNCTION__)->with($data);
    }

    public function about()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'About',
        ];
        return view(__FUNCTION__)->with($data);
    }

    public function team()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'Our team',
            'teams' => Team::where('status', 1)->get(),
        ];
        return view(__FUNCTION__)->with($data);
    }

    public function faq()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'FAQ',
            'faqs' => Faq::where('status', 1)->get(),
        ];
        return view(__FUNCTION__)->with($data);
    }
}
