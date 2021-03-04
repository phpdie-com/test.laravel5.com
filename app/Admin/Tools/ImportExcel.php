<?php
namespace App\Admin\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class ImportExcel extends AbstractTool
{
    protected function script()
    {
        $html=<<<HTML
        $("#app-admin-actions-import").remove();
        let modelHtml='haha';
        $("#app").append(modelHtml);
        $("#app-admin-actions-import").model('show');
HTML;
    }

    public function render()
    {
        Admin::script($this->script());
        $text='导入Excel';
        return <<<EOT
    <a class="btn btn-sm btn-info" title="{$text}">
        <i class="fa fa-upload"></i><span class="hidden-xs">&nbsp;&nbsp;{$text}</span>
    </a>
EOT;
    }
}