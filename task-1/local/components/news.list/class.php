<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class NewsListComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params["NEWS_COUNT"] = intval($params["NEWS_COUNT"]) > 0 ? intval($params["NEWS_COUNT"]) : 10;
        $params["CATEGORY"] = isset($params["CATEGORY"]) ? $params["CATEGORY"] : '';
        return $params;
    }

    public function executeComponent()
    {
        $this->arResult = [];
        
        $newsCount = $this->arParams["NEWS_COUNT"];
        $category = $this->arParams["CATEGORY"];
        $page = isset($_REQUEST["PAGEN_1"]) ? intval($_REQUEST["PAGEN_1"]) : 1;
        
        $filter = [];
        if ($category) {
            $filter["CATEGORY"] = $category;
        }
        
        $dbNews = CIBlockElement::GetList(
            ['DATE_ACTIVE_FROM' => 'DESC'],
            $filter,
            false,
            ['nPageSize' => $newsCount, 'iNumPage' => $page],
            ['ID', 'NAME', 'DATE_ACTIVE_FROM', 'PREVIEW_TEXT']
        );
        
        $this->arResult["ITEMS"] = [];
        while ($news = $dbNews->Fetch()) {
            $this->arResult["ITEMS"][] = $news;
        }
        
        $this->arResult["NAV_STRING"] = $dbNews->GetPageNavStringEx($navComponentObject, "Новости", "");
        
        $this->includeComponentTemplate();
    }
}
