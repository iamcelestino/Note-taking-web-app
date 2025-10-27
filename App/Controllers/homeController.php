<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthInterface;
use App\Core\Controller;
use App\Services\NoteService;

class HomeController extends Controller
{
    public function __construct
    ( 
        protected NoteService $note,
        protected AuthInterface $auth
    )
    {}

    public function index(): void
    {
        if(!$this->auth->isLoggedIn()) {
            $this->redirect('/login');
        }

        $notes = $this->note->getAllNotes();
        $allTags = array_map(fn($note) => $note->tags, $notes); 
        foreach($allTags as $tag) { 
            if(str_contains($tag, ',')) { 
                $tag = explode(",", $tag); 
                $allTags[] = $tag;
            } 
        }
        
        $allTags = convertStringIntoArray($notes);

        $this->view('all_notes', [
            'notes' => $notes,
            'tags' => $allTags
        ]);
    }
}