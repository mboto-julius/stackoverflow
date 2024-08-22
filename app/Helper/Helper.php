<?php

use App\Models\Question;

function allQuestions()
{
    return Question::count();
}