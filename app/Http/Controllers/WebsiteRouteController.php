<?php

namespace App\Http\Controllers;

use App\Website;
use App\WebsiteAbout;
use App\WebsiteContact;
use App\WebsiteMenu;
use App\WebsitePortfolio;
use App\WebsiteService;
use App\WorkGroup;
use App\WorkGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteRouteController extends Controller
{
    public $Website;

    public function __construct(Request $request)
    {
        $account = $request->route()->parameter('account');
        $this->Website = Website::where('domain', $account)->orWhere('subdomain', $account)->first();

        $WorkGroup = WorkGroupUser::where('id', $this->Website->id )->first();
        Session::put('work_group', WorkGroup::find($WorkGroup->work_group_id) );
    }

    public function index () {

        $Website = $this->Website;

        $Menu       = WebsiteMenu::where('website_id', $Website->id)->where('status', 1)->get();
        $About      = WebsiteAbout::where('website_id', $Website->id)->where('status', 1)->get();
        $Service    = WebsiteService::where('website_id', $Website->id)->where('status', 1)->get();
        $Portfolio  = WebsitePortfolio::where('website_id', $Website->id)->where('status', 1)->get();
        $Contact    = WebsiteContact::where('website_id', $Website->id)->where('status', 1)->get();

        return view("website.templates.{$Website->template}.index", compact('Website', 'Menu', 'About', 'Service', 'Portfolio', 'Contact'));
    }
}
