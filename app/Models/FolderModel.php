<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderModel extends Model
{
    use HasFactory;

    public function setNewFolder(Request $request){
        $folder = new FolderModel();
        $folder->folder = $request->folderName ?? '';
        $folder->created_by = Auth::user()->id;
        $folder->parent_id = $request->parentFolder ?? 0;
        $folder->slug = substr(sha1(time()),27,40);
        $folder->tenant_id = Auth::user()->tenant_id;
        $folder->save();
    }

    public function getAllFolders(){
        return FolderModel::where('tenant_id', Auth::user()->tenant_id)->orderBy('folder', 'ASC')->get();
    }

    public function getFolderBySlug($slug){
        return FolderModel::where('slug', $slug)->first();
    }
    public function getSubFoldersByParentId($id){
        return FolderModel::where('parent_id', $id)->where('tenant_id', Auth::user()->tenant_id)->get();
    }

    public function deleteFolder($folderId){
        $folder = FolderModel::find($folderId);
        $folder->delete();
    }

    public function moveDependentFoldersToIndex($parentId){
        $folders = FolderModel::where('parent_id', $parentId)->get();
        foreach($folders as $folder){
            $folder->parent_id = 0;
            $folder->save();
        }
    }

    public function getFolderById($folderId){
        return FolderModel::find($folderId);
    }
}
