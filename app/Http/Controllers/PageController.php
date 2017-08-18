<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Backpack\PageManager\app\Models\Page;
use App\Models\ProductCategory;
use App\Models\MenuItem;
use Cart;
use DB;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('index');

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();

        $categories = ProductCategory::where('visible', 1)->orderBy('id', 'asc')->get();
        $this->data['categories'] = $categories;
        return view('pages.index', $this->data);
    }


    public function page($slug)
    {

        $page = Page::findBySlug($slug);

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();
        //danh sach san pham
        if ($slug == 'mua-thuc-pham-sach') {
            $this->data['isShop'] = '1';
            $categories = ProductCategory::where('visible', 1)->get();
            $this->data['categories'] = $categories;
            return view('pages.index', $this->data);
        }

        // thonbg tin san pham
        if ($page->template == 'about_us' || $page->template == 'services'){
            //thông tin
            $this->data['about_pages'] = DB::table('pages')->where('template', 'about_us')->get();
            //chăm sóc khách hàng
            $this->data['service_pages'] = DB::table('pages')->where('template', 'services')->get();
        }

        return view('pages.'.$page->template, $this->data);
    }

    public function getProduct($slug)
    {
        
        $product = DB::select('SELECT p.`name` "name", p.`slug` "slug", im.`filename` 
            "image", i.`price_customer` "price" FROM `products` p, `prices` i, `images` im, `products_images` pi WHERE p.`price_id` = i.`id` AND p.`id` = pi.`product_id` AND pi.`image_id` = im.`id` AND p.`slug` = ? ', [$slug]);

        if (!$product)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $page = Page::findBySlug('thong-tin-chi-tiet-thuc-pham-sach');
        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();

        return view('pages.product_details', $this->data);
    }

    public function addCart(Request $request)
    {
        $data = $request->data;
        // Cart::update($data['rowId'], $data['qty']);
        return Cart::content();
    }
    

    public function testcart()
    {
        Cart::destroy();
        Cart::add([
          ['id' => '1', 'name' => 'Thit heo 1', 'qty' => 1, 'price' => 20000, 'options' => ['image' => 'http://trangtraitrungthuc.com/media/thit/thit-ba-chi.png','nd_id' => 'TG111', 'name' => 'Nông trại Bác 8 Bình D ']],
          ['id' => '3', 'name' => 'rau cai huu co 2', 'qty' => 2, 'price' => 10000, 'options' => ['image' => 'http://trangtraitrungthuc.com/media/rau/cai-thao.png','nd_id' => 'TG111', 'name' => 'Nông trại Bác 8 Bình ']]
        ]);
        return Cart::content();
    }

}
