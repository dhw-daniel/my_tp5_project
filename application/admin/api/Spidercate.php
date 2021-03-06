<?php
namespace app\admin\api;

use app\admin\service\SpiderCateService;
use think\facade\Request;

class Spidercate extends Base
{
    /**
     * 初始化方法
     *
     * @param  \app\admin\service\SpiderCateService $spiderCate
     */
    public function __construct(SpiderCateService $spiderCate)
    {
        parent::__construct();

        $this->service = $spiderCate;
    }

    /**
     * 接口--获取爬虫分类列表
     *
     * @return
     */
    public function getList()
    {
        return $this->response->collection(
            $this->service->getList()
        );
    }

    /**
     * 接口--删除单条记录操作
     *
     * @return
     */
    public function delete()
    {
        $id = Request::param('id');

        $this->service->destroy($id);

        return $this->response->json(
            ['success'=> true]
        );
    }

    /**
     * 接口--删除多条记录操作
     *
     * @return
     */
    public function deleteAll()
    {
        $ids = Request::param('ids');

        $ids = array_filter(explode(',',$ids));

        foreach ($ids as $id){
            $this->service->destroy($id);
        }

        return $this->response->json(
            ['success'=> true]
        );
    }
}
