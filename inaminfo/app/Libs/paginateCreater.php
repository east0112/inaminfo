<?php
namespace App\Libs;

class paginateCreater
{
    private $items;
    private $displayItems;
    private $limit;
    private $offset;
    private $paginate;
    private $current_page;

    function __construct($items){
        $this->items = $items;
        $this->limit = config('const.EVENT_SEARCH_LIMIT');
    }

    public function setItems($items){
        $this->items = $items;
    }

    public function getItems(){
        return $this->items;
    }

    public function setLimit($limit){
        $this->limit = $limit;
    }

    public function getLimit(){
        return $this->limit;
    }

    public function getDisplayItems(){
        return $this->displayItems;
    }

    public function getPaginate(){
        return $this->paginate;
    }

    public function getCurrentPage(){
        return $this->current_page;
    }

    public function createPaginate($current_page){
        if(!is_numeric($current_page)) return false;

        // 表示項目の生成
        $this->offset = $this->limit * ($current_page - 1);
        $this->displayItems = array_slice($this->items,$this->offset,$this->limit);
        $this->current_page = $current_page;

        // オフセット結果が空の場合は1ページ目として処理する。
        if(empty($this->displayItems)){
            $this->displayItems = array_slice($this->items,0,$this->limit);
            $this->current_page = 1;
        }

        // ページネーションの作成
        $this->paginate = ceil(count($this->items) / $this->limit);

        return true;
    }
    

}