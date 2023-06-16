<div>
    <form wire:submit.prevent='addPoll'>
        <label for="title">Pool title</label>
        <input type="title" wire:model="title">
        @error('title')
            <div class="text-red-500">
                {{ $message }}
            </div>
        @enderror
        <div>
            <button class="btn mt-4 mb-4" wire:click.prevent='addOptions'>Add options</button>
        </div>
        <div class="mt-4">
            @foreach ($options as $index => $option)
                <div class="mb-4">
                    <label for="option">Option {{ $index + 1 }}</label>
                    <div class="flex gap-2">
                        <input type="text" wire:model='options.{{ $index }}' />
                        <button class="btn" wire:click.prevent='removeOption({{ $index }})'>Remove</button>
                    </div>
                    @error("options.{$index}")
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn">Create poll</button>
    </form>
</div>
