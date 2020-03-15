<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\paginateCreater;
use App\Http\Models\ticketLoader;

class LoadTicketsController extends Controller
{
    /**
     * イベント取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadTickets($requestParameter){
        $responceParameter = new responceParameter();
        $ticketLoader = new ticketLoader();

        $ticketLists = $ticketLoader->loadCurrentTicketLists(date("Y-m-d H:i:s"));

        $responceParameter->setParam('ticketLists',$ticketLists);

        return $responceParameter->getReturnData();
    }

  }
