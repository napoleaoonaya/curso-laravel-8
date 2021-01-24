<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <img style="width:300px;height:250px;" src="{{ asset('/images/603.png') }}" alt="Bloco de notas">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Obrigado por inscrever-se! Antes de começar, você poderia verificar o seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos o prazer de enviar outro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Reenviando Email de Verificação') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Sair') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
