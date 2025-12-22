<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntervenantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    return [
        'nom' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'telephone' => 'nullable|string|max:50',
        'role' => 'required|in:artiste,animateur,dj',
        'region' => 'nullable|string|max:255',
        'pays' => 'nullable|string|max:100',
        'date_debut' => 'nullable|date',
        'jour_evenement' => 'nullable|string',
        'heure_debut' => 'nullable',
        'heure_fin' => 'nullable',
        'vote_actif' => 'nullable|boolean',
        'date_limite_vote' => 'nullable|date',
        'photo' => 'nullable|image|max:2048',
        'paroles_classiques' => 'nullable|file|mimes:pdf,doc,docx',
        'paroles_hits' => 'nullable|file|mimes:pdf,doc,docx',
    ];
}

}
