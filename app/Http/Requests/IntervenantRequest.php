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
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'region' => 'nullable|string',
            'pays' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',

            'jour_evenement' => 'nullable|string',
            'heure_debut' => 'nullable',
            'heure_fin' => 'nullable',

            'vote_actif' => 'nullable|boolean',
            'date_limite_vote' => 'nullable|date',

            'paroles_classiques' => 'nullable|file|mimes:pdf,doc,docx',
            'paroles_hits' => 'nullable|file|mimes:pdf,doc,docx',
        ];
    }
}
