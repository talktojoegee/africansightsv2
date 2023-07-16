<?php

namespace App\Http\Controllers;

use App\Models\FileModel;
use App\Models\FolderModel;
use App\Models\Slider;
use Illuminate\Http\Request;

class CloudStorageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->file = new FileModel();
        $this->folder = new FolderModel();

        $this->slider = new Slider();
    }

    public function showCloudStorage(){
        return view('manager.storage.index',[
            'folders'=>$this->folder->getAllFolders(),
            'files'=>$this->file->getIndexFiles()
        ]);
    }

    public function storeFiles(Request $request){
        $this->validate($request,[
            'attachments'=>'required',
            'folder'=>'required',
            'fileName'=>'required'
        ]);
        $this->file->uploadFiles($request);
        session()->flash("success", "Your file(s) were uploaded!");
        return back();
    }

    public function createFolder(Request $request){
        $this->validate($request,[
            'folderName'=>'required',
            'visibility'=>'required'
        ]);

        $this->folder->setNewFolder($request);
        session()->flash("success", "<strong>Success!</strong> New folder created.");
        return back();
    }

    public function openFolder(Request $request){
        $folder = $this->folder->getFolderBySlug($request->slug);

        if(!empty($folder)){
            $files = $this->file->getFilesByFolderId($folder->id);
            $folders = $this->folder->getSubFoldersByParentId($folder->id);
            return view('manager.storage.view',
                ['files'=>$files, 'folder'=>$folder, 'folders'=>$folders]);
        }else{
            session()->flash("error", " No record found.");
            return back();
        }
    }


    public function downloadAttachment(Request $request){
        try{
            //return dd($request->all());
            return $this->file->downloadFile($request->slug);
            /*session()->flash("success", "Processing request...");
            return back();*/
        }catch (\Exception $ex){
            session()->flash("error", "Whoops! File does not exist.");
            return back();
        }

    }


    public function deleteAttachment(Request $request){
        $this->validate($request,[
            'directory'=>'required',
            'key'=>'required'
        ]);
        $file = $this->file->getFileById($request->key);
        if(!empty($file)){
            #Unlink
            $this->file->deleteFile($file->filename);
            $file->delete();
            session()->flash("success", "File deleted.");
            return back();
        }else{
            session()->flash("error", "Ooops! File does not exist.");
            return back();
        }

    }


    public function deleteFolder(Request $request){
        $this->validate($request,[
            'folder_key'=>'required'
        ]);
        $folder = $this->folder->getFolderById($request->folder_key);
        if(!empty($folder)){
            $this->folder->deleteFolder($request->folder_key);
            $this->folder->moveDependentFoldersToIndex($request->folder_key);
            $this->file->moveDependentFilesToIndex($request->folder_key);
            session()->flash("success", " Folder deleted.");
            return back();
        }else{
            session()->flash("error", "Whoops! Folder does not exist.");
            return back();
        }
    }

    public function showSliders(){
        return view('super-admin.slider.index',[
            'sliders'=>$this->slider->getSliders()
        ]);
    }


    public function storeSlider(Request $request){
        $this->validate($request,[
            'image'=>'required',
            'description'=>'required',
            'title'=>'required',
            'status'=>'required',
        ],[
            'image.required'=>"Choose an image to be used as slider",
            'description.required'=>"Enter a brief description",
            'title.required'=>"Enter title ",
            'status.required'=>"Choose slide status",
        ]);
        $filename = $this->file->uploadSingleFile($request);
        $this->slider->publishSlider($request, $filename);
        session()->flash("success", "Action successful!");
        return back();
    }


    public function editSlider(Request $request){
        $this->validate($request,[
            'image'=>'required',
            'description'=>'required',
            'title'=>'required',
            'status'=>'required',
            'slideId'=>'required'
        ],[
            'image.required'=>"Choose an image to be used as slider",
            'description.required'=>"Enter a brief description",
            'title.required'=>"Enter title ",
            'status.required'=>"Choose slide status",
            'slideId'=>''
        ]);
        $filename = $this->file->uploadSingleFile($request);
        $this->slider->editSlider($request, $filename);
        session()->flash("success", "Your changes were saved");
        return back();
    }

    public function showAddNewSlider(){
        return view('super-admin.slider.add-new-slider');
    }
}
