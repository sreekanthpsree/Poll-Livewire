<?php

namespace App\Http\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{

    public $title;
    public $options = [];
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255'
    ];
    protected $messages = [
        'options.*' => "The option can't be empty"
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.create-poll');
    }
    public function addOptions()
    {
        $this->options[] = '';
    }
    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }
    public function addPoll()
    {
        $this->validate();

        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
                collect($this->options)->map(function ($option) {
                    return ['name' => $option];
                })
            );
        // foreach ($this->options as $option) {
        //     $poll->options()->create(['name' => $option]);
        // }
        $this->reset(['title', 'options']);
        $this->emit('pollCreated');
    }
}