<x-guest-layout>
    <x-jet-authentication-card >
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <form method="POST" action="{{ route('users.acompany') }}">
            @csrf         

            <div class="block mt-4">
                <x-jet-label value="Seleccione Empresa" />
                <select  class="form-select w-full" type="password" name="company" required  >
                    @foreach ($companies as $item)
                        <option value="{{$item->id}}">{{$item->Name}}</option>
                    @endforeach
                <select>
            </div>

            <div class="flex items-center justify-end mt-10">
                <x-jet-button class="ml-4">
                   INGRESAR
                </x-jet-button>
            </div>
        </form> 
    </x-jet-authentication-card> 
</x-guest-layout>