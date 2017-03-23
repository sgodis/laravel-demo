<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // 请求地址
    public static $url = 'http://www.3tempo.co.kr/product/list.html?cate_no=25';
    
    // host地址,不带参数
    public static $base_url = 'http://www.3tempo.co.kr';

    // 最大page
    private static $maxPage = 5;

    /**
     * 列表展示页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $page = $page > 5 ? self::$maxPage : $page;
        $requestUrl = self::$url . '&page=' . $page;
        $content = $this->getContent($requestUrl);
        $productList = $this->formatData($content);
        $perPage = 24;
        $total = self::$maxPage * $perPage;

        $paginator =new LengthAwarePaginator($productList, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        $productList = $paginator->toArray()['data'];
        return view('product.index', [
            'productList'   => $productList,
            'paginator'     => $paginator
        ]);
    }

    /**
     * 获取请求页面的内容
     */
    public function getContent($requestUrl)
    {
        return file_get_contents($requestUrl);
    }

    /**
     * 解析HTML,返回格式化数据
     * @param $content
     * @return array
     */
    public function formatData($content)
    {
        $result = [];
        try {
            $html = new \HtmlParser\ParserDom($content);
            foreach ($html->find('div.xans-product-listnormal ul.prdList li') as $li) {
                $tagA = $li->find('div.box p.name a', 0);
                $product_url = $tagA->getAttr('href');
                $pattern = '/product_no=(\d+)&/';
                preg_match($pattern, $product_url, $match);
                if (!empty($match) && isset($match[1])) {
                    $product_no = $match[1];
                } else {
                    $product_no = '';
                }
                $product_title = $tagA->find('span', 0)->getPlainText();
                $product_pic_url = $li->find('div.box a img.thumb', 0)->getAttr('src');
                $product_price = $li->find('div.box ul li span', 0)->getPlainText();

                $result[] = [
                    'product_url'       => $this->fixHost($product_url),
                    'product_no'        => $product_no,
                    'product_title'     => $product_title,
                    'product_pic_url'   => $product_pic_url,
                    'product_price'     => trim($product_price),
                ];
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
        return $result;
    }

    private function fixHost($url)
    {
        return self::$base_url . $url;
    }
}
