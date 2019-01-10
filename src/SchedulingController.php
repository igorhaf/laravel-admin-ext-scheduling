<?php

namespace Encore\Admin\Scheduling;

use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SchedulingController
{
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Tarefas Agendadas')
            ->description('Listando')
            ->breadcrumb(
                ['text' => 'Tarefas Agendadas', 'url' => 'scheduling/index'],
                ['text' => 'Listando']
            )
            ->body($this->grid()->render());
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Tarefas Agendadas')
            ->description("Novo")
            ->breadcrumb(
                ['text' => 'Tarefas Agendadas', 'url' => 'scheduling/index'],
                ['text' => 'Novo']
            )
            ->body($this->form());
    }

    protected function grid()
    {
        $grid = new Grid(new Task());
        $grid->filter(function($filter){
            $filter->disableIdFilter();
        });
        $grid->description('Descrição')->sortable();

        return $grid;
    }

    protected function getFrequencyParams(){
        return [
            [
                'label'             => 'A Cada Minuto',
                'interval'          => 'everyMinute',
                'parameters'        => false,
            ],
            [
                'label'             => 'A Cada 5 Minutos',
                'interval'          => 'everyFiveMinutes',
                'parameters'        => false,
            ],
            [
                'label'             => 'A Cada 10 Minutos',
                'interval'          => 'everyTenMinutes',
                'parameters'        => false,
            ],
            [
                'label'             => 'A Cada Meia Hora',
                'interval'          => 'everyThirtyMinutes',
                'parameters'        => false,
            ],
            [
                'label'             => 'A Cada Hora',
                'interval'          => 'hourly',
                'parameters'        => false,
            ],
            [
                'label'             => 'Por Hora em',
                'interval'          => 'hourlyAt',
                'parameters'        => [
                    [
                        'label'         => 'Em',
                        'name'          => 'at',
                        'type'          => 'number',
                        'min'           => '0',
                        'max'           => '59',
                    ],
                ],
            ],
            [
                'label'             => 'Diariamente',
                'interval'          => 'daily',
                'parameters'        => false,
            ],
            [
                'label'             => 'Por dia em',
                'interval'          => 'dailyAt',
                'parameters'        => [
                    [
                        'label'         => 'Em',
                        'name'          => 'at',
                        'type'          => 'time',
                    ],
                ],
            ],
            [
                'label'             => 'Duas Vezes por Dia',
                'interval'          => 'twiceDaily',
                'parameters'        => [
                    [
                        'label'         => 'Primeiro',
                        'name'          => 'at',
                        'type'          => 'time',
                    ],
                    [
                        'label'         => 'Segundo',
                        'name'          => 'second_at',
                        'type'          => 'time',
                    ],
                ],
            ],
            [
                'label'             => 'Semanalmente',
                'interval'          => 'weekly',
                'parameters'        => false,
            ],
            [
                'label'             => 'Semanalmente em',
                'interval'          => 'weeklyOn',
                'parameters'        => [
                    [
                        'label'         => 'No dia',
                        'name'          => 'on',
                        'type'          => 'number',
                        'min'           => '1',
                        'max'           => '31',
                    ],
                    [
                        'label'         => 'Em',
                        'name'          => 'at',
                        'type'          => 'time',
                    ],
                ],
            ],
            [
                'label'             => 'Mensalmente',
                'interval'          => 'monthly',
                'parameters'        => false,
            ],
            [
                'label'             => 'Mensalmente em',
                'interval'          => 'monthlyOn',
                'parameters'        => [
                    [
                        'label'         => 'No',
                        'name'          => 'on',
                        'type'          => 'number',
                        'max'           => '',
                    ],
                    [
                        'label'         => 'Em',
                        'name'          => 'at',
                        'type'          => 'time',
                    ],
                ],
            ],
            [
                'label'             => 'Duas Vezes por Mës',
                'interval'          => 'twiceMonthly',
                'parameters'        => [
                    [
                        'label'         => 'Primeiro',
                        'name'          => 'on',
                        'type'          => 'number',
                    ],
                    [
                        'label'         => 'Segundo',
                        'name'          => 'second_at',
                        'type'          => 'text',
                    ],
                ],
            ],
            [
                'label'             => 'Trimestral',
                'interval'          => 'quarterly',
                'parameters'        => false,
            ],
            [
                'label'             => 'Anual',
                'interval'          => 'yearly',
                'parameters'        => false,
            ],
            [
                'label'             => 'Dias úteis',
                'interval'          => 'weekdays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Todos os Domingos',
                'interval'          => 'sundays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Toda Segunda-Feira',
                'interval'          => 'mondays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Toda Terça-Feira',
                'interval'          => 'tuesdays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Toda Quarta-Feira',
                'interval'          => 'wednesdays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Toda Quinta-Feira',
                'interval'          => 'thursdays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Toda Sexta-Feira',
                'interval'          => 'fridays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Todos os Sábados',
                'interval'          => 'saturdays',
                'parameters'        => false,
            ],
            [
                'label'             => 'Entre',
                'interval'          => 'between',
                'parameters'        => [
                    [
                        'label'         => 'Começo',
                        'name'          => 'start',
                        'type'          => 'time',
                    ],
                    [
                        'label'         => 'Fim',
                        'name'          => 'end',
                        'type'          => 'time',
                    ],
                ],
            ],
            [
                'label'             => 'A menos que entre',
                'interval'          => 'unlessBetween',
                'parameters'        => [
                    [
                        'label'         => 'Começo',
                        'name'          => 'start',
                        'type'          => 'time',
                    ],
                    [
                        'label'         => 'Fim',
                        'name'          => 'end',
                        'type'          => 'time',
                    ],
                ],
            ],
        ];
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $commands = array();
        foreach (Artisan::all() as $key => $cmd){
            $commands[$cmd->getName()] = '['.$cmd->getName().'] -- '.$cmd->getDescription();
        }
        $frequencies = $this->getFrequencyParams();
        $result_frequencies =array();
        foreach ($frequencies as $freq){
            $result_frequencies[$freq['interval']] = $freq['label'];
        }
        $tzlist = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        $result = array_combine($tzlist, $tzlist);
        $form = new Form(new Task());

        $form->display('id', 'ID');

        $form->text('description', 'Descrição:')->rules('required');
        $form->select('command', 'Commando')->options($commands);
        $form->text('parameter', 'Parametros');
        $form->select('timezone', 'Timezone')->options($result);
        $form->radio('type', 'Tipo')->options(['expression' => 'Expressão', 'frequency'=> 'Frequencia'])->default('expression');
        $form->text('expression', 'Expressão');
        $form->select('frequencies', 'Frequências')->options($result_frequencies);

        $form->text('notification_email_address', 'Notificar via E-mail');
        $form->text('notification_phone_number', 'Notificar via SMS');
        $form->text('notification_slack_webhook', 'Notificar via Slack');
        $form->checkbox('dont_overlap', 'Sem sobreposição')->options([1 => 'Várias instâncias da mesma tarefa devem se sobrepor ou não.']);
        $form->checkbox('run_in_maintenance', 'Rodar em modo de manutenção')->options([1 => 'Decide se a tarefa deve ser executada enquanto o aplicativo estiver no modo de manutenção.']);
        $form->checkbox('run_on_one_server', 'Executar em um único servidor')->options([1 => 'Decide se a tarefa deve ser executada em um único servidor.']);
        $form->number('auto_cleanup_num', 'Auto limpeza');
        $form->radio('auto_cleanup_type', 'Tipo de limpeza')->options(['days' => 'Por dias', 'results'=> 'Por resultado'])->default('r');
        $form->display('created_at', trans('admin.created_at'))->with(function ($created_at){
            return Carbon::parse($created_at)->format('d/m/Y H:i:s');
        });
        $form->display('updated_at', trans('admin.updated_at'))->with(function ($updated_at){
            return Carbon::parse($updated_at)->format('d/m/Y H:i:s');
        });

        return $form;
    }


}
