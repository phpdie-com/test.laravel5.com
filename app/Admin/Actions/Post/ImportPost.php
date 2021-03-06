<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;
use Encore\Admin\Actions\Interactor\Form;
use Encore\Admin\Actions\Interactor\Dialog;
use Illuminate\Http\Request;

class ImportPost extends Action
{
    public $name = '导入数据title';

    protected $selector = '.import-post';

    public function handle(Request $request)
    {
        // 下面的代码获取到上传的文件，然后使用`maatwebsite/excel`等包来处理上传你的文件，保存到数据库
        $request->file('file');

        return $this->response()->success('导入完成！')->refresh();
    }

    public function form()
    {
        $this->file('file', '请选择文件');
        dump(get_class($this));
        dump(get_class_methods($this));
    }

    // public function dialog(){
    //     $this->info('ggg'.'dss');
    // }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-info import-post"><i class="fa fa-upload"></i>我是按钮导入数据</a>
HTML;
    }
}
