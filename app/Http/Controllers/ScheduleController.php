<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function update(Request $request)
    {
        // Valide os dados
        $request->validate([
            'day' => 'required|string',
            'hours' => 'required|string',
        ]);

        // Atualize os horários no banco de dados ou em outro local de armazenamento
        $schedules = json_decode(file_get_contents(storage_path('app/schedules.json')), true);
        $schedules[$request->day] = $request->hours;
        file_put_contents(storage_path('app/schedules.json'), json_encode($schedules));

        return redirect()->back()->with('success', 'Horário atualizado com sucesso!');
    }
}
