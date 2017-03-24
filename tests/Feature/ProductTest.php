<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithoutMiddleware;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    private $productController;

    public function setUp()
    {
        parent::setUp();
        $this->productController = new ProductController();
    }

    /**
     * 测试抓取站点是否正常运行
     */
    public function testSiteStatus()
    {
        $response = $this->get(ProductController::$base_url);
        $response->assertStatus(200);
    }

    /**
     * 测试列表页是否正常访问
     */
    public function testRequestIndexStatus()
    {
        $response = $this->get('/product');

        $response->assertStatus(200);

    }

    /**
     * 测试内容是否为空
     */
    public function testContentIsEmpty()
    {
        $content = $this->productController->getContent(ProductController::$url);
        $this->assertNotEmpty($content);
        return $content;
    }

    /**
     * 测试HTML页面解析后的数据格式
     * @depends testContentIsEmpty
     */
    public function testContentFormat($content)
    {
        $formatData = $this->productController->formatData($content);
        $this->assertNotEmpty($formatData, '解析HTML数据失败');
        foreach ($formatData as $item) {
            $this->assertNotEmpty($item['product_url']);
            $this->assertNotEmpty($item['product_no']);
            $this->assertNotEmpty($item['product_title']);
            $this->assertNotEmpty($item['product_pic_url']);
            $this->assertRegExp('/^[0-9]{1,3}(,[0-9]{3}){1}(.[0-9]{1,2})?원$/', $item['product_price']);
        }
    }
}
