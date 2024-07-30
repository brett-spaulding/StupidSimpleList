<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class TodoListController extends Controller
{
    public function index()
    {
        return view('welcome', ['listItems' => ListItem::all()]);
    }

    public function saveItem(Request $request)
    {
        // \Log::info(json_encode($request->all()));
        $newListItem = new ListItem;
        $newListItem->name = $request->input('listItem');
        $newListItem->is_completed = 0;
        $newListItem->save();
        return redirect('/');
    }

    public function toggleCompleted($id)
    {
        $listItem = ListItem::find($id);
        $listItem->is_completed = $listItem->is_completed ? 0 : 1;
        $listItem->save();
        return response(['state'=>'complete'], 204, ['HX-Redirect'=>'/']);
    }

    public function deleteItem($id)
    {
        $listItem = ListItem::find($id);
        $listItem->delete();
        return response(['state'=>'complete'], 204, ['HX-Redirect'=>'/']);
    }

    public function removeCompleted() {
        $listItemsCompleted = ListItem::where('is_completed', '=', 1);
        if (count($listItemsCompleted->get()) > 0) {
            $listItemsCompleted->delete();
        }
        return redirect('/');
    }
}
