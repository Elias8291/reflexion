<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::query()
            ->latest()
            ->get();

        return view('inicio', compact('comentarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['nullable', 'email', 'max:120'],
            'mensaje' => ['required', 'string', 'min:10', 'max:800'],
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El nombre no debe superar los 100 caracteres.',
            'correo.email' => 'El correo debe ser una direccion de email valida.',
            'correo.max' => 'El correo no debe superar los 120 caracteres.',
            'mensaje.required' => 'El campo mensaje es obligatorio.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'mensaje.max' => 'El mensaje no debe superar los 800 caracteres.',
        ]);

        $comentario = Comentario::create($data);

        $celebrationTitle = 'Gracias por compartir tu reflexión';
        $celebrationBody = 'Tu voz enriquece esta exposición. Recuerda: no te drogues — cuidar tu salud y tu futuro es un acto de dignidad. El placer fugaz no vale tus sueños ni a quienes te quieren; decir «no» también es fortaleza. Si necesitas apoyo, busca ayuda confiable: no estás solo.';

        if ($request->expectsJson()) {
            return response()->json([
                'celebration' => [
                    'title' => $celebrationTitle,
                    'body' => $celebrationBody,
                ],
                'comentario' => [
                    'nombre' => $comentario->nombre,
                    'mensaje' => $comentario->mensaje,
                    'fecha' => $comentario->created_at->format('d M'),
                ],
            ]);
        }

        return redirect('/#voces')
            ->with('celebration_title', $celebrationTitle)
            ->with('celebration_body', $celebrationBody);
    }
}
