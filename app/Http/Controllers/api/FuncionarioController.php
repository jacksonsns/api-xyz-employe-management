<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FuncionarioController extends Controller
{
    public function index() {
        $employee = Funcionario::get();

        return response()->json([
            "status" => 1,
            "data" => $employee
        ]);
    }

    public function store(Request $request) {

        $employee = new Funcionario;

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'email' => 'required|email|max:100|unique:funcionarios,email',
            'cpf' => 'required|size:14|unique:funcionarios,cpf',
            'celular' => 'nullable',
            'conhecimentos' => ['required', 'array', 'min:1', 'max:3'],
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este endereço de e-mail já está em uso.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.size' => 'O campo CPF deve ter exatamente 14 caracteres.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'conhecimentos.required' => 'É necessário selecionar pelo menos um conhecimento.',
            'conhecimentos.min' => 'Selecione pelo menos :min conhecimentos.',
            'conhecimentos.max' => 'Selecione no máximo :max conhecimentos.',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $employee->nome = $request->nome;
        $employee->email = $request->email;
        $employee->cpf = $request->cpf;
        $employee->celular = $request->celular;
        $employee->conhecimentos = json_encode($request->conhecimentos);
        $employee->save();
    
        return response()->json([
            "status" => 1,
            "msg" => "Registro efetuado com sucesso."
        ]);
    }

    public function update(Request $request, $name)
    {
        $record = Funcionario::where('nome', $name)->firstOrFail();
        $record->status = 'Validado';
        $record->validado_em = date("Y-m-d H:m:s");
        $record->save();

        return response()->json([
            "status" => 1,
            "msg" => "Funcionário validado com sucesso."
        ]);
    }

    public function search(Request $request)
    {
        $records = Funcionario::where('nome', 'like', '%'.$request->search.'%')
                              ->orderBy('nome', 'asc')
                              ->get();

        if ($records->count() == 0) {
            return response()->json([
                "status" => 2,
                "msg" => "Nenhum funcionário encontrado.."
            ]);
        }

        return response()->json([
            "status" => 1,
            "response" => $records
        ]);
    }
}
