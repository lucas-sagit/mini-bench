<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function pagar(Request $request){
        
        $request->validate([
            'valor' => 'required|numeric|not_in:0'
        ]);
        
        $valorPago = $request->valor;
        $saldoAtual = auth()->user()->saldo;
        $novoSaldo = $saldoAtual - $valorPago;
        
        auth()->user()->update(['saldo'=>$novoSaldo]);
        
        return redirect()->route('dashboard')->with('success', 'Pagamento feito com sucesso.');
    }
    public function transferir(Request $request){
        
        
        ($user = User::where('email', $request->conta)->first());
        
        if(!$user) {
            return redirect()->back()->with('error', 'Insira corretamente os dados necessários.');
            }
        //(!user) não
    
        $user->update(['saldo'=>$user->saldo + $request->valor]);
        $valorTranferido = $request->valor;
        $saldoAtual = auth()->user()->saldo;
        $novoSaldo = $saldoAtual - $valorTranferido;

        auth()->user()->update(['saldo'=>$novoSaldo]);

        
        return redirect()->route('dashboard')->with('success', 'Transferência feito com sucesso.');

    }
    public function sacar(Request $request){
       
        $request->validate([
            'valor' => 'required|numeric|not_in:0'
        ]);

        $valorSacado = $request->valor;
        $saldoAtual = auth()->user()->saldo;
        $novoSaldo = $saldoAtual - $valorSacado;

        auth()->user()->update(['saldo'=>$novoSaldo]);

        return redirect()->route('dashboard')->with('success', 'Saque feito com sucesso.');
    }
    public function depositar(Request $request){

        $request->validate([
            'valor' => 'required|numeric|not_in:0'
        ]);

        $valorDepositado = $request->valor;
        $saldoAtual = auth()->user()->saldo;
        $novoSaldo = $saldoAtual + $valorDepositado;

        auth()->user()->update(['saldo'=>$novoSaldo]);

        return redirect()->route('dashboard')->with('success', 'Deposito feito com sucesso.');
    }
} 
