<?php
namespace App\Libs;

class paginateCreater
{
    private $items;
    private $offset;
    private $limit;
    private $displayItems;
    private $show_pages;
    public $max_page;
    public $total_count;
    public $paginate;
    public $current_page;
    public $paginateParam;

    function __construct($items){
        $this->items = $items;
        $this->limit = config('const.EVENT_SEARCH_LIMIT');
        $this->show_pages = config('const.EVENT_SEARCH_SHOW_PAGES');
        $this->paginate = array();
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

    public function getMaxPage(){
        return $this->max_page;
    }

    public function getTotalCount(){
        return $this->total_count;
    }

    public function createPaginate($current_page,$paginateParam){
        if(!is_numeric($current_page)) return false;

        // 表示項目の生成
        $this->offset = $this->limit * ($current_page - 1);
        $this->displayItems = array_slice($this->items,$this->offset,$this->limit);
        $this->current_page = $current_page;
        $this->paginateParam = $paginateParam;
        $this->total_count = count($this->items);

        // オフセット結果が空の場合は1ページ目として処理する。
        if(empty($this->displayItems)){
            $this->displayItems = array_slice($this->items,0,$this->limit);
            $this->current_page = 1;
        }

        //ページ数の算出
        $this->max_page = ceil(count($this->items) / $this->limit);
        //両端の算出
        $both_end = ($this->show_pages - 1 ) / 2;
        //ページネーション生成
        if(($this->current_page - $both_end) < 1 ){
            for($i = 1 ; ( $i <= $this->show_pages && $i <=$this->max_page ) ; $i++){
                $this->paginate[] = $i;
            }
        }elseif(($this->current_page + $both_end) > $this->max_page ){
            for($i = 0 ; ( $i < $this->show_pages && ($this->max_page - $i) >= 1 ) ; $i++){
                $this->paginate[] = $this->max_page - $i;
            }
        }else{
            for($i = $both_end ; $i > 0 ; $i--){
                $this->paginate[] = $this->current_page - $i;
            }
            $this->paginate[] = intval($this->current_page);
            for($i = 1 ; $i <= $both_end ; $i++){
                $this->paginate[] = $this->current_page + $i;
            }
        }
        //ページネーションを昇順にソート
        sort($this->paginate);

        return true;
    }
    

}