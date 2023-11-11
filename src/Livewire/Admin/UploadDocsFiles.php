<?php

namespace Osfrportal\OsfrportalLaravel\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Osfrportal\OsfrportalLaravel\Models\SfrDocs;
use Osfrportal\OsfrportalLaravel\Http\Controllers\SFRUnepController;

class UploadDocsFiles extends Component
{
    use WithFileUploads;
    public $docid;

    private $flasherInterface;

    public $rules = [
        'docFileName' => 'mimes:pdf|max:100000',
        'docFileDescription' => 'required|string',
    ];
    protected $messages = [
        '*.required' => 'Поле должно быть заполнено',
        '*.mimes' => 'Допустимый формат файла - :values',
        '*.max' => 'Превышен допустимый размер файла (:max Кб)',

    ];
    public $docFileName;
    public $docFileDescription;

    public function __construct() {

        $this->flasherInterface = flash()->options([
            'timeout' => '10000',
            'layout' => 'topCenter',
            'modal' => true,
            'closeWith' => ['click', 'button'],
            'theme' => 'bootstrap-v5'
        ]);
    }

    public function render()
    {
        return view('osfrportal::livewire.admin.upload-docs-files');
    }

    public function updatedDocFileName() {
        $this->validate();
    }

    public function updatedDocFileDescription() {
        $this->validate();
    }

    public function uploadDocs(SFRUnepController $controller)
    {


        $fileid = Str::uuid();
        $doc = SfrDocs::where('docid', $this->docid)->firstOrFail();
        $this->validate();
        $extension = $this->docFileName->extension();
        $fullfilename = sprintf('%s.%s', $fileid, $extension);
        $this->docFileName->storePubliclyAs('.', $fullfilename, 'docsfiles');

        $gostHash = $controller->gostHashFile($fullfilename);

        $doc->SfrDocsFiles()->create([
            'fileid' => $fileid,
            'file_name' =>  $fullfilename,
            'file_description' => $this->docFileDescription,
            'file_gosthash' => $gostHash,
            'file_disk' => 'docsfiles',
        ]);

        $this->flasherInterface->addSuccess('Файл успешно загружен');
        $this->docFileName = null;
        $this->docFileDescription = null;
        return redirect()->route('osfrportal.admin.docs.detail', ['docid' => $this->docid]);
    }
}
