<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Admin;
use Encore\Admin\Actions\SweatAlert2;
use App\Admin\Actions\Post\Replicate;
use App\Admin\Actions\Post\BatchReplicate;
use App\Admin\Actions\Post\ReportPost;
use App\Admin\Actions\Post\ImportPost;
use App\Admin\Models\ExampleModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExampleController extends AdminController
{
    use SoftDeletes;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Example controller';


    protected function title()
    {
        return trans('测试用的title');
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExampleModel);
        $grid->fixColumns(3, -5);
        $grid->fixHeader();


        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('admin.title'))->sortable()->editable()->filter('like');
        $grid->column('content', __('admin.content'))->sortable()->width(1900)->color('#ffff00')->help('亮瞎你');
        $grid->column('address', __('admin.address'))->sortable()->link();

        // $grid->column('address', __('admin.address'));
        // $grid->column('address', __('admin.address'));
        // $grid->column('address', __('admin.address'));
        // $grid->column('address', __('admin.address'));
        // $grid->column('address', __('admin.address'));//加上这些是为了演示fixColumns的效果

        $grid->selector(function (Grid\Tools\Selector $selector) {
            $selector->select('tag', '多选tag', [
                1 => '华为',
                2 => '小米',
                3 => 'OPPO',
                4 => 'vivo',
            ]);
        });
        $grid->column('hit', '点击量')->replace([0 => '还没被点击'])->editable()->totalRow();
        //$grid->column('status', __('admin.status'))->sortable();


        $states = [
            'on'  => ['value' => 1, 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'default'],
        ];
        $grid->column('status', __('admin.status'))->switch($states); //switch开关
        $grid->column('created_at', __('admin.created_at'))->sortable()->hide();
        $grid->column('updated_at', __('admin.updated_at'))->sortable()->substr(0, 10);

        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('name', '名称');
            $create->email('email', '邮箱');
        }); //快捷创建

        $grid->quickSearch('title');//快捷搜索

        $grid->filter(function (Grid\Filter $filter) {
            $filter->like('title');
            $filter->like('content');
            //$filter->equal('status')->select(['1'=>'启用','2'=>'禁用']);
            $filter->equal('status', '状态')->radio(['1' => '启用', '2' => '禁用']);
        }); //筛选
        $grid->expandFilter(); //展开筛选

        // $grid->actions(function(Grid\Displayers\Actions $actions) {
        //     // 去掉删除
        //     //$actions->disableDelete();
        //     // 去掉编辑
        //     //$actions->disableEdit();
        //     // 去掉查看
        //     //$actions->disableView();
        //     //$actions->add(new Replicate());//添加了复制 
        // });

        $grid->batchActions(function ($batch) {
            $batch->add(new BatchReplicate());//添加了批量复制到批量操作列表里
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ReportPost());
            $tools->append(new ImportPost());
        });


        $grid->header(function ($query) {
            return 'header';
        });
        
        $grid->footer(function ($query) {
            return 'footer'; 
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ExampleModel::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        admin_toastr('admin_toastr...', 'success');
        admin_success('admin_success...', 'warning');
        admin_info('admin_info...', 'warning');
        admin_error('admin_error...', 'warning');
        Admin::script('console.log("hello world");');


        $form = new Form(new ExampleModel);
        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));
        $form->text('title', __('admin.title'))->placeholder('请输入标题');
        $form->number('hit', '点击量')->rules('min:0');
        $form->textarea('content', __('admin.content'));
        $form->url('address', __('admin.address'))->rules('min:10');
        $form->multipleSelect('tag', '标签')->options(['1' => 'PHP', '2' => 'JAVA', '3' => 'MYSQL','4'=>'C++']);
        $form->switch('status', __('admin.status'));
        return $form;
    }
}
