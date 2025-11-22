<?php

namespace App\Observers;

use App\Models\Conta;

class ContaObserver
{
    /**
     * Handle the Conta "created" event.
     */
    public function created(Conta $conta): void
    {
        // Se a conta foi criada já como paga, atualiza o saldo
        if ($conta->status === 'pago') {
            $user = $conta->user;
            
            if ($user) {
                $valor = (float) $conta->valor;
                
                // Se for receita, adiciona ao saldo
                if ($conta->tipo === 'receita') {
                    $user->increment('saldo', $valor);
                }
                // Se for despesa, subtrai do saldo
                elseif ($conta->tipo === 'despesa') {
                    $user->decrement('saldo', $valor);
                }
            }
        }
    }

    /**
     * Handle the Conta "updated" event.
     */
    public function updated(Conta $conta): void
    {
        // Pega o status original antes da atualização
        $statusOriginal = $conta->getOriginal('status');
        $statusAtual = $conta->status;
        
        // Verifica se o status mudou para 'pago'
        if ($statusOriginal !== 'pago' && $statusAtual === 'pago') {
            $user = $conta->user;
            
            if ($user) {
                $valor = (float) $conta->valor;
                
                // Se for receita, adiciona ao saldo
                if ($conta->tipo === 'receita') {
                    $user->increment('saldo', $valor);
                }
                // Se for despesa, subtrai do saldo
                elseif ($conta->tipo === 'despesa') {
                    $user->decrement('saldo', $valor);
                }
            }
        }
        
        // Se o status mudou de 'pago' para outro status, reverte a operação
        if ($statusOriginal === 'pago' && $statusAtual !== 'pago') {
            $user = $conta->user;
            
            if ($user) {
                $valor = (float) $conta->valor;
                
                // Se for receita, remove do saldo
                if ($conta->tipo === 'receita') {
                    $user->decrement('saldo', $valor);
                }
                // Se for despesa, adiciona ao saldo
                elseif ($conta->tipo === 'despesa') {
                    $user->increment('saldo', $valor);
                }
            }
        }
    }

    /**
     * Handle the Conta "deleted" event.
     */
    public function deleted(Conta $conta): void
    {
        //
    }

    /**
     * Handle the Conta "restored" event.
     */
    public function restored(Conta $conta): void
    {
        //
    }

    /**
     * Handle the Conta "force deleted" event.
     */
    public function forceDeleted(Conta $conta): void
    {
        //
    }
}
