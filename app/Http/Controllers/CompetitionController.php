<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Subscribe;
use App\Models\Winner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competition::all();
        return view('competitions.index', compact('competitions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('competitions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tittle' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'raffle_date' => 'required|date|after:end_date',
            'scholarship_amount' => 'integer|min:1|max:100',
        ]);

        $competition = new Competition();
        $competition->tittle = $validatedData['tittle'];
        $competition->start_date = $validatedData['start_date'];
        $competition->end_date = $validatedData['end_date'];
        $competition->raffle_date = $validatedData['raffle_date'];
        $competition->scholarship_amount = $validatedData['scholarship_amount'] ?? 5;
        $competition->save();

        return redirect()->route('competition.index')->withStatus(__('Bolsão criado com sucesso.'));
    }
    /**
     * Exibe as informações de um bolsão específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $competition = Competition::find($id);
        
        if (!$competition) {
            return redirect()->route('competition.index')->withStatus(__('Bolsão não encontrado.'));
        }
        $subscribes = Subscribe::where('id_competition', $competition->id)
            ->with('id_user')
            ->orderBy('created_at', 'desc')
            ->get();

        $winners = Winner::where('id_competition', $competition->id)
            ->with('subscribe.id_user')
            ->get();
        return view('competitions.show', compact('competition', 'subscribes', 'winners'));
    }

    /**
     * Exibe o formulário para editar um bolsão específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competition = Competition::find($id);
        return view('competitions.edit', compact('competition'));
    }

    /**
     * Atualiza um bolsão específico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $competition = Competition::find($request->id);

        $validatedData = $request->validate([
            'tittle' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'raffle_date' => 'required|date|after:end_date',
            'scholarship_amount' => 'integer|min:1|max:100',
        ]);

        $competition->update([

            'tittle' => $validatedData['tittle'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'raffle_date' => $validatedData['raffle_date'],
            'scholarship_amount' => $validatedData['scholarship_amount'] ?? 5,
        ]);
        return redirect()->route('competition.index')->withStatus(__('Bolsão atualizado com sucesso.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $competition = Competition::find($id);
    
        if ($competition) {
            $competition->subscribes()->delete();
            $competition->delete();
            return redirect()->route('competition.index')->withStatus(__('Bolsão excluído com sucesso!'));
        }
    
        return redirect()->route('competition.index')->withStatus(__('Não foi possível excluir o bolsão.'));
    }

    public function subscribe(Request $request)
    {

        $competition = Competition::findOrFail($request->id);

        if (!Auth::user()->cpf) {
            return redirect()->route('profile.edit')->withStatus(__('Finalize seu cadastro para participar do Bolsão'));
        }

       
        if (Subscribe::where('id_competition', $competition->id)->where('id_user', Auth::user()->id)->exists()) {
            return redirect()->route('competition.index')->withStatus(__('Você já está inscrito neste bolsão.'));
        }

        $subscribe = new Subscribe([
            'id_competition' => $competition->id,
            'id_user' => Auth::user()->id,
        ]);

        $subscribe->save();

        return redirect()->route('competition.index')->withStatus(__('Inscrição realizada com sucesso!'));
    }
    public function raffle(Request $request)
    {
        $competition = Competition::findOrFail($request->id);

        if (Winner::where('id_competition', $competition->id)->exists()) {
            return redirect()->route('competition.index')->withStatus(__('Já foram sorteados vencedores para este bolsão.'));
        }

        $subscribes = Subscribe::where('id_competition', $competition->id)->get();

        $winners_amount = $competition->winners_amount ?? 5;
        $winners = $subscribes->random($winners_amount);

        foreach ($winners as $subscribe) {
            $winner = new Winner([
                'id_competition' => $competition->id,
                'id_subscribe' => $subscribe->id,
            ]);

            $winner->save();
        }

        return redirect()->route('competition.index')->withStatus(__('Sorteio realizado com sucesso!'));
    }
}
