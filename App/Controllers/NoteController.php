<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Core\Controller;
use App\Services\{NoteService};
use App\Contracts\{NoteValidateInterface, AuthInterface, UserInterface};
use App\Enums\NoteStatus;

class NoteController extends Controller
{
    public function __construct(
        protected NoteService $note,
        protected AuthInterface $auth,
        protected UserInterface $user,
        protected NoteValidateInterface $noteValidator
    ){}

    public function index(): void
    {
        $this->view('all_notes', []);
    }

    public function createNote(): void
    {
        
        $userEmail = $this->auth->getEmail();
        $user = $this->user->where('email', $userEmail);

        if(!$user) {
            die;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $note = [
                'status' => NoteStatus::active->value ?? null,
                'user_id' => $user[0]->user_id ?? null,
                'title' => $_POST['title'],
                'content' => $_POST['content'] ?? null
            ];
            
            $nome = explode(',', $_POST['nome']);
            $this->note->createNote($note, $nome);
            $this->redirect('/home');
        }

        $this->view('create_new_note', []);
    }

    public function getAndDisplaySingleNote(int $noteId): void
    {
        echo " this note id is a " . gettype($noteId);
        $singleNote = null;
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $singleNote = $this->note->getSingleNote($noteId);
        }

        $notes = $this->note->getAllNotes();
        $allTags = convertStringIntoArray($notes);

        $this->view('all_notes', [
            'singleNote' => is_array($singleNote) ? $singleNote[0] : $singleNote,
            'notes' => $notes,
            'tags' => $allTags
        ]);
    }

    public function deleteNote($id): void
    {
        $note_id = (int)$id;
        $note = $this->note->getSingleNote($note_id);

        if (!$note) {
            $this->redirect('/home');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->note->deleteNote($id);
            $this->redirect('/home');
        }

        $this->view('delete_note', [
            'note' => $note[0]
        ]);
    }

    public function updateNote($id)
    {
        $note_id = (int)$id;
        $note = $this->note->getSingleNote($note_id);

        if (!$note) {
            $this->redirect('/home');
        }

        $notes = [
            'content' => $_POST['content'] ?? null,
            'status' => $_POST['status'] ?? null
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = explode(',', $_POST['nome']);
            $this->note->updateNote($note_id, $notes, $nome);
            $this->redirect('/home');
        }
    
        $this->view('update_note', [
            'note' => $note[0]
        ]);
    }

    public function getArchivedNotes(): void
    {
        $archivedNotes = $this->note->getArchivedNotes();

        $this->view('archived_notes', [
            'archivedNotes' => $archivedNotes
        ]);
    } 

    public function searchNote(): void {

        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $text = $_GET['text'];
            $notes = $this->note->searchNote($text);
        }

        $this->view('all_notes', [
            'notes' => $notes
        ]);
    }

    public function getNotesByTags(): void
    {
        $tag = explode("/", $_SERVER['REQUEST_URI']);
        dd($tag[3]);
        $this->view('all_notes', []);
    }
}

