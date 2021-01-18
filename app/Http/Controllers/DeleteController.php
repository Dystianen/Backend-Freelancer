<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delete;

class DeleteController extends Controller
{
  public function getAll($limit = 10, $offset = 0){
    $data["count"] = Delete::count();
    $delete = array();
    foreach (Delete::take($limit)->skip($offset)->get() as $p) {
        $item = [
            "id" => $p->id,
            "userid" => $p->userid,
            "name" => $p->name,
            "descriptions" => $p->descriptions,
            "minimumprice" => $p->minimumprice,
            "status" => $p->status,
            "created_at" => $p->created_at,
            "updated_at" => $p->updated_at,

        ];
        

        array_push($delete, $item);
    }
    $data["delete"] = $delete;
    $data["status"] = 1;
    return response($data);
}
  
  public function delete($id)
    {
        try{

            Delete::where("id", $id)->delete();

            return response([
            	"status"	=> 1,
              "message"   => "Jasa berhasil dihapus."
            ]);
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
              "message"   => $e->getMessage()
            ]);
        }
    }
}