<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Subscribe;
use App\Models\Winner;
use Carbon\Carbon;
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

    public function create()
    {
        return view('competitions.create');
    }

    public function winners()
    {

        $winners = Competition::with('winners')->get();
        return view('competitions.winners', compact('winners'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tittle' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'raffle_date' => 'required|date|after:end_date',
            'scholarship_amount' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $competition = new Competition();
        $competition->tittle = $validatedData['tittle'];
        $competition->start_date = $validatedData['start_date'];
        $competition->end_date = $validatedData['end_date'];
        $competition->raffle_date = $validatedData['raffle_date'];
        $competition->scholarship_amount = $validatedData['scholarship_amount'] ?? 5;
        $competition->is_active = $validatedData['is_active'] ?? true;
        $competition->save();

        return redirect()->route('competition.index')->withStatus(__('Bolsão criado com sucesso.'));
    }

    public function show($id)
    {

        $competition = Competition::find($id);

        if (!$competition) {
            return redirect()->route('competition.index')->withStatus(__('Bolsão não encontrado.'));
        }
        $subscribes = Subscribe::where('id_competition', $competition->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $winners = Winner::where('id_competition', $competition->id)
            ->with('subscribe.user')
            ->get();
        return view('competitions.show', compact('competition', 'subscribes', 'winners'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'tittle' => 'max:255',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'raffle_date' => 'required|date|after:end_date',
            'scholarship_amount' => 'integer|min:1|max:100',
            'is_active' => 'boolean'
        ]);
        $competition = Competition::find($request->id);


        $competition->tittle = $request->tittle;
        $competition->start_date = $request->start_date;
        $competition->end_date = $request->end_date;
        $competition->raffle_date = $request->raffle_date;
        $competition->scholarship_amount = $request->scholarship_amount;
        $competition->is_active = $request->is_active;

        if ($competition->save()) {
            return redirect()->route('competition.index')->withStatus(__('Bolsão atualizado com sucesso.'));
        }
    }

    public function cancel(Request $request)
    {
        //return $request;
        $competition = Competition::find($request->id);
//return $competition;
        $competition->is_active = 0;

        if ($competition->save()) {
            return redirect()->route('competition.index')->withStatus(__('Bolsão cancelado com sucesso.'));
        }
    }


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
}
