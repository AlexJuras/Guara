<?php

namespace App\Observers;

use App\Models\Conta;
use Carbon\Carbon;

class ContaObserver
{
    /**
     * Handle the Conta "created" event.
     */
    public function created(Conta $conta): void
    {
        // Se a conta foi criada já como paga, atualiza o saldo e data de pagamento
        if ($conta->status === 'pago') {
            // Atualiza a data de pagamento para agora sem disparar o observer novamente
            $conta->updateQuietly(['data_pagamento' => now()]);
            
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

        // Se for uma conta recorrente, gera as contas subsequentes
        if ($conta->recorrente && $conta->recorrencia_tipo && $conta->recorrencia_repeticoes > 1) {
            $this->gerarContasRecorrentes($conta);
        }
    }

    /**
     * Gera contas recorrentes baseado na periodicidade
     */
    private function gerarContasRecorrentes(Conta $contaMae): void
    {
        $dataBase = Carbon::parse($contaMae->data_vencimento);
        $repeticoes = $contaMae->recorrencia_repeticoes;

        // A primeira conta já foi criada, então criamos as demais (repeticoes - 1)
        for ($i = 1; $i < $repeticoes; $i++) {
            $novaData = $dataBase->copy();

            // Calcula a nova data baseado no tipo de recorrência
            switch ($contaMae->recorrencia_tipo) {
                case 'diaria':
                    $novaData->addDays($i);
                    break;
                case 'semanal':
                    $novaData->addWeeks($i);
                    break;
                case 'mensal':
                    $novaData->addMonths($i);
                    break;
                case 'anual':
                    $novaData->addYears($i);
                    break;
            }

            // Cria a nova conta recorrente (sem disparar o Observer novamente)
            Conta::withoutEvents(function () use ($contaMae, $novaData) {
                Conta::create([
                    'user_id' => $contaMae->user_id,
                    'dono_id' => $contaMae->dono_id,
                    'nome' => $contaMae->nome,
                    'tipo' => $contaMae->tipo,
                    'categoria' => $contaMae->categoria,
                    'valor' => $contaMae->valor,
                    'status' => 'pendente', // Sempre cria como pendente
                    'data_vencimento' => $novaData,
                    'data_pagamento' => null,
                    'recorrente' => false, // Marca como false para evitar loop
                    'recorrencia_tipo' => $contaMae->recorrencia_tipo,
                    'recorrencia_repeticoes' => $contaMae->recorrencia_repeticoes,
                    'conta_recorrente_id' => $contaMae->id, // Vincula à conta mãe
                    'metodo_pagamento' => $contaMae->metodo_pagamento,
                    'descricao' => $contaMae->descricao,
                ]);
            });
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
            // Atualiza a data de pagamento para agora sem disparar o observer novamente
            $conta->updateQuietly(['data_pagamento' => now()]);
            
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
            // Limpa a data de pagamento
            $conta->updateQuietly(['data_pagamento' => null]);
            
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
