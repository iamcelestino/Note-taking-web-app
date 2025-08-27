<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Core\Controller;
use App\Services\NoteService;

class HomeController extends Controller
{
    public function __construct
    ( 
        protected NoteService $note
    )
    {}

    public function index(): void
    {
         $notes = $this->note->getAllNotes();
         
        $this->view('all_notes', [
            'notes' => $notes
        ]);
    }
}