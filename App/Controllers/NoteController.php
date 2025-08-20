<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Services\NoteService;

class NoteController extends Controller
{
    public function __construct(
        protected NoteService $note
    ){}

    public function index(): void
    {

    }

    public function createNote(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            dd($_POST);
        }
    }
}

